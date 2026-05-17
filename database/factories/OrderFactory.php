<?php

namespace Database\Factories;

use App\Models\Demande;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 50);
        $unitPrice = fake()->randomFloat(2, 50, 5000);

        return [
            'user_id' => User::factory(),
            'demande_id' => Demande::factory(),
            'reference' => 'ORD-' . fake()->unique()->bothify('####-????'),
            'product_name' => fake()->words(3, true),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $quantity * $unitPrice,
            'status' => fake()->randomElement(['draft', 'confirmed', 'shipped', 'delivered', 'cancelled']),
            'ordered_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
