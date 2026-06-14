<?php

namespace Tests\Feature;

use App\Models\Demande;
use App\Models\DocumentVerification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => User::ROLE_ADMIN]);
    }

    public function test_admin_can_access_all_admin_pages(): void
    {
        $admin = $this->admin();

        $routes = [
            'admin.dashboard',
            'admin.users.index',
            'admin.moderation',
            'admin.products.index',
            'admin.demandes.index',
            'admin.offers.index',
            'admin.orders.index',
            'admin.messages.index',
            'admin.statistics',
            'admin.settings',
        ];

        foreach ($routes as $route) {
            $this->actingAs($admin)->get(route($route))->assertOk();
        }
    }

    public function test_admin_can_suspend_and_activate_user(): void
    {
        $admin = $this->admin();
        $client = User::factory()->create(['role' => User::ROLE_CLIENT, 'account_status' => User::STATUS_ACTIVE]);

        $this->actingAs($admin)
            ->patch(route('admin.users.suspend', $client))
            ->assertRedirect();

        $this->assertSame(User::STATUS_SUSPENDED, $client->fresh()->account_status);

        $this->actingAs($admin)
            ->patch(route('admin.users.activate', $client))
            ->assertRedirect();

        $this->assertSame(User::STATUS_ACTIVE, $client->fresh()->account_status);
    }

    public function test_admin_can_approve_supplier(): void
    {
        $admin = $this->admin();
        $supplier = User::factory()->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_PENDING,
        ]);

        $document = DocumentVerification::factory()->create([
            'user_id' => $supplier->id,
            'status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.moderation.approve', $document))
            ->assertRedirect();

        $this->assertSame('approved', $document->fresh()->status);
        $this->assertSame(User::STATUS_ACTIVE, $supplier->fresh()->account_status);
    }

    public function test_admin_can_delete_product_and_demande(): void
    {
        $admin = $this->admin();
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $product = Product::factory()->create(['fournisseur_id' => $supplier->id]);
        $demande = Demande::factory()->create(['user_id' => $client->id]);

        $this->actingAs($admin)
            ->delete(route('admin.products.destroy', $product))
            ->assertRedirect();

        $this->actingAs($admin)
            ->delete(route('admin.demandes.destroy', $demande))
            ->assertRedirect();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertDatabaseMissing('demandes', ['id' => $demande->id]);
    }

    public function test_admin_can_create_client_and_product(): void
    {
        $admin = $this->admin();
        $supplier = User::factory()->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'New Client',
                'email' => 'newclient@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => User::ROLE_CLIENT,
                'account_status' => User::STATUS_ACTIVE,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('users', [
            'email' => 'newclient@example.com',
            'role' => User::ROLE_CLIENT,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.products.store'), [
                'name' => 'Admin Product',
                'price' => 99.99,
                'stock' => 10,
                'fournisseur_id' => $supplier->id,
                'is_active' => true,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('products', [
            'name' => 'Admin Product',
            'fournisseur_id' => $supplier->id,
        ]);
    }

    public function test_admin_can_access_create_pages(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->get(route('admin.users.create'))->assertOk();
        $this->actingAs($admin)->get(route('admin.products.create'))->assertOk();
        $this->actingAs($admin)->get(route('admin.demandes.create'))->assertOk();
    }

    public function test_supplier_cannot_access_admin_routes(): void
    {
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);

        $this->actingAs($supplier)
            ->get(route('admin.users.index'))
            ->assertRedirect(route('supplier.dashboard'))
            ->assertSessionHas('error');
    }
}
