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
            ->post(route('client.orders.store'), [
                'product_id' => $product->id,
                'quantity' => 2,
            ])
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

    public function test_client_product_page_shows_order_quantity_form(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);
        $product = Product::factory()->create([
            'fournisseur_id' => $supplier->id,
            'stock' => 10,
            'is_active' => true,
            'moq' => 3,
        ]);

        $this->actingAs($client)
            ->get(route('products.show', $product))
            ->assertOk()
            ->assertSee(route('client.orders.store'), false)
            ->assertSee('name="product_id"', false)
            ->assertSee('value="'.$product->id.'"', false)
            ->assertSee('name="quantity"', false)
            ->assertSee('min="1"', false);
    }

    public function test_client_can_order_less_than_product_moq(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);
        $product = Product::factory()->create([
            'fournisseur_id' => $supplier->id,
            'price' => 100,
            'stock' => 10,
            'is_active' => true,
            'moq' => 100,
        ]);

        $this->actingAs($client)
            ->post(route('client.orders.store'), [
                'product_id' => $product->id,
                'quantity' => 2,
            ])
            ->assertRedirect(route('client.orders.index'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $client->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_client_can_update_own_order_quantity(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);
        $product = Product::factory()->create([
            'fournisseur_id' => $supplier->id,
            'price' => 100,
            'stock' => 8,
            'is_active' => true,
            'moq' => 100,
        ]);
        $order = Order::factory()->create([
            'user_id' => $client->id,
            'supplier_id' => $supplier->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'unit_price' => 100,
            'total_price' => 200,
            'status' => 'confirmed',
        ]);

        $this->actingAs($client)
            ->patch(route('client.orders.update', $order), ['quantity' => 1])
            ->assertRedirect();

        $this->assertSame(1, $order->fresh()->quantity);
        $this->assertEquals(100, $order->fresh()->total_price);
        $this->assertEquals(9, $product->fresh()->stock);
    }

    public function test_client_can_delete_own_order_before_shipping(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);
        $product = Product::factory()->create([
            'fournisseur_id' => $supplier->id,
            'stock' => 8,
            'is_active' => true,
        ]);
        $order = Order::factory()->create([
            'user_id' => $client->id,
            'supplier_id' => $supplier->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'status' => 'confirmed',
        ]);

        $this->actingAs($client)
            ->delete(route('client.orders.destroy', $order))
            ->assertRedirect();

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $this->assertEquals(10, $product->fresh()->stock);
    }

    public function test_supplier_can_update_own_order_status(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $supplier = User::factory()->create(['role' => User::ROLE_SUPPLIER]);
        $order = Order::factory()->create([
            'user_id' => $client->id,
            'supplier_id' => $supplier->id,
            'status' => 'confirmed',
        ]);

        $this->actingAs($supplier)
            ->patch(route('supplier.orders.update', $order), ['status' => 'shipped'])
            ->assertRedirect();

        $this->assertSame('shipped', $order->fresh()->status);
    }
}
