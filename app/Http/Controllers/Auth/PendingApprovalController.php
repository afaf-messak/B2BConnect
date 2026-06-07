<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\RoleRedirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PendingApprovalController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        $user = auth()->user();

        if (! $user->needsSupplierApproval()) {
            if (! $user->isOnboarded()) {
                return redirect()->route('auth.role-selection');
            }

            return redirect()->to(RoleRedirect::urlFor($user));
        }

        return view('auth.pending-approval', [
            'user' => $user,
        ]);
    }
}
