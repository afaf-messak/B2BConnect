<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = User::query()->where('role', 'supplier')->get();

        if ($suppliers->isEmpty()) {
            $suppliers = User::factory(3)->create(['role' => 'supplier']);
        }

        $suppliers->each(function (User $supplier): void {
            Product::factory()
                ->count(fake()->numberBetween(2, 6))
                ->create(['fournisseur_id' => $supplier->id]);
        });
    }
}
