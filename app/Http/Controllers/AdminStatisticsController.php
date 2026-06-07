<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\DocumentVerification;
use App\Models\Offre;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Support\Navigation;
use Illuminate\View\View;

class AdminStatisticsController extends Controller
{
    public function index(): View
    {
        return view('admin.statistics', [
            'navItems' => Navigation::adminItems('statistics'),
            'navActive' => 'statistics',
            'pageTitle' => __('nav.admin.statistics'),
            'pageSubtitle' => __('dashboard.statistics_subtitle'),
            'metrics' => [
                ['label' => __('nav.admin.users'), 'value' => User::count(), 'breakdown' => [
                    __('roles.client') => User::where('role', User::ROLE_CLIENT)->count(),
                    __('roles.supplier') => User::where('role', User::ROLE_SUPPLIER)->count(),
                    __('roles.admin') => User::where('role', User::ROLE_ADMIN)->count(),
                ]],
                ['label' => __('nav.admin.demandes'), 'value' => Demande::count(), 'breakdown' => [
                    'Pending' => Demande::where('status', 'pending')->count(),
                    'Completed' => Demande::where('status', 'completed')->count(),
                ]],
                ['label' => __('nav.admin.offers'), 'value' => Offre::count(), 'breakdown' => [
                    'Pending' => Offre::where('status', 'pending')->count(),
                    'Accepted' => Offre::where('status', 'accepted')->count(),
                ]],
                ['label' => __('nav.admin.products'), 'value' => Product::count(), 'breakdown' => []],
                ['label' => __('nav.admin.orders'), 'value' => Order::count(), 'breakdown' => []],
                ['label' => __('nav.admin.suppliers_validation'), 'value' => DocumentVerification::where('status', 'pending')->count(), 'breakdown' => []],
            ],
        ]);
    }
}
