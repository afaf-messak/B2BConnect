<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()->with('fournisseur')->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        $products = $query->paginate(20)->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'filters' => $request->only(['q', 'active']),
            'navItems' => Navigation::adminItems('products'),
            'navActive' => 'products',
            'pageTitle' => __('nav.admin.products'),
            'pageSubtitle' => __('products.admin_subtitle'),
            'stats' => [
                ['label' => __('admin.stats.total_products'), 'value' => Product::count()],
                ['label' => __('admin.stats.active_products'), 'value' => Product::where('is_active', true)->count()],
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.products.form', [
            'product' => new Product(['is_active' => true, 'stock' => 0]),
            'suppliers' => $this->suppliers(),
            'navItems' => Navigation::adminItems('products'),
            'navActive' => 'products',
            'pageTitle' => __('admin.create_product'),
            'pageSubtitle' => __('admin.create_product_subtitle'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedProduct($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', __('admin.product_created'));
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', [
            'product' => $product,
            'suppliers' => $this->suppliers(),
            'navItems' => Navigation::adminItems('products'),
            'navActive' => 'products',
            'pageTitle' => __('admin.edit_product'),
            'pageSubtitle' => $product->name,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validatedProduct($request);

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

        $product->update($data);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', __('admin.product_updated'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', __('admin.product_deleted'));
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedProduct(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'category' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'fournisseur_id' => ['required', 'exists:users,id'],
            'is_active' => ['sometimes', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]) + ['is_active' => $request->boolean('is_active', true)];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, User>
     */
    private function suppliers()
    {
        return User::query()
            ->where('role', User::ROLE_SUPPLIER)
            ->orderBy('company_name')
            ->orderBy('name')
            ->get(['id', 'name', 'company_name']);
    }
}
