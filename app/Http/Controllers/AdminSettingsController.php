<?php

namespace App\Http\Controllers;

use App\Support\Navigation;
use Illuminate\View\View;

class AdminSettingsController extends Controller
{
    public function index(): View
    {
        return view('admin.settings', [
            'navItems' => Navigation::adminItems('settings'),
            'navActive' => 'settings',
            'pageTitle' => __('nav.admin.settings'),
            'pageSubtitle' => __('admin.settings_subtitle'),
            'quickLinks' => [
                ['label' => __('nav.admin.users'), 'href' => route('admin.users.index')],
                ['label' => __('nav.admin.suppliers_validation'), 'href' => route('admin.moderation')],
                ['label' => __('nav.admin.analytics'), 'href' => route('admin.statistics')],
                ['label' => __('nav.logout'), 'type' => 'logout'],
            ],
        ]);
    }
}
