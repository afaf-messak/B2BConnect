<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ClientOrderController extends Controller
{
    public function index(Request $request): View
    {
        $baseQuery = Order::query()
            ->where('user_id', $request->user()->id)
            ->with(['demande', 'supplier', 'product', 'offre']);

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'confirmed' => (clone $baseQuery)->where('status', 'confirmed')->count(),
            'shipped' => (clone $baseQuery)->where('status', 'shipped')->count(),
            'delivered' => (clone $baseQuery)->where('status', 'delivered')->count(),
        ];

        $orders = (clone $baseQuery)
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $products = Product::query()
            ->with('fournisseur')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('orders.index', [
            'orders' => $orders,
            'products' => $products,
            'stats' => $stats,
            'filters' => $request->only('status'),
            'navItems' => Navigation::clientItems('orders', $request->user()),
            'navActive' => 'orders',
            'pageTitle' => __('nav.orders'),
            'pageSubtitle' => __('orders.client_subtitle'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::query()
            ->where('is_active', true)
            ->lockForUpdate()
            ->findOrFail($validated['product_id']);

        $quantity = (int) $validated['quantity'];

        if ($product->stock < $quantity) {
            return back()->withInput()->with('error', __('marketplace.insufficient_stock'));
        }

        DB::transaction(function () use ($request, $product, $quantity) {
            $total = $product->price * $quantity;
            $nextId = (Order::max('id') ?? 0) + 1;

            Order::create([
                'user_id' => $request->user()->id,
                'supplier_id' => $product->fournisseur_id,
                'product_id' => $product->id,
                'reference' => 'ORD-'.str_pad((string) $nextId, 6, '0', STR_PAD_LEFT),
                'product_name' => $product->name,
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'total_price' => $total,
                'status' => 'confirmed',
                'ordered_at' => now(),
            ]);

            $product->decrement('stock', $quantity);
        });

        return redirect()
            ->route('client.orders.index')
            ->with('success', __('orders.created'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        abort_unless((int) $order->user_id === (int) $request->user()->id, 403);
        abort_if(in_array($order->status, ['shipped', 'delivered', 'cancelled'], true), 403);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = (int) $validated['quantity'];

        DB::transaction(function () use ($order, $quantity) {
            $order->load('product');
            $oldQuantity = (int) $order->quantity;
            $difference = $quantity - $oldQuantity;

            if ($order->product) {
                abort_if($difference > 0 && $order->product->stock < $difference, 422, __('marketplace.insufficient_stock'));

                if ($difference > 0) {
                    $order->product->decrement('stock', $difference);
                } elseif ($difference < 0) {
                    $order->product->increment('stock', abs($difference));
                }
            }

            $order->update([
                'quantity' => $quantity,
                'total_price' => $order->unit_price * $quantity,
            ]);
        });

        return back()->with('success', __('orders.updated'));
    }

    public function destroy(Request $request, Order $order): RedirectResponse
    {
        abort_unless((int) $order->user_id === (int) $request->user()->id, 403);
        abort_if(in_array($order->status, ['shipped', 'delivered'], true), 403);

        DB::transaction(function () use ($order) {
            $order->load('product');

            if ($order->product) {
                $order->product->increment('stock', (int) $order->quantity);
            }

            $order->delete();
        });

        return back()->with('success', __('orders.deleted'));
    }
}
