<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class SupplierOffersController extends Controller
{
    public function index(Request $request): View
    {
        $supplier = $request->user();
        $supplierName = $supplier?->name ?? 'Supplier';

        $offers = Offre::query()
            ->with('demande')
            ->where('user_id', $supplier?->id)
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('demande', fn ($query) => $query->where('title', 'like', '%' . $search . '%'));
                });
            })
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Offre $offre) => [
                'id' => $offre->id,
                'company' => $offre->title,
                'subtitle' => $offre->demande?->title ?? 'Proposition logistique',
                'route' => $offre->demande?->category ?: 'Paris (FR) -> Berlin (DE)',
                'price' => 'EUR ' . number_format((float) $offre->price, 2),
                'delivery' => $offre->delivery_time_days . ' jours',
                'cargo' => $offre->demande?->category ?: 'Standard',
                'reliability' => '96%',
                'icon' => $this->iconForOffer($offre->demande?->category),
                'recommended' => $offre->status === 'pending',
                'status' => $offre->status,
                'can_update' => $offre->status === 'pending',
                'features' => [
                    ['label' => 'Assurance incluse', 'value' => 'OUI', 'tone' => 'success'],
                    ['label' => 'Suivi en direct', 'value' => 'OUI', 'tone' => 'success'],
                ],
            ])
            ->values()
            ->all();

        if ($offers === []) {
            $offers = $this->demoOffers();
        }

        $featuredOffer = $offers[0];
        $secondaryOffers = array_slice($offers, 1, 2);

        return view('supplier.offers', [
            'supplierName' => $supplierName,
            'supplierInitials' => $this->initials($supplierName),
            'supplierRole' => 'Logistics Manager',
            'featuredOffer' => $featuredOffer,
            'secondaryOffers' => $secondaryOffers,
            'performance' => [
                'pending' => Offre::query()->where('user_id', $supplier?->id)->where('status', 'pending')->count() ?: 14,
                'average_price' => $this->averagePrice($supplier?->id),
                'recommended_company' => $featuredOffer['company'],
                'image_url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1000&q=80',
            ],
            'filters' => [
                'q' => $request->string('q')->toString(),
                'status' => $request->string('status')->toString(),
            ],
            'navItems' => $this->navItems(),
        ]);
    }

    public function accept(Request $request, Offre $offre): RedirectResponse
    {
        $this->authorizeSupplierOffer($request, $offre);

        if ($offre->status === 'pending') {
            $offre->update(['status' => 'accepted']);
        }

        return redirect()
            ->route('supplier.offers')
            ->with('status', 'Offre acceptee avec succes.');
    }

    public function reject(Request $request, Offre $offre): RedirectResponse
    {
        $this->authorizeSupplierOffer($request, $offre);

        if ($offre->status === 'pending') {
            $offre->update(['status' => 'rejected']);
        }

        return redirect()
            ->route('supplier.offers')
            ->with('status', 'Offre refusee avec succes.');
    }

    public function export(Request $request): StreamedResponse
    {
        $supplier = $request->user();

        $offers = Offre::query()
            ->with('demande')
            ->where('user_id', $supplier?->id)
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('demande', fn ($query) => $query->where('title', 'like', '%' . $search . '%'));
                });
            })
            ->latest()
            ->get();

        return response()->streamDownload(function () use ($offers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Titre', 'Demande', 'Prix', 'Delai jours', 'Statut', 'Date']);

            foreach ($offers as $offre) {
                fputcsv($handle, [
                    $offre->id,
                    $offre->title,
                    $offre->demande?->title,
                    $offre->price,
                    $offre->delivery_time_days,
                    $offre->status,
                    $offre->created_at?->format('Y-m-d H:i'),
                ]);
            }

            fclose($handle);
        }, 'supplier-offers.csv', ['Content-Type' => 'text/csv']);
    }

    private function averagePrice(?int $supplierId): string
    {
        $average = Offre::query()
            ->where('user_id', $supplierId)
            ->avg('price');

        if (! $average) {
            return 'EUR 1.1k';
        }

        if ($average >= 1000) {
            return 'EUR ' . number_format($average / 1000, 1) . 'k';
        }

        return 'EUR ' . number_format($average, 0);
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

    private function iconForOffer(?string $category): string
    {
        return match ($category) {
            'express' => 'rocket_launch',
            'eco', 'durable' => 'eco',
            'storage', 'stockage' => 'inventory_2',
            default => 'inventory_2',
        };
    }

    private function authorizeSupplierOffer(Request $request, Offre $offre): void
    {
        abort_unless((int) $offre->user_id === (int) $request->user()?->id, 403);
    }

    private function navItems(): array
    {
        return [
            ['label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('supplier.dashboard'), 'active' => false],
            ['label' => 'Demandes', 'icon' => 'assignment', 'href' => route('supplier.dashboard'), 'active' => false],
            ['label' => 'Offres', 'icon' => 'local_offer', 'href' => route('supplier.offers'), 'active' => true],
            ['label' => 'Messages', 'icon' => 'mail', 'href' => 'mailto:support@supplylink.test', 'active' => false],
            ['label' => 'Profile', 'icon' => 'person', 'href' => route('supplier.profile'), 'active' => false],
        ];
    }

    private function demoOffers(): array
    {
        return [
            [
                'id' => null,
                'company' => 'TransLogistics Global',
                'subtitle' => 'Trajet: Paris (FR) -> Berlin (DE)',
                'route' => 'Paris (FR) -> Berlin (DE)',
                'price' => 'EUR 1,250.00',
                'delivery' => '48 Heures',
                'cargo' => 'Fragile',
                'reliability' => '98%',
                'icon' => 'inventory_2',
                'recommended' => true,
                'status' => 'demo',
                'can_update' => false,
                'features' => [],
            ],
            [
                'id' => null,
                'company' => 'SwiftPath Express',
                'subtitle' => '24h Express',
                'route' => 'Paris (FR) -> Berlin (DE)',
                'price' => 'EUR 1,890',
                'delivery' => '24h',
                'cargo' => 'Express',
                'reliability' => '97%',
                'icon' => 'rocket_launch',
                'recommended' => false,
                'status' => 'demo',
                'can_update' => false,
                'features' => [
                    ['label' => 'Assurance incluse', 'value' => 'OUI', 'tone' => 'success'],
                    ['label' => 'Suivi en direct', 'value' => 'OUI', 'tone' => 'success'],
                ],
            ],
            [
                'id' => null,
                'company' => 'EcoShip FR',
                'subtitle' => 'Transport Durable',
                'route' => 'Paris (FR) -> Berlin (DE)',
                'price' => 'EUR 950',
                'delivery' => '5 Jours',
                'cargo' => 'Eco',
                'reliability' => '94%',
                'icon' => 'eco',
                'recommended' => false,
                'status' => 'demo',
                'can_update' => false,
                'features' => [
                    ['label' => 'Empreinte CO2', 'value' => '-45%', 'tone' => 'secondary'],
                    ['label' => 'Delai', 'value' => '5 Jours', 'tone' => 'default'],
                ],
            ],
        ];
    }
}
