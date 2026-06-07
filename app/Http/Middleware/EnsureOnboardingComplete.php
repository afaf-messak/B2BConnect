<?php

namespace App\Http\Middleware;

use App\Support\SocialRedirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOnboardingComplete
{
    /** @var list<string> */
    private const EXEMPT_ROUTES = [
        'auth.role-selection',
        'auth.role-selection.store',
        'auth.supplier-onboarding',
        'auth.supplier-onboarding.store',
        'auth.pending-approval',
        'logout',
        'locale.switch',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        $routeName = $request->route()?->getName();

        if (in_array($routeName, self::EXEMPT_ROUTES, true)) {
            return $next($request);
        }

        if (! $user->isOnboarded()) {
            return redirect()->route('auth.role-selection');
        }

        if ($user->needsSupplierApproval()) {
            return redirect()->route('auth.pending-approval');
        }

        return $next($request);
    }
}
