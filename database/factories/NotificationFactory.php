<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
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
            'type' => fake()->randomElement(['info', 'offre', 'message', 'document']),
            'title' => fake()->sentence(3),
            'body' => fake()->sentence(12),
            'data' => ['url' => fake()->url()],
            'read_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
