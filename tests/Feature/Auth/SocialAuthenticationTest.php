<?php

namespace Tests\Feature\Auth;

use App\Models\SocialAccount;
use App\Models\User;
use App\Services\SocialAuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Mockery;
use Tests\TestCase;

class SocialAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.google.client_id' => 'test-google-client-id',
            'services.google.client_secret' => 'test-google-client-secret',
            'services.google.redirect' => 'http://localhost/auth/google/callback',
        ]);
    }

    public function test_redirect_without_google_credentials_shows_clear_error(): void
    {
        config([
            'services.google.client_id' => '',
            'services.google.client_secret' => '',
        ]);

        $this->get(route('social.redirect', 'google'))
            ->assertRedirect(route('login'))
            ->assertSessionHas('error');
    }

    public function test_login_page_shows_social_buttons(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee(__('social.continue_google'));
    }

    public function test_social_callback_creates_user_and_redirects_to_role_selection(): void
    {
        $socialUser = Mockery::mock(SocialiteUser::class);
        $socialUser->shouldReceive('getId')->andReturn('google-123');
        $socialUser->shouldReceive('getEmail')->andReturn('social@example.com');
        $socialUser->shouldReceive('getName')->andReturn('Social User');
        $socialUser->shouldReceive('getAvatar')->andReturn('https://example.com/avatar.jpg');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('redirectUrl')->andReturnSelf();
        $provider->shouldReceive('user')->andReturn($socialUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get(route('social.callback', 'google'));

        $response->assertRedirect(route('auth.role-selection'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'social@example.com',
            'onboarding_completed' => false,
        ]);
        $this->assertDatabaseHas('social_accounts', [
            'provider' => SocialAccount::PROVIDER_GOOGLE,
            'provider_id' => 'google-123',
        ]);
    }

    public function test_existing_email_links_social_account(): void
    {
        $user = User::factory()->create(['email' => 'existing@example.com']);

        $socialUser = Mockery::mock(SocialiteUser::class);
        $socialUser->shouldReceive('getId')->andReturn('google-999');
        $socialUser->shouldReceive('getEmail')->andReturn('existing@example.com');
        $socialUser->shouldReceive('getName')->andReturn('Existing User');
        $socialUser->shouldReceive('getAvatar')->andReturn(null);

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('redirectUrl')->andReturnSelf();
        $provider->shouldReceive('user')->andReturn($socialUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $this->get(route('social.callback', 'google'))
            ->assertRedirect(route('client.dashboard'));

        $this->assertDatabaseHas('social_accounts', [
            'user_id' => $user->id,
            'provider' => SocialAccount::PROVIDER_GOOGLE,
            'provider_id' => 'google-999',
        ]);
    }

    public function test_social_callback_invalid_state_shows_helpful_error(): void
    {
        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('redirectUrl')->andReturnSelf();
        $provider->shouldReceive('user')->andThrow(new InvalidStateException);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $this->get(route('social.callback', 'google'))
            ->assertRedirect(route('login'))
            ->assertSessionHas('error', __('social.oauth_invalid_state', [
                'url' => rtrim((string) config('app.url'), '/'),
            ]));
    }

    public function test_localhost_requests_redirect_to_app_url(): void
    {
        config(['app.url' => 'http://127.0.0.1:8000']);

        $this->get('http://localhost:8000/login')
            ->assertRedirect('http://127.0.0.1:8000/login');
    }

    public function test_linkedin_routes_are_not_available(): void
    {
        $this->get('/auth/linkedin/redirect')->assertNotFound();
        $this->get('/auth/linkedin/callback')->assertNotFound();
    }

    public function test_role_selection_activates_client(): void
    {
        $user = User::factory()->create([
            'role' => null,
            'onboarding_completed' => false,
        ]);

        $this->actingAs($user)
            ->post(route('auth.role-selection.store'), ['role' => 'client'])
            ->assertRedirect(route('client.dashboard'));

        $user->refresh();
        $this->assertTrue($user->isClient());
        $this->assertTrue($user->isOnboarded());
        $this->assertSame(User::STATUS_ACTIVE, $user->account_status);
    }

    public function test_supplier_onboarding_sets_pending_status(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_SUPPLIER,
            'onboarding_completed' => false,
        ]);

        $this->actingAs($user)
            ->post(route('auth.supplier-onboarding.store'), [
                'company_name' => 'Acme SARL',
                'ice' => '123456789012345',
            ])
            ->assertRedirect(route('auth.pending-approval'));

        $user->refresh();
        $this->assertSame(User::STATUS_PENDING, $user->account_status);
        $this->assertTrue($user->isOnboarded());
        $this->assertDatabaseHas('document_verifications', [
            'user_id' => $user->id,
            'document_type' => 'ice',
            'status' => 'pending',
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
