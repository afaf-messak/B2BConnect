<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DocumentVerification;
use App\Models\User;
use App\Support\SocialRedirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierOnboardingController extends Controller
{
    public function create(): View|RedirectResponse
    {
        $user = auth()->user();

        if ($user->isOnboarded()) {
            return redirect()->to(SocialRedirect::afterLogin($user));
        }

        if (! $user->isSupplier()) {
            return redirect()->route('auth.role-selection');
        }

        return view('auth.supplier-onboarding', [
            'user' => $user,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if ($user->isOnboarded()) {
            return redirect()->to(SocialRedirect::afterLogin($user));
        }

        if (! $user->isSupplier()) {
            return redirect()->route('auth.role-selection');
        }

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'ice' => ['required', 'string', 'max:50', 'regex:/^[0-9]+$/'],
        ], [
            'ice.regex' => __('social.ice_invalid'),
        ]);

        $user->update([
            'company_name' => $validated['company_name'],
            'ice' => $validated['ice'],
            'account_status' => User::STATUS_PENDING,
            'onboarding_completed' => true,
        ]);

        DocumentVerification::query()->updateOrCreate(
            [
                'user_id' => $user->id,
                'document_type' => 'ice',
            ],
            [
                'document_path' => 'social-onboarding/ice-'.$validated['ice'],
                'status' => 'pending',
                'rejection_reason' => null,
                'verified_at' => null,
            ]
        );

        return redirect()
            ->route('auth.pending-approval')
            ->with('success', __('social.supplier_submitted'));
    }
}
