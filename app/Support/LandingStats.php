<?php

namespace App\Support;

use App\Models\Demande;
use App\Models\Offre;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;

class LandingStats
{
    /**
     * @return list<array{value: int, suffix: string, label: string}>
     */
    public static function items(): array
    {
        return [
            [
                'value' => self::activeSuppliers(),
                'suffix' => '',
                'label' => __('landing.stats.suppliers'),
            ],
            [
                'value' => Product::query()->where('is_active', true)->count(),
                'suffix' => '',
                'label' => __('landing.stats.products'),
            ],
            [
                'value' => Demande::query()->count(),
                'suffix' => '',
                'label' => __('landing.stats.demandes'),
            ],
            [
                'value' => Order::query()->count(),
                'suffix' => '',
                'label' => __('landing.stats.orders'),
            ],
        ];
    }

    /**
     * @return array{
     *     rfqs: int,
     *     offers: int,
     *     orders: int,
     *     rfq_progress: int,
     *     conversion: int,
     *     activity: list<string>,
     *     products: list<array{name: string, price: string}>,
     *     suppliers: int,
     * }
     */
    public static function heroDashboard(): array
    {
        $rfqs = Demande::query()
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        $offers = Offre::query()->count();
        $orders = Order::query()->count();
        $totalDemandes = max(Demande::query()->count(), 1);

        return [
            'rfqs' => $rfqs,
            'offers' => $offers,
            'orders' => $orders,
            'rfq_progress' => (int) min(100, round(($rfqs / $totalDemandes) * 100)),
            'conversion' => $offers > 0 ? (int) min(100, round(($orders / $offers) * 100)) : 0,
            'activity' => self::recentActivity(),
            'products' => self::featuredProducts(),
            'suppliers' => self::activeSuppliers(),
        ];
    }

    public static function activeSuppliers(): int
    {
        return User::query()
            ->where('role', User::ROLE_SUPPLIER)
            ->where('account_status', User::STATUS_ACTIVE)
            ->count();
    }

    /**
     * @return list<string>
     */
    private static function recentActivity(): array
    {
        $items = collect();

        Offre::query()
            ->with('user')
            ->latest()
            ->limit(1)
            ->get()
            ->each(function (Offre $offre) use ($items): void {
                $supplier = $offre->user?->company_name ?: $offre->user?->name ?: __('landing.hero.activity_unknown_supplier');
                $items->push(__('landing.hero.activity_new_offer', ['supplier' => $supplier]));
            });

        Demande::query()
            ->withCount('offres')
            ->latest()
            ->limit(1)
            ->get()
            ->each(function (Demande $demande) use ($items): void {
                $items->push(__('landing.hero.activity_rfq_responses', [
                    'id' => $demande->id,
                    'count' => $demande->offres_count,
                ]));
            });

        Order::query()
            ->latest()
            ->limit(1)
            ->get()
            ->each(function (Order $order) use ($items): void {
                $label = match ($order->status) {
                    'delivered', 'completed' => __('landing.hero.activity_order_delivered', ['id' => $order->id]),
                    default => __('landing.hero.activity_order_created', ['id' => $order->id]),
                };
                $items->push($label);
            });

        if ($items->isEmpty()) {
            return [
                __('landing.hero.activity_empty'),
            ];
        }

        return $items->take(3)->values()->all();
    }

    /**
     * @return list<array{name: string, price: string}>
     */
    private static function featuredProducts(): array
    {
        /** @var Collection<int, Product> $products */
        $products = Product::query()
            ->where('is_active', true)
            ->latest()
            ->limit(3)
            ->get(['name', 'price']);

        if ($products->isEmpty()) {
            return [];
        }

        return $products->map(fn (Product $product) => [
            'name' => $product->name,
            'price' => number_format((float) $product->price, 0, ',', ' ').' MAD',
        ])->all();
    }
}
