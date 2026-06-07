<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Navigation;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->with(['user', 'demande'])
            ->latest()
            ->paginate(20);

        return view('orders.index', [
            'orders' => $orders,
            'navItems' => Navigation::adminItems('orders'),
            'navActive' => 'orders',
            'pageTitle' => __('nav.admin.orders'),
            'pageSubtitle' => __('orders.admin_subtitle'),
        ]);
    }
}
