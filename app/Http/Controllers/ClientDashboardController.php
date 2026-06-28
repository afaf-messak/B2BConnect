<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Offre;
use App\Models\Order;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('client.dashboard', [
            'navItems' => Navigation::clientItems('dashboard', $user),
            'navActive' => 'dashboard',
            'pageTitle' => __('nav.dashboard'),
            'pageSubtitle' => __('dashboard.client_subtitle'),
            'stats' => [
                ['label' => __('nav.my_requests'), 'value' => Demande::where('user_id', $user->id)->count(), 'icon' => 'assignment', 'href' => route('client.demandes.index')],
                ['label' => __('nav.offers_received'), 'value' => Offre::whereHas('demande', fn ($q) => $q->where('user_id', $user->id))->count(), 'icon' => 'local_offer', 'href' => route('client.offers.index')],
                ['label' => __('nav.orders'), 'value' => Order::where('user_id', $user->id)->count(), 'icon' => 'shopping_cart', 'href' => route('client.orders.index')],
                ['label' => __('nav.messages'), 'value' => $user->unreadMessagesCount(), 'icon' => 'mail', 'href' => route('messages.index')],
            ],
        ]);
    }
}
