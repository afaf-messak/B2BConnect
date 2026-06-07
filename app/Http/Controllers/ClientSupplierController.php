<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientSupplierController extends Controller
{
    public function index(Request $request): View
    {
        $suppliers = User::query()
            ->where('role', 'supplier')
            ->withCount('products')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('company_name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('client.suppliers.index', [
            'suppliers' => $suppliers,
            'filters' => ['q' => $request->string('q')->toString()],
            'navItems' => Navigation::clientItems('suppliers', $request->user()),
        ]);
    }

    public function show(Request $request, User $supplier): View
    {
        abort_unless($supplier->role === 'supplier', 404);

        $products = Product::query()
            ->where('fournisseur_id', $supplier->id)
            ->latest()
            ->paginate(8);

        return view('client.suppliers.show', [
            'supplier' => $supplier,
            'products' => $products,
            'navItems' => Navigation::clientItems('suppliers', $request->user()),
        ]);
    }
}
