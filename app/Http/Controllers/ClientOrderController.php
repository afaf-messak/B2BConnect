<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Offre;
use App\Models\Order;
use App\Models\Product;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientOrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->with('demande')
            ->latest()
            ->paginate(15);

        return view('orders.index', [
            'orders' => $orders,
            'navItems' => Navigation::clientItems('orders', $request->user()),
            'navActive' => 'orders',
            'pageTitle' => __('nav.orders'),
            'pageSubtitle' => __('orders.client_subtitle'),
        ]);
    }
}
