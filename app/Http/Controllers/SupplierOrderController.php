<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SupplierOrderController extends Controller
{
    public function index(Request $request): View
    {
        $supplierId = $request->user()->id;

        $baseQuery = Order::query()
            ->with(['user', 'supplier', 'demande', 'product', 'offre'])
            ->where(function ($query) use ($supplierId) {
                $query->where('supplier_id', $supplierId)
                    ->orWhereHas('demande.offres', fn ($q) => $q->where('user_id', $supplierId));
            });

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

        return view('orders.index', [
            'orders' => $orders,
            'stats' => $stats,
            'filters' => $request->only('status'),
            'navItems' => Navigation::supplierItems('orders', $request->user()),
            'navActive' => 'orders',
            'pageTitle' => __('nav.orders'),
            'pageSubtitle' => __('orders.supplier_subtitle'),
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $supplierId = $request->user()->id;

        abort_unless(
            (int) $order->supplier_id === (int) $supplierId
                || (int) $order->offre?->user_id === (int) $supplierId,
            403
        );

        $validated = $request->validate([
            'status' => ['required', Rule::in(['confirmed', 'shipped', 'delivered', 'cancelled'])],
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', __('orders.updated'));
    }
}
