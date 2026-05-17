<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->pluck('id');

        Demande::query()->each(function (Demande $demande) use ($users): void {
            Offre::factory()
                ->count(fake()->numberBetween(1, 3))
                ->for($demande)
                ->create([
                    'user_id' => $users->random(),
                ]);
        });
    }
}
