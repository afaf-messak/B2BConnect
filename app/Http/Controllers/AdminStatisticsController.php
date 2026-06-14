<?php

namespace App\Http\Controllers;

use App\Services\AdminStatsService;
use App\Support\Navigation;
use Illuminate\View\View;

class AdminStatisticsController extends Controller
{
    public function __construct(private AdminStatsService $stats) {}

    public function index(): View
    {
        return view('admin.statistics', [
            'navItems' => Navigation::adminItems('statistics'),
            'navActive' => 'statistics',
            'pageTitle' => __('nav.admin.analytics'),
            'pageSubtitle' => __('admin.analytics_subtitle'),
            'growthChart' => $this->stats->growthChart(12),
            'roleChart' => $this->stats->roleDistribution(),
            'topSuppliers' => $this->stats->topSuppliers(8),
            'topProducts' => $this->stats->topProducts(8),
            'topClients' => $this->stats->topClients(8),
            'stats' => $this->stats->dashboardCards(),
        ]);
    }
}
