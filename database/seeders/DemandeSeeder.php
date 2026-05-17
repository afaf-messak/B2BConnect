<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->each(function (User $user): void {
            Demande::factory()
                ->count(3)
                ->for($user)
                ->create();
        });
    }
}
