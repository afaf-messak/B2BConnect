<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(['email' => 'admin@b2bconnect.test'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
            'company_name' => 'B2BConnect Admin',
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
            'email_verified_at' => now(),
        ]);

        User::query()->updateOrCreate(['email' => 'client@b2bconnect.test'], [
            'name' => 'Client Demo',
            'password' => Hash::make('password'),
            'role' => User::ROLE_CLIENT,
            'company_name' => 'B2BConnect Client',
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
            'email_verified_at' => now(),
        ]);

        User::query()->updateOrCreate(['email' => 'supplier@b2bconnect.test'], [
            'name' => 'Supplier Demo',
            'password' => Hash::make('password'),
            'role' => User::ROLE_SUPPLIER,
            'company_name' => 'B2BConnect Supplier',
            'ice' => '123456789012345',
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
            'email_verified_at' => now(),
        ]);

        $clientsToCreate = max(0, 4 - User::query()->where('role', User::ROLE_CLIENT)->count());
        $suppliersToCreate = max(0, 4 - User::query()->where('role', User::ROLE_SUPPLIER)->count());

        User::factory($clientsToCreate)->create([
            'role' => User::ROLE_CLIENT,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);

        User::factory($suppliersToCreate)->create([
            'role' => User::ROLE_SUPPLIER,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
        ]);
    }
}
