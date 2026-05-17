<?php

namespace Database\Factories;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Demande>
 */
class DemandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'category' => fake()->randomElement(['IT', 'Office', 'Logistics', 'Marketing', 'Maintenance']),
            'quantity' => fake()->numberBetween(1, 100),
            'budget' => fake()->randomFloat(2, 500, 50000),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected', 'completed']),
            'needed_at' => fake()->dateTimeBetween('+1 week', '+3 months'),
        ];
    }
}
