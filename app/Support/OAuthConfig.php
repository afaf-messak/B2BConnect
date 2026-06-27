<?php

namespace App\Support;

use InvalidArgumentException;

class OAuthConfig
{
    public const DRIVER_GOOGLE = 'google';

    public static function driverForProvider(string $provider): string
    {
        return match ($provider) {
            'google' => self::DRIVER_GOOGLE,
            default => throw new InvalidArgumentException(__('social.invalid_provider')),
        };
    }

    /**
     * @return array{client_id: string|null, client_secret: string|null, redirect: string|null}
     */
    public static function credentials(string $driver): array
    {
        /** @var array<string, mixed>|null $config */
        $config = config("services.{$driver}");

        if (! is_array($config)) {
            return [
                'client_id' => null,
                'client_secret' => null,
                'redirect' => null,
            ];
        }

        return [
            'client_id' => isset($config['client_id']) ? trim((string) $config['client_id']) : null,
            'client_secret' => isset($config['client_secret']) ? trim((string) $config['client_secret']) : null,
            'redirect' => isset($config['redirect']) ? trim((string) $config['redirect']) : null,
        ];
    }

    public static function isConfigured(string $driver): bool
    {
        $credentials = self::credentials($driver);

        return ($credentials['client_id'] ?? '') !== ''
            && ($credentials['client_secret'] ?? '') !== ''
            && ($credentials['redirect'] ?? '') !== '';
    }

    public static function isProviderEnabled(string $provider): bool
    {
        try {
            return self::isConfigured(self::driverForProvider($provider));
        } catch (InvalidArgumentException) {
            return false;
        }
    }

    public static function anyProviderEnabled(): bool
    {
        return self::isProviderEnabled('google');
    }

    public static function ensureConfigured(string $driver): void
    {
        $credentials = self::credentials($driver);

        if (($credentials['client_id'] ?? '') === '' || ($credentials['client_secret'] ?? '') === '') {
            $message = self::missingCredentialsMessage($driver, $credentials);

            throw new InvalidArgumentException($message);
        }

        if (($credentials['redirect'] ?? '') === '') {
            throw new InvalidArgumentException(__('social.oauth_redirect_missing', [
                'provider' => self::providerLabel($driver),
            ]));
        }
    }

    public static function providerLabel(string $driver): string
    {
        return match ($driver) {
            self::DRIVER_GOOGLE => 'Google',
            default => $driver,
        };
    }

    public static function envKeysHint(string $driver): string
    {
        return match ($driver) {
            self::DRIVER_GOOGLE => 'GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET',
            default => '',
        };
    }

    /**
     * OAuth callback URL sent to the provider. Uses the configured redirect URI so it
     * always matches Google Console and APP_URL (avoids session host mismatch).
     */
    public static function callbackUrlForProvider(string $provider): string
    {
        $driver = self::driverForProvider($provider);
        $configured = trim((string) (self::credentials($driver)['redirect'] ?? ''));

        if ($configured !== '') {
            return $configured;
        }

        if (! app()->runningInConsole() && app()->bound('request')) {
            return route('social.callback', ['provider' => $provider], absolute: true);
        }

        return rtrim((string) config('app.url'), '/').'/auth/'.$provider.'/callback';
    }

    /**
     * URIs to register in the provider console (covers common local dev variants).
     *
     * @return list<string>
     */
    public static function suggestedCallbackUrls(string $provider): array
    {
        $path = '/auth/'.$provider.'/callback';
        $appUrl = rtrim((string) config('app.url'), '/');
        $urls = [$appUrl.$path];

        if (str_contains($appUrl, '127.0.0.1')) {
            $urls[] = str_replace('127.0.0.1', 'localhost', $appUrl).$path;
        } elseif (str_contains($appUrl, 'localhost') && ! str_contains($appUrl, '127.0.0.1')) {
            $urls[] = preg_replace('#://localhost#', '://127.0.0.1', $appUrl).$path;
        }

        return array_values(array_unique($urls));
    }

    /**
     * @param  array{client_id: string|null, client_secret: string|null, redirect: string|null}  $credentials
     */
    private static function missingCredentialsMessage(string $driver, array $credentials): string
    {
        $hasId = ($credentials['client_id'] ?? '') !== '';
        $hasSecret = ($credentials['client_secret'] ?? '') !== '';

        if ($hasId && ! $hasSecret && $driver === self::DRIVER_GOOGLE) {
            return __('social.oauth_secret_missing_google');
        }

        return __('social.oauth_not_configured', [
            'provider' => self::providerLabel($driver),
            'keys' => self::envKeysHint($driver),
        ]);
    }
}
