<?php

namespace Database\Factories;

use App\Models\DocumentVerification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DocumentVerification>
 */
class DocumentVerificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'approved', 'rejected']);

        return [
            'user_id' => User::factory(),
            'reviewer_id' => fake()->optional()->randomElement(User::query()->pluck('id')->all()) ?: null,
            'document_type' => fake()->randomElement(['registre_commerce', 'ice', 'tax_certificate', 'identity']),
            'document_path' => 'documents/' . fake()->uuid() . '.pdf',
            'status' => $status,
            'rejection_reason' => $status === 'rejected' ? fake()->sentence() : null,
            'verified_at' => $status === 'pending' ? null : fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
