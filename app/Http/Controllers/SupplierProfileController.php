<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierProfileController extends Controller
{
    public function show(Request $request): View
    {
        $supplier = $request->user();
        $companyName = $supplier?->company_name ?: 'Global Logistics Dynamics';
        $supplierName = $supplier?->name ?? 'Supplier';

        return view('supplier.suppierprofile', [
            'supplierName' => $supplierName,
            'supplierInitials' => $this->initials($supplierName),
            'company' => [
                'name' => $companyName,
                'status' => 'Verified Supplier',
                'rating' => '4.8',
                'reviews_count' => '124 Reviews',
                'location' => 'Berlin, Germany',
                'address' => 'Kurfurstendamm 213, 10719 Berlin, Germany',
                'phone' => '+49 30 1234 5678',
                'website' => 'www.gld-logistics.com',
                'certification' => 'ISO 9001:2015 Certified',
                'response_time' => '< 2 hours',
                'logo_url' => 'https://images.unsplash.com/photo-1560472355-536de3962603?auto=format&fit=crop&w=400&q=80',
                'map_url' => 'https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=900&q=80',
            ],
            'stats' => [
                ['value' => '50k+', 'label' => 'Annual Shipments'],
                ['value' => '99.8%', 'label' => 'Delivery Rate'],
                ['value' => '12', 'label' => 'Global Offices'],
            ],
            'services' => [
                ['title' => 'Express Freight', 'description' => 'Time-sensitive road transport across the EU.', 'icon' => 'local_shipping'],
                ['title' => 'Smart Warehousing', 'description' => 'Automated inventory management and fulfillment.', 'icon' => 'inventory_2'],
                ['title' => 'Global Air Cargo', 'description' => 'Priority air freight with real-time tracking.', 'icon' => 'flight'],
                ['title' => 'Customs Clearance', 'description' => 'Expert handling of cross-border regulations.', 'icon' => 'gavel'],
            ],
            'reviews' => [
                [
                    'initials' => 'SC',
                    'name' => 'SwiftCommerce Inc.',
                    'date' => '2 days ago',
                    'rating' => 5,
                    'body' => 'Exceptional service on our last three transatlantic shipments. Their communication is proactive and the custom dashboard makes tracking effortless.',
                ],
                [
                    'initials' => 'NB',
                    'name' => 'Nordic Build Group',
                    'date' => '1 week ago',
                    'rating' => 4,
                    'body' => 'Reliable partner for heavy machinery transport. One minor delay due to weather, but they handled the rescheduling perfectly.',
                ],
            ],
            'accreditations' => ['IATA', 'FIATA', 'AEO', 'Lean Six Sigma'],
            'navItems' => $this->navItems(),
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

    private function navItems(): array
    {
        return [
            ['label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('supplier.dashboard'), 'active' => false],
            ['label' => 'Offres', 'icon' => 'local_offer', 'href' => route('supplier.offers'), 'active' => false],
            ['label' => 'Demandes', 'icon' => 'assignment', 'href' => route('supplier.dashboard'), 'active' => false],
            ['label' => 'Messages', 'icon' => 'mail', 'href' => 'mailto:support@supplylink.test', 'active' => false],
            ['label' => 'Profile', 'icon' => 'person', 'href' => route('supplier.profile'), 'active' => true],
        ];
    }
}
