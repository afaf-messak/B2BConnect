<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Offre;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierQuotationController extends Controller
{
    public function create(Request $request, Demande $demande): View
    {
        abort_unless($demande->status === 'pending', 404);

        $existing = Offre::query()
            ->where('demande_id', $demande->id)
            ->where('user_id', $request->user()->id)
            ->first();

        return view('supplier.demandes.quote', [
            'demande' => $demande->load('user'),
            'existingOffer' => $existing,
            'navItems' => Navigation::supplierItems('demandes', $request->user()),
        ]);
    }

    public function store(Request $request, Demande $demande): RedirectResponse
    {
        abort_unless($demande->status === 'pending', 404);

        $supplier = $request->user();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'delivery_time_days' => ['required', 'integer', 'min:1'],
        ]);

        Offre::query()->updateOrCreate(
            [
                'demande_id' => $demande->id,
                'user_id' => $supplier->id,
            ],
            [
                ...$validated,
                'status' => 'pending',
            ]
        );

        return redirect()
            ->route('supplier.offers')
            ->with('success', __('marketplace.quotation_submitted'));
    }
}
