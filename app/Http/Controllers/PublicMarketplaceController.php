<?php

namespace App\Http\Controllers;

use App\Models\FavoriteSupplier;
use App\Models\SupplierProfile;
use App\Models\SupplierReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicMarketplaceController extends Controller
{
    public function suppliers(Request $request): View
    {
        $query = User::query()
            ->where('role', User::ROLE_SUPPLIER)
            ->where('account_status', User::STATUS_ACTIVE)
            ->whereHas('supplierProfile', fn (Builder $q) => $q->where('is_public', true))
            ->with(['supplierProfile'])
            ->withCount(['products', 'supplierReviewsReceived as reviews_count'])
            ->withAvg('supplierReviewsReceived as average_rating', 'rating');

        if ($request->filled('q')) {
            $search = $request->string('q')->toString();
            $query->where(function (Builder $q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhereHas('supplierProfile', function (Builder $q) use ($search) {
                        $q->where('bio', 'like', "%{$search}%")
                            ->orWhere('tagline', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('industry')) {
            $query->whereHas('supplierProfile', fn (Builder $q) => $q->where('industry', $request->string('industry')));
        }

        if ($request->filled('city')) {
            $query->whereHas('supplierProfile', fn (Builder $q) => $q->where('city', $request->string('city')));
        }

        if ($request->filled('min_rating')) {
            $min = (float) $request->input('min_rating');
            $query->having('average_rating', '>=', $min);
        }

        $sort = $request->string('sort', 'rating')->toString();
        match ($sort) {
            'name' => $query->orderBy('company_name'),
            'products' => $query->orderByDesc('products_count'),
            default => $query->orderByDesc('average_rating'),
        };

        $suppliers = $query->paginate(12)->withQueryString();

        $industries = SupplierProfile::query()
            ->whereNotNull('industry')
            ->distinct()
            ->pluck('industry');

        return view('marketplace.suppliers.index', [
            'suppliers' => $suppliers,
            'industries' => $industries,
            'filters' => $request->only(['q', 'industry', 'city', 'min_rating', 'sort']),
        ]);
    }

    public function supplierShow(SupplierProfile $profile): View
    {
        abort_unless($profile->is_public, 404);

        $supplier = $profile->user;
        abort_unless($supplier?->isVerifiedSupplier(), 404);

        $supplier->loadCount('products');

        $products = $supplier->products()
            ->active()
            ->latest()
            ->take(8)
            ->get();

        $offers = $supplier->offres()
            ->where('status', 'accepted')
            ->with('demande')
            ->latest()
            ->take(6)
            ->get();

        $reviews = SupplierReview::query()
            ->where('supplier_id', $supplier->id)
            ->with('client')
            ->latest()
            ->take(10)
            ->get();

        $isFavorite = auth()->check()
            && auth()->user()->isClient()
            && FavoriteSupplier::query()
                ->where('client_id', auth()->id())
                ->where('supplier_id', $supplier->id)
                ->exists();

        return view('marketplace.suppliers.show', [
            'profile' => $profile,
            'supplier' => $supplier,
            'products' => $products,
            'offers' => $offers,
            'reviews' => $reviews,
            'averageRating' => $profile->averageRating(),
            'reviewsCount' => $profile->reviewsCount(),
            'isFavorite' => $isFavorite,
        ]);
    }
}
