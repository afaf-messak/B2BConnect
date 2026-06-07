<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DemandeSeeder::class,
            OffreSeeder::class,
            OrderSeeder::class,
            NotificationSeeder::class,
            MessageSeeder::class,
            DocumentVerificationSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
