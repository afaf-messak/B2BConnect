<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCatalogController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with('fournisseur')
            ->active()
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('fournisseur', fn ($q) => $q->where('company_name', 'like', '%' . $search . '%'));
                });
            })
            ->when($request->filled('min_price'), fn ($q) => $q->where('price', '>=', (float) $request->input('min_price')))
            ->when($request->filled('max_price'), fn ($q) => $q->where('price', '<=', (float) $request->input('max_price')))
            ->when($request->filled('supplier'), fn ($q) => $q->where('fournisseur_id', $request->integer('supplier')))
            ->when($request->boolean('in_stock'), fn ($q) => $q->where('stock', '>', 0))
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->string('category')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $suppliers = Product::query()
            ->with('fournisseur')
            ->get()
            ->pluck('fournisseur')
            ->filter()
            ->unique('id')
            ->sortBy('company_name')
            ->values();

        $user = $request->user();
        $navItems = $user
            ? ($user->role === 'supplier'
                ? Navigation::supplierItems('products', $user)
                : Navigation::clientItems('products', $user))
            : null;

        return view('products.catalog', [
            'products' => $products,
            'suppliers' => $suppliers,
            'filters' => $request->only(['q', 'min_price', 'max_price', 'supplier', 'in_stock', 'category']),
            'navItems' => $navItems,
            'portalRole' => $user?->role,
        ]);
    }

    public function show(Request $request, Product $product): View
    {
        $product->load('fournisseur');

        $related = Product::query()
            ->where('fournisseur_id', $product->fournisseur_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        $user = $request->user();
        $navItems = $user
            ? ($user->role === 'supplier'
                ? Navigation::supplierItems('products', $user)
                : Navigation::clientItems('products', $user))
            : null;

        return view('products.show', [
            'product' => $product,
            'related' => $related,
            'navItems' => $navItems,
            'portalRole' => $user?->role,
        ]);
    }
}
