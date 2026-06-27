<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortalSettingsController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('portal.settings', [
            'navItems' => Navigation::forUser($user, 'settings'),
            'navActive' => 'settings',
            'pageTitle' => __('nav.settings'),
            'pageSubtitle' => __('portal.settings_subtitle'),
            'showCompany' => $user->isSupplier(),
            'quickLinks' => $this->quickLinksFor($user),
        ]);
    }

    /**
     * @return array<int, array{label: string, href?: string, type?: string}>
     */
    private function quickLinksFor(User $user): array
    {
        $logout = ['label' => __('nav.logout'), 'type' => 'logout'];

        if ($user->isSupplier()) {
            return [
                ['label' => __('nav.dashboard'), 'href' => route('supplier.dashboard')],
                ['label' => __('nav.products'), 'href' => route('supplier.products.index')],
                ['label' => __('nav.orders'), 'href' => route('supplier.orders.index')],
                $logout,
            ];
        }

        return [
            ['label' => __('nav.dashboard'), 'href' => route('client.dashboard')],
            ['label' => __('nav.my_requests'), 'href' => route('client.demandes.index')],
            ['label' => __('nav.orders'), 'href' => route('client.orders.index')],
            $logout,
        ];
    }
}
