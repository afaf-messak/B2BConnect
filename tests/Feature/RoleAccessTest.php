<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('client.dashboard'))
            ->assertSessionHas('error');
    }

    public function test_supplier_cannot_access_client_dashboard(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_SUPPLIER]);

        $this->actingAs($user)
            ->get(route('client.dashboard'))
            ->assertRedirect(route('supplier.dashboard'));
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertOk();
    }

    public function test_dashboard_redirects_by_role(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);

        $this->actingAs($admin)->get(route('dashboard'))->assertRedirect(route('admin.dashboard'));
        $this->actingAs($client)->get(route('dashboard'))->assertRedirect(route('client.dashboard'));
        $this->actingAs($supplier)->get(route('dashboard'))->assertRedirect(route('supplier.dashboard'));
    }
}
