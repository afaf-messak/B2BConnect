<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierOrderController extends Controller
{
    public function index(Request $request): View
    {
        $supplierId = $request->user()->id;

        $orders = Order::query()
            ->with(['user', 'demande'])
            ->whereHas('demande.offres', fn ($q) => $q->where('user_id', $supplierId))
            ->latest()
            ->paginate(15);

        return view('orders.index', [
            'orders' => $orders,
            'navItems' => Navigation::supplierItems('orders', $request->user()),
            'navActive' => 'orders',
            'pageTitle' => __('nav.orders'),
            'pageSubtitle' => __('orders.supplier_subtitle'),
        ]);
    }
}
