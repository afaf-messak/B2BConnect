<?php

namespace Database\Seeders;

use App\Models\DocumentVerification;
use App\Models\User;
use Illuminate\Database\Seeder;

class DocumentVerificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->each(function (User $user): void {
            DocumentVerification::factory()
                ->count(fake()->numberBetween(1, 2))
                ->for($user)
                ->create();
        });
    }
}
