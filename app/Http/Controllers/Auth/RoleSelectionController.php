<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\SocialRedirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleSelectionController extends Controller
{
    public function create(): View|RedirectResponse
    {
        $user = auth()->user();

        if ($user->isOnboarded()) {
            return redirect()->to(SocialRedirect::afterLogin($user));
        }

        return view('auth.role-selection', [
            'user' => $user,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if ($user->isOnboarded()) {
            return redirect()->to(SocialRedirect::afterLogin($user));
        }

        $validated = $request->validate([
            'role' => ['required', 'string', 'in:'.User::ROLE_CLIENT.','.User::ROLE_SUPPLIER],
        ]);

        if ($validated['role'] === User::ROLE_CLIENT) {
            $user->update([
                'role' => User::ROLE_CLIENT,
                'account_status' => User::STATUS_ACTIVE,
                'onboarding_completed' => true,
            ]);

            return redirect()->route('client.dashboard')->with('success', __('social.client_activated'));
        }

        $user->update([
            'role' => User::ROLE_SUPPLIER,
        ]);

        return redirect()->route('auth.supplier-onboarding');
    }
}
