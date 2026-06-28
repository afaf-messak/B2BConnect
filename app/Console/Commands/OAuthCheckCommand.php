<?php

namespace App\Console\Commands;

use App\Support\OAuthConfig;
use Illuminate\Console\Command;

class OAuthCheckCommand extends Command
{
    protected $signature = 'oauth:check';

    protected $description = 'Verify Google OAuth credentials from .env';

    public function handle(): int
    {
        $this->info('OAuth configuration (config/services.php ← .env)');
        $this->newLine();

        $this->checkProvider('Google', OAuthConfig::DRIVER_GOOGLE, 'GOOGLE_CLIENT_ID', 'GOOGLE_CLIENT_SECRET');

        $this->newLine();
        $this->line('After editing .env run: php artisan config:clear');
        $this->line('Setup guide: docs/OAUTH_SETUP.md');

        return self::SUCCESS;
    }

    private function checkProvider(string $label, string $driver, string $idKey, string $secretKey): void
    {
        $credentials = OAuthConfig::credentials($driver);
        $ok = OAuthConfig::isConfigured($driver);

        $this->components->twoColumnDetail(
            $label,
            $ok ? '<fg=green>configured</>' : '<fg=red>missing credentials</>'
        );

        $this->line("  {$idKey}: ".($credentials['client_id'] ? substr($credentials['client_id'], 0, 12).'…' : '<empty>'));
        $this->line("  {$secretKey}: ".($credentials['client_secret'] ? '********' : '<empty>'));
        $this->line('  redirect (config): '.($credentials['redirect'] ?: '<empty>'));

        if ($ok) {
            $this->line('  register in console:');
            foreach (OAuthConfig::suggestedCallbackUrls('google') as $url) {
                $this->line("    - {$url}");
            }
        }

        $this->newLine();
    }
}
