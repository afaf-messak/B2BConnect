<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleSwitchTest extends TestCase
{
    use RefreshDatabase;

    public function test_locale_can_be_switched_via_get(): void
    {
        $this->get('/locale/fr')
            ->assertRedirect();

        $this->get('/login')
            ->assertOk()
            ->assertSee('Bon retour', false);

        $this->get('/locale/en')
            ->assertRedirect();

        $this->get('/login')
            ->assertOk()
            ->assertSee('Welcome back', false);
    }

    public function test_locale_can_be_switched_via_post(): void
    {
        $this->post('/locale/ar')
            ->assertRedirect();

        $this->assertSame('ar', session('locale'));
    }

    public function test_invalid_locale_returns_not_found(): void
    {
        $this->get('/locale/xx')->assertNotFound();
    }
}
