<?php

namespace App\Http\Controllers;

use App\Models\FavoriteSupplier;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientFavoriteController extends Controller
{
    public function index(Request $request): View
    {
        $favorites = FavoriteSupplier::query()
            ->where('client_id', $request->user()->id)
            ->with(['supplier.supplierProfile'])
            ->latest()
            ->paginate(12);

        return view('client.favorites.index', [
            'favorites' => $favorites,
            'navItems' => Navigation::clientItems('favorites', $request->user()),
        ]);
    }

    public function store(Request $request, User $supplier): RedirectResponse
    {
        abort_unless($supplier->isVerifiedSupplier(), 404);

        FavoriteSupplier::query()->firstOrCreate([
            'client_id' => $request->user()->id,
            'supplier_id' => $supplier->id,
        ]);

        return back()->with('success', __('marketplace.added_to_favorites'));
    }

    public function destroy(Request $request, User $supplier): RedirectResponse
    {
        FavoriteSupplier::query()
            ->where('client_id', $request->user()->id)
            ->where('supplier_id', $supplier->id)
            ->delete();

        return back()->with('success', __('marketplace.removed_from_favorites'));
    }
}
