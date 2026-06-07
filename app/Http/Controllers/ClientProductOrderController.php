<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientProductOrderController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:'.max(1, (int) $product->moq)],
        ]);

        $quantity = (int) $validated['quantity'];

        if ($product->stock < $quantity) {
            return back()->with('error', __('marketplace.insufficient_stock'));
        }

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

        return redirect()
            ->route('client.orders.index')
            ->with('success', __('marketplace.order_placed'));
    }
}
