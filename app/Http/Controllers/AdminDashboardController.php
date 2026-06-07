<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Offre;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'navItems' => Navigation::adminItems('dashboard'),
            'navActive' => 'dashboard',
            'pageTitle' => __('nav.admin.dashboard'),
            'pageSubtitle' => __('dashboard.admin_subtitle'),
            'stats' => [
                ['label' => __('nav.admin.users'), 'value' => User::count(), 'icon' => 'group', 'color' => 'primary'],
                ['label' => __('nav.admin.demandes'), 'value' => Demande::count(), 'icon' => 'assignment', 'color' => 'secondary'],
                ['label' => __('nav.admin.offers'), 'value' => Offre::count(), 'icon' => 'request_quote', 'color' => 'tertiary'],
                ['label' => __('nav.admin.orders'), 'value' => Order::count(), 'icon' => 'shopping_cart', 'color' => 'primary'],
            ],
        ]);
    }
}
