<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class EnsureAdminCommand extends Command
{
    protected $signature = 'b2b:admin
                            {email? : Email of the admin account}
                            {--password=password : Password for new admin accounts}
                            {--name=Admin : Display name when creating a new admin}';

    protected $description = 'Create or promote an administrator account';

    public function handle(): int
    {
        $email = $this->argument('email')
            ?? config('b2b.admin_email')
            ?? 'admin@b2bconnect.test';

        $user = User::query()->where('email', $email)->first();

        if ($user) {
            $user->update([
                'role' => User::ROLE_ADMIN,
                'account_status' => User::STATUS_ACTIVE,
                'onboarding_completed' => true,
            ]);

            if (! $user->email_verified_at) {
                $user->forceFill(['email_verified_at' => now()])->save();
            }

            $this->info("Compte admin activé : {$email}");

            return self::SUCCESS;
        }

        $password = $this->option('password');

        $user = User::create([
            'name' => $this->option('name'),
            'email' => $email,
            'password' => Hash::make($password),
            'role' => User::ROLE_ADMIN,
            'account_status' => User::STATUS_ACTIVE,
            'onboarding_completed' => true,
            'company_name' => 'B2BConnect Admin',
        ]);

        $user->forceFill(['email_verified_at' => now()])->save();

        $this->info('Compte admin créé avec succès.');
        $this->line("  Email    : {$email}");
        $this->line("  Password : {$password}");
        $this->line('  URL      : '.route('admin.dashboard'));

        return self::SUCCESS;
    }
}
