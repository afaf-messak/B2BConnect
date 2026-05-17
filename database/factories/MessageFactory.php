<?php

namespace Database\Factories;

use App\Models\Demande;
use App\Models\Message;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::factory(),
            'receiver_id' => User::factory(),
            'demande_id' => Demande::factory(),
            'offre_id' => Offre::factory(),
            'body' => fake()->paragraph(),
            'read_at' => fake()->optional()->dateTimeBetween('-2 weeks', 'now'),
        ];
    }
}
