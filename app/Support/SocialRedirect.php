<?php

namespace App\Support;

use App\Models\User;

class SocialRedirect
{
    public static function afterLogin(User $user): string
    {
        if (! $user->isOnboarded()) {
            return route('auth.role-selection');
        }

        if ($user->needsSupplierApproval()) {
            return route('auth.pending-approval');
        }

        return RoleRedirect::urlFor($user);
    }
}
