<?php

namespace Database\Factories;

use App\Models\Demande;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offre>
 */
class OffreFactory extends Factory
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
            'demande_id' => Demande::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 100, 40000),
            'delivery_time_days' => fake()->numberBetween(2, 45),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected', 'expired']),
        ];
    }
}
