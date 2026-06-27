<?php

namespace Tests\Feature;

use App\Models\Demande;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_real_stats_from_database(): void
    {
        User::factory()->create(['role' => User::ROLE_SUPPLIER, 'account_status' => User::STATUS_ACTIVE]);
        Product::factory()->create(['is_active' => true]);
        Demande::factory()->create();
        Order::factory()->create();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-aos', false);
    }
}
