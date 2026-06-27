<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAuthService;
use App\Support\OAuthConfig;
use App\Support\SocialAuthException;
use App\Support\SocialRedirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    public function __construct(
        private readonly SocialAuthService $socialAuth
    ) {}

    public function redirect(string $provider): RedirectResponse
    {
        try {
            $driver = $this->socialAuth->resolveDriver($provider);

            OAuthConfig::ensureConfigured($driver);

            session(['social.oauth_redirect.'.$provider => OAuthConfig::callbackUrlForProvider($provider)]);

            return $this->socialite($driver, $provider)->redirect();
        } catch (Throwable $exception) {
            Log::warning('Social authentication redirect failed', [
                'provider' => $provider,
                'exception' => $exception::class,
                'message' => $exception->getMessage(),
            ]);

            return redirect()
                ->route('login')
                ->with('error', SocialAuthException::userMessage($exception));
        }
    }

    public function callback(string $provider): RedirectResponse
    {
        try {
            $driver = $this->socialAuth->resolveDriver($provider);

            OAuthConfig::ensureConfigured($driver);

            $socialUser = $this->socialite($driver, $provider)->user();
            $user = $this->socialAuth->handleCallback($provider, $socialUser);

            Auth::login($user, remember: true);

            return redirect()->to(SocialRedirect::afterLogin($user));
        } catch (Throwable $exception) {
            Log::warning('Social authentication failed', [
                'provider' => $provider,
                'exception' => $exception::class,
                'message' => $exception->getMessage(),
            ]);

            return redirect()
                ->route('login')
                ->with('error', SocialAuthException::userMessage($exception));
        }
    }

    private function socialite(string $driver, string $provider)
    {
        $redirectUrl = session('social.oauth_redirect.'.$provider)
            ?? OAuthConfig::callbackUrlForProvider($provider);

        return Socialite::driver($driver)
            ->redirectUrl($redirectUrl);
    }
}
