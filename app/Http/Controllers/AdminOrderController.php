<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Navigation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::query()->with(['user', 'supplier', 'demande', 'product'])->latest();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                    ->orWhere('product_name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'filters' => $request->only(['q', 'status']),
            'navItems' => Navigation::adminItems('orders'),
            'navActive' => 'orders',
            'pageTitle' => __('nav.admin.orders'),
            'pageSubtitle' => __('orders.admin_subtitle'),
            'stats' => [
                ['label' => __('admin.stats.total_orders'), 'value' => Order::count()],
                ['label' => __('common.pending'), 'value' => Order::where('status', 'pending')->count()],
                ['label' => __('common.completed'), 'value' => Order::where('status', 'completed')->count()],
            ],
        ]);
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'supplier', 'demande', 'product', 'offre']);

        return view('admin.orders.show', [
            'order' => $order,
            'navItems' => Navigation::adminItems('orders'),
            'navActive' => 'orders',
            'pageTitle' => $order->reference ?: '#'.$order->id,
            'pageSubtitle' => __('admin.order_details'),
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'processing', 'completed', 'cancelled'])],
        ]);

        $order->update($validated);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', __('admin.order_updated'));
    }
}
