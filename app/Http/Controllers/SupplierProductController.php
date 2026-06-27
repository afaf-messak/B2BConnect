<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SupplierProductController extends Controller
{
    public function index(Request $request): View
    {
        $supplier = $request->user();

        $products = Product::query()
            ->where('fournisseur_id', $supplier->id)
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($request->filled('stock'), function ($query) use ($request) {
                if ($request->string('stock')->toString() === 'in_stock') {
                    $query->where('stock', '>', 0);
                } elseif ($request->string('stock')->toString() === 'out_of_stock') {
                    $query->where('stock', '<=', 0);
                }
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('supplier.products.index', [
            'supplierName' => $supplier->name,
            'supplierInitials' => $this->initials($supplier->name),
            'products' => $products,
            'filters' => [
                'q' => $request->string('q')->toString(),
                'stock' => $request->string('stock')->toString(),
            ],
            'navItems' => Navigation::supplierItems('products', $supplier),
        ]);
    }

    public function create(Request $request): View
    {
        $supplier = $request->user();

        return view('supplier.products.form', [
            'product' => new Product(),
            'supplierName' => $supplier->name,
            'supplierInitials' => $this->initials($supplier->name),
            'navItems' => Navigation::supplierItems('products', $supplier),
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['fournisseur_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()
            ->route('supplier.products.index')
            ->with('success', __('products.created'));
    }

    public function edit(Request $request, Product $product): View
    {
        $this->authorizeProduct($request, $product);
        $supplier = $request->user();

        return view('supplier.products.form', [
            'product' => $product,
            'supplierName' => $supplier->name,
            'supplierInitials' => $this->initials($supplier->name),
            'navItems' => Navigation::supplierItems('products', $supplier),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorizeProduct($request, $product);

        $data = $request->validated();

        if ($request->boolean('remove_image') && $product->image) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        unset($data['remove_image']);

        $product->update($data);

        return redirect()
            ->route('supplier.products.index')
            ->with('success', __('products.updated'));
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $this->authorizeProduct($request, $product);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('supplier.products.index')
            ->with('success', __('products.deleted'));
    }

    private function authorizeProduct(Request $request, Product $product): void
    {
        abort_unless(
            $request->user()?->role === 'supplier'
            && (int) $product->fournisseur_id === (int) $request->user()->id,
            403
        );
    }

    private function initials(string $name): string
    {
        $parts = array_filter(explode(' ', trim($name)));
        $initials = '';

        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }

        return $initials ?: 'S';
    }
}
