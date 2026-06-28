<?php

namespace App\Http\Controllers;

use App\Models\FavoriteSupplier;
use App\Models\Offre;
use App\Models\SupplierProfile;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierProfileController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        $supplier = $request->user();
        $profile = SupplierProfile::ensureFor($supplier);

        if ($request->boolean('preview')) {
            return redirect()->route('marketplace.suppliers.show', $profile);
        }

        $profile->loadMissing('user');

        return view('supplier.profile.show', [
            'supplier' => $supplier,
            'profile' => $profile,
            'stats' => [
                'products' => $supplier->products()->count(),
                'offers_sent' => Offre::where('user_id', $supplier->id)->count(),
                'offers_won' => Offre::where('user_id', $supplier->id)->where('status', 'accepted')->count(),
                'rating' => $profile->averageRating(),
                'reviews' => $profile->reviewsCount(),
            ],
            'navItems' => Navigation::supplierItems('company', $supplier),
        ]);
    }

    public function edit(Request $request): View
    {
        $supplier = $request->user();
        $profile = SupplierProfile::ensureFor($supplier);

        return view('supplier.profile.edit', [
            'supplier' => $supplier,
            'profile' => $profile,
            'navItems' => Navigation::supplierItems('company', $supplier),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $supplier = $request->user();
        $profile = SupplierProfile::ensureFor($supplier);

        $validated = $request->validate([
            'tagline' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'industry' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'url', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'response_time_hours' => ['nullable', 'integer', 'min:1', 'max:168'],
            'is_public' => ['sometimes', 'boolean'],
        ]);

        $profile->update([
            ...$validated,
            'is_public' => $request->boolean('is_public', true),
        ]);

        $supplier->update([
            'company_name' => $request->input('company_name', $supplier->company_name),
        ]);

        return redirect()
            ->route('supplier.profile')
            ->with('success', __('marketplace.profile_updated'));
    }
}
