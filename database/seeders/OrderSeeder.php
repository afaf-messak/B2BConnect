<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Demande::query()->each(function (Demande $demande): void {
            Order::factory()
                ->count(fake()->numberBetween(1, 2))
                ->for($demande->user)
                ->for($demande)
                ->create();
        });
    }
}
