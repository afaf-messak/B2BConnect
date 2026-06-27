<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Offre;
use App\Support\Navigation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $supplier = $request->user();
        \App\Models\SupplierProfile::ensureFor($supplier);
        $supplierName = $supplier?->name ?? 'Supplier';
        $supplierInitials = $this->initials($supplierName);

        $pendingRequests = Demande::query()
            ->where('status', 'pending')
            ->count();

        $requestsToday = Demande::query()
            ->where('status', 'pending')
            ->whereDate('created_at', today())
            ->count();

        $offersSent = Offre::query()
            ->where('user_id', $supplier?->id)
            ->count();

        $activeOffers = Offre::query()
            ->where('user_id', $supplier?->id)
            ->where('status', 'pending')
            ->count();

        $monthlyRevenue = Offre::query()
            ->where('user_id', $supplier?->id)
            ->where('status', 'accepted')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('price');

        $requests = Demande::query()
            ->with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Demande $demande) => [
                'title' => $demande->title,
                'company' => $demande->user?->company_name ?: ($demande->user?->name ?? 'Client B2BConnect'),
                'amount' => $demande->budget ? '$' . number_format((float) $demande->budget, 2) : 'A negocier',
                'time' => $demande->created_at?->diffForHumans() ?? 'Recemment',
                'icon' => $this->iconForCategory($demande->category),
            ])
            ->values()
            ->all();

        if ($requests === []) {
            $requests = $this->demoRequests();
        }

        return view('supplier.supplierDashboard', [
            'supplierName' => $supplierName,
            'supplierInitials' => $supplierInitials,
            'requests' => $requests,
            'navItems' => Navigation::supplierItems('dashboard', $supplier),
            'navActive' => 'dashboard',
            'pageTitle' => __('nav.dashboard'),
            'pageSubtitle' => __('dashboard.supplier_subtitle'),
            'stats' => [
                ['label' => __('nav.demandes'), 'value' => (string) $pendingRequests, 'badge' => '+'.$requestsToday.' '.__('common.today'), 'icon' => 'assignment'],
                ['label' => __('nav.sent_offers'), 'value' => (string) $offersSent, 'badge' => $activeOffers.' '.__('common.active'), 'icon' => 'local_offer'],
                ['label' => __('nav.products'), 'value' => (string) $supplier->products()->count(), 'badge' => __('common.catalogue'), 'icon' => 'inventory_2'],
            ],
            'profileCompletion' => 85,
        ]);
    }

    private function initials(string $name): string
    {
        $parts = array_filter(explode(' ', trim($name)));
        $initials = '';

        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }

        return $initials ?: 'S';
    }

    private function iconForCategory(?string $category): string
    {
        return match ($category) {
            'storage', 'stockage' => 'inventory_2',
            'manufacturing', 'pieces', 'parts' => 'precision_manufacturing',
            default => 'local_shipping',
        };
    }

    private function compactMoney(float $amount): string
    {
        if ($amount >= 1000) {
            return '$' . number_format($amount / 1000, 1) . 'k';
        }

        return '$' . number_format($amount, 2);
    }

    private function demoRequests(): array
    {
        return [
            ['title' => 'Livraison express - Hub Lyon', 'company' => 'Logistics Pro S.A.', 'amount' => '$1,450.00', 'time' => 'il y a 2h', 'icon' => 'local_shipping'],
            ['title' => 'Stockage en vrac (Zone B)', 'company' => 'Global Supply Corp', 'amount' => '$8,200.00', 'time' => 'il y a 5h', 'icon' => 'inventory_2'],
            ['title' => 'Approvisionnement pieces detachees', 'company' => 'AutoTech Ltd', 'amount' => '$450.00', 'time' => 'il y a 1j', 'icon' => 'precision_manufacturing'],
        ];
    }
}
