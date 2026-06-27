<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialAuthService
{
    /** @var list<string> */
    public const ALLOWED_PROVIDERS = [
        SocialAccount::PROVIDER_GOOGLE,
    ];

    public function resolveDriver(string $provider): string
    {
        return match ($provider) {
            'google' => SocialAccount::PROVIDER_GOOGLE,
            default => throw new InvalidArgumentException(__('social.invalid_provider')),
        };
    }

    public function handleCallback(string $provider, SocialiteUser $socialUser): User
    {
        $driver = $this->resolveDriver($provider);

        $email = strtolower(trim((string) $socialUser->getEmail()));
        if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(__('social.email_required'));
        }

        $providerId = (string) $socialUser->getId();
        if ($providerId === '') {
            throw new InvalidArgumentException(__('social.invalid_provider_data'));
        }

        return DB::transaction(function () use ($driver, $providerId, $email, $socialUser) {
            $existingAccount = SocialAccount::query()
                ->where('provider', $driver)
                ->where('provider_id', $providerId)
                ->first();

            if ($existingAccount) {
                $user = $existingAccount->user;
                $this->syncProfile($user, $socialUser);

                return $user;
            }

            $user = User::query()->where('email', $email)->first();

            if ($user) {
                $this->guardAgainstProviderMismatch($user, $driver, $providerId);
                $this->linkAccount($user, $driver, $providerId);
                $this->syncProfile($user, $socialUser);

                return $user;
            }

            $user = User::create([
                'name' => $this->resolveName($socialUser, $email),
                'email' => $email,
                'avatar' => $socialUser->getAvatar(),
                'password' => Str::password(32),
                'email_verified_at' => now(),
                'role' => null,
                'account_status' => User::STATUS_ACTIVE,
                'onboarding_completed' => false,
            ]);

            $this->linkAccount($user, $driver, $providerId);

            return $user;
        });
    }

    private function guardAgainstProviderMismatch(User $user, string $driver, string $providerId): void
    {
        $conflict = SocialAccount::query()
            ->where('user_id', $user->id)
            ->where('provider', $driver)
            ->where('provider_id', '!=', $providerId)
            ->exists();

        if ($conflict) {
            throw new InvalidArgumentException(__('social.account_conflict'));
        }
    }

    private function linkAccount(User $user, string $driver, string $providerId): void
    {
        SocialAccount::query()->firstOrCreate(
            [
                'provider' => $driver,
                'provider_id' => $providerId,
            ],
            [
                'user_id' => $user->id,
            ]
        );
    }

    private function syncProfile(User $user, SocialiteUser $socialUser): void
    {
        $updates = [];

        if ($socialUser->getAvatar() && $user->avatar !== $socialUser->getAvatar()) {
            $updates['avatar'] = $socialUser->getAvatar();
        }

        $name = $this->resolveName($socialUser, $user->email);
        if ($name && $user->name !== $name) {
            $updates['name'] = $name;
        }

        if ($updates !== []) {
            $user->update($updates);
        }
    }

    private function resolveName(SocialiteUser $socialUser, string $email): string
    {
        $name = trim((string) $socialUser->getName());
        if ($name !== '') {
            return Str::limit($name, 255, '');
        }

        return Str::before($email, '@');
    }
}
