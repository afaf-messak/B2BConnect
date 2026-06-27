<?php

namespace App\View\Composers;

use App\Support\Navigation;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SaasComposer
{
    public function compose(View $view): void
    {
        $user = Auth::user();

        if (! $view->offsetExists('portalRole') && $user) {
            $view->with('portalRole', $user->role);
        }

        if ($view->offsetExists('navItems') || ! $user) {
            return;
        }

        $active = $view->offsetExists('navActive')
            ? $view->offsetGet('navActive')
            : 'dashboard';

        $navItems = Navigation::forUser($user, $active);

        $view->with('navItems', $navItems);
    }
}
