<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            ['name' => 'Dell Latitude 5440 i5 13e Gen', 'category' => 'Informatique', 'unit' => 'piece', 'moq' => 2, 'price' => 8790.00],
            ['name' => 'HP LaserJet Pro M404dn', 'category' => 'Bureautique', 'unit' => 'piece', 'moq' => 1, 'price' => 2490.00],
            ['name' => 'Cisco Catalyst 2960X 24 ports', 'category' => 'Reseau', 'unit' => 'piece', 'moq' => 1, 'price' => 6900.00],
            ['name' => 'Carton double cannelure 60x40x40 cm', 'category' => 'Emballage', 'unit' => 'carton', 'moq' => 100, 'price' => 8.90],
            ['name' => 'Film etirable transparent 23 microns', 'category' => 'Emballage', 'unit' => 'rouleau', 'moq' => 12, 'price' => 42.00],
            ['name' => 'Palette Europe EPAL 1200x800 mm', 'category' => 'Logistique', 'unit' => 'palette', 'moq' => 10, 'price' => 145.00],
            ['name' => 'Gants nitrile non poudres boite de 100', 'category' => 'EPI', 'unit' => 'boite', 'moq' => 20, 'price' => 69.00],
            ['name' => 'Casque de securite 3M SecureFit', 'category' => 'EPI', 'unit' => 'piece', 'moq' => 5, 'price' => 118.00],
            ['name' => 'Roulement SKF 6205-2RS1', 'category' => 'Pieces industrielles', 'unit' => 'piece', 'moq' => 10, 'price' => 54.00],
            ['name' => 'Cable electrique cuivre 3G2.5 mm2', 'category' => 'Electricite', 'unit' => 'couronne', 'moq' => 1, 'price' => 890.00],
        ];

        $product = fake()->randomElement($products);

        return [
            'name' => $product['name'],
            'description' => fake()->sentence(18),
            'category' => $product['category'],
            'price' => fake()->randomFloat(2, max(1, $product['price'] * 0.85), $product['price'] * 1.15),
            'stock' => fake()->numberBetween(0, 500),
            'moq' => $product['moq'],
            'unit' => $product['unit'],
            'is_active' => true,
            'image' => null,
            'fournisseur_id' => User::factory()->state(['role' => 'supplier']),
        ];
    }
}
