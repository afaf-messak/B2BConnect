<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@b2bconnect.test',
            'role' => User::ROLE_ADMIN,
            'company_name' => 'B2BConnect Admin',
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);

        User::factory(4)->create([
            'role' => User::ROLE_CLIENT,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);
        User::factory(4)->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);
    }
}
