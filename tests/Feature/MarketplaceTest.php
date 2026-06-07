<?php

namespace Tests\Feature;

use App\Models\Demande;
use App\Models\FavoriteSupplier;
use App\Models\Offre;
use App\Models\Order;
use App\Models\Product;
use App\Models\SupplierProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketplaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_supplier_directory_lists_verified_suppliers(): void
    {
        $supplier = User::factory()->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);

        SupplierProfile::ensureFor($supplier)->update(['is_public' => true, 'tagline' => 'Industrial parts']);

        $this->get(route('marketplace.suppliers.index'))
            ->assertOk()
            ->assertSee('Industrial parts');
    }

    public function test_client_can_accept_supplier_quotation_and_create_order(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);

        $demande = Demande::factory()->create(['user_id' => $client->id, 'status' => 'pending']);
        $offre = Offre::factory()->create([
            'user_id' => $supplier->id,
            'demande_id' => $demande->id,
            'status' => 'pending',
            'price' => 1500,
        ]);

        $this->actingAs($client)
            ->post(route('client.offers.accept', $offre))
            ->assertRedirect(route('client.orders.index'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $client->id,
            'supplier_id' => $supplier->id,
            'offre_id' => $offre->id,
            'status' => 'confirmed',
        ]);

        $this->assertEquals('accepted', $offre->fresh()->status);
        $this->assertEquals('completed', $demande->fresh()->status);
    }

    public function test_supplier_can_submit_quotation_on_open_request(): void
    {
        $supplier = User::factory()->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);
        $demande = Demande::factory()->create(['status' => 'pending']);

        $this->actingAs($supplier)
            ->post(route('supplier.demandes.quote.store', $demande), [
                'title' => 'Custom packaging quote',
                'description' => 'Full proposal with logistics included.',
                'price' => 2200,
                'delivery_time_days' => 10,
            ])
            ->assertRedirect(route('supplier.offers'));

        $this->assertDatabaseHas('offres', [
            'demande_id' => $demande->id,
            'user_id' => $supplier->id,
            'title' => 'Custom packaging quote',
            'status' => 'pending',
        ]);
    }

    public function test_client_can_favorite_supplier(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);

        $this->actingAs($client)
            ->post(route('client.favorites.store', $supplier))
            ->assertRedirect();

        $this->assertDatabaseHas('favorite_suppliers', [
            'client_id' => $client->id,
            'supplier_id' => $supplier->id,
        ]);
    }

    public function test_client_can_purchase_product(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);
        $product = Product::factory()->create([
            'fournisseur_id' => $supplier->id,
            'price' => 100,
            'stock' => 10,
            'is_active' => true,
            'moq' => 1,
        ]);

        $this->actingAs($client)
            ->post(route('client.products.order', $product), ['quantity' => 2])
            ->assertRedirect(route('client.orders.index'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $client->id,
            'supplier_id' => $supplier->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'total_price' => 200,
        ]);

        $this->assertEquals(8, $product->fresh()->stock);
    }
}
