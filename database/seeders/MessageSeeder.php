<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Offre;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offre::query()->with('demande')->each(function (Offre $offre): void {
            Message::factory()
                ->count(fake()->numberBetween(1, 3))
                ->create([
                    'sender_id' => $offre->user_id,
                    'receiver_id' => $offre->demande->user_id,
                    'demande_id' => $offre->demande_id,
                    'offre_id' => $offre->id,
                ]);
        });
    }
}
