<?php

namespace App\Support;

use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Two\InvalidStateException;
use Throwable;

class SocialAuthException
{
    public static function userMessage(Throwable $exception): string
    {
        if ($exception instanceof InvalidStateException) {
            return __('social.oauth_invalid_state', [
                'url' => rtrim((string) config('app.url'), '/'),
            ]);
        }

        if ($exception instanceof ClientException) {
            $parsed = self::parseOAuthErrorBody((string) $exception->getResponse()?->getBody());

            if ($parsed !== null) {
                return $parsed;
            }
        }

        $message = trim($exception->getMessage());

        if ($message !== '') {
            return $message;
        }

        return __('social.auth_failed');
    }

    private static function parseOAuthErrorBody(string $body): ?string
    {
        if ($body === '') {
            return null;
        }

        $json = json_decode($body, true);
        if (! is_array($json)) {
            return null;
        }

        if (isset($json['error_description']) && is_string($json['error_description']) && $json['error_description'] !== '') {
            return $json['error_description'];
        }

        if (isset($json['error']) && is_string($json['error']) && $json['error'] !== '') {
            return $json['error'];
        }

        return null;
    }
}
