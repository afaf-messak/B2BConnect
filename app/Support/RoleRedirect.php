<?php

namespace App\Support;

use App\Models\User;

class RoleRedirect
{
    public static function routeFor(?User $user): string
    {
        if ($user?->needsSupplierApproval()) {
            return 'auth.pending-approval';
        }

        return match ($user?->role) {
            User::ROLE_ADMIN => 'admin.dashboard',
            User::ROLE_SUPPLIER => 'supplier.dashboard',
            User::ROLE_CLIENT => 'client.dashboard',
            default => 'auth.role-selection',
        };
    }

    public static function urlFor(?User $user): string
    {
        return route(self::routeFor($user));
    }
}
