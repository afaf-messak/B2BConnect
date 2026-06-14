<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AdminStatsService;
use App\Support\Navigation;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct(private AdminStatsService $stats) {}

    public function index(): View
    {
        return view('admin.dashboard', [
            'navItems' => Navigation::adminItems('dashboard'),
            'navActive' => 'dashboard',
            'pageTitle' => __('nav.admin.dashboard'),
            'pageSubtitle' => __('dashboard.admin_subtitle'),
            'stats' => $this->stats->dashboardCards(),
            'growthChart' => $this->stats->growthChart(),
            'roleChart' => $this->stats->roleDistribution(),
            'recentActivity' => $this->stats->recentActivity(),
        ]);
    }
}
