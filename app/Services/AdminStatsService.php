<?php

namespace App\Services;

use App\Models\Demande;
use App\Models\DocumentVerification;
use App\Models\Message;
use App\Models\Offre;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdminStatsService
{
    /**
     * @return array<int, array{label: string, value: int|string, icon: string}>
     */
    public function dashboardCards(): array
    {
        return [
            ['label' => __('admin.stats.total_users'), 'value' => User::count(), 'icon' => 'group'],
            ['label' => __('admin.stats.total_clients'), 'value' => User::where('role', User::ROLE_CLIENT)->count(), 'icon' => 'shopping_cart'],
            ['label' => __('admin.stats.total_suppliers'), 'value' => User::where('role', User::ROLE_SUPPLIER)->count(), 'icon' => 'storefront'],
            ['label' => __('admin.stats.pending_suppliers'), 'value' => User::where('role', User::ROLE_SUPPLIER)->where('account_status', User::STATUS_PENDING)->count(), 'icon' => 'hourglass_top'],
            ['label' => __('admin.stats.approved_suppliers'), 'value' => User::where('role', User::ROLE_SUPPLIER)->where('account_status', User::STATUS_ACTIVE)->count(), 'icon' => 'verified'],
            ['label' => __('admin.stats.total_products'), 'value' => Product::count(), 'icon' => 'inventory_2'],
            ['label' => __('admin.stats.total_demandes'), 'value' => Demande::count(), 'icon' => 'assignment'],
            ['label' => __('admin.stats.total_offres'), 'value' => Offre::count(), 'icon' => 'request_quote'],
            ['label' => __('admin.stats.total_orders'), 'value' => Order::count(), 'icon' => 'shopping_bag'],
            ['label' => __('admin.stats.total_conversations'), 'value' => $this->conversationCount(), 'icon' => 'forum'],
        ];
    }

    public function conversationCount(): int
    {
        $pairExpression = 'CASE WHEN sender_id < receiver_id '
            ."THEN sender_id || '-' || receiver_id "
            ."ELSE receiver_id || '-' || sender_id END";

        if (DB::getDriverName() === 'mysql') {
            $pairExpression = 'CASE WHEN sender_id < receiver_id '
                ."THEN CONCAT(sender_id, '-', receiver_id) "
                ."ELSE CONCAT(receiver_id, '-', sender_id) END";
        }

        return (int) Message::query()
            ->selectRaw("COUNT(DISTINCT {$pairExpression}) as total")
            ->value('total');
    }

    /**
     * @return array{labels: list<string>, users: list<int>, orders: list<int>, demandes: list<int>}
     */
    public function growthChart(int $months = 6): array
    {
        $labels = [];
        $users = [];
        $orders = [];
        $demandes = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();
            $labels[] = $date->format('M Y');
            $users[] = User::whereBetween('created_at', [$start, $end])->count();
            $orders[] = Order::whereBetween('created_at', [$start, $end])->count();
            $demandes[] = Demande::whereBetween('created_at', [$start, $end])->count();
        }

        return compact('labels', 'users', 'orders', 'demandes');
    }

    /**
     * @return array{labels: list<string>, values: list<int>}
     */
    public function roleDistribution(): array
    {
        return [
            'labels' => [__('roles.client'), __('roles.supplier'), __('roles.admin')],
            'values' => [
                User::where('role', User::ROLE_CLIENT)->count(),
                User::where('role', User::ROLE_SUPPLIER)->count(),
                User::where('role', User::ROLE_ADMIN)->count(),
            ],
        ];
    }

    /**
     * @return Collection<int, User>
     */
    public function topSuppliers(int $limit = 5): Collection
    {
        return User::query()
            ->where('role', User::ROLE_SUPPLIER)
            ->withCount(['offres', 'products', 'supplierOrders'])
            ->orderByDesc('offres_count')
            ->limit($limit)
            ->get();
    }

    /**
     * @return Collection<int, Product>
     */
    public function topProducts(int $limit = 5): Collection
    {
        return Product::query()
            ->with('fournisseur')
            ->withCount('orders')
            ->orderByDesc('orders_count')
            ->limit($limit)
            ->get();
    }

    /**
     * @return Collection<int, User>
     */
    public function topClients(int $limit = 5): Collection
    {
        return User::query()
            ->where('role', User::ROLE_CLIENT)
            ->withCount(['demandes', 'orders'])
            ->orderByDesc('demandes_count')
            ->limit($limit)
            ->get();
    }

    /**
     * @return array<int, array{type: string, title: string, subtitle: string, time: string}>
     */
    public function recentActivity(int $limit = 8): array
    {
        $items = collect();

        User::latest()->limit(3)->get()->each(function (User $user) use ($items) {
            $items->push([
                'type' => 'user',
                'icon' => 'person_add',
                'title' => $user->name,
                'subtitle' => __('admin.activity.user_registered', ['role' => ucfirst($user->role ?? 'client')]),
                'time' => $user->created_at?->diffForHumans() ?? '',
                'at' => $user->created_at,
            ]);
        });

        Demande::with('user')->latest()->limit(3)->get()->each(function (Demande $demande) use ($items) {
            $items->push([
                'type' => 'demande',
                'icon' => 'assignment',
                'title' => $demande->title,
                'subtitle' => $demande->user?->name ?? __('roles.client'),
                'time' => $demande->created_at?->diffForHumans() ?? '',
                'at' => $demande->created_at,
            ]);
        });

        Order::with('user')->latest()->limit(3)->get()->each(function (Order $order) use ($items) {
            $items->push([
                'type' => 'order',
                'icon' => 'shopping_cart',
                'title' => $order->reference ?: '#'.$order->id,
                'subtitle' => $order->user?->name ?? '—',
                'time' => $order->created_at?->diffForHumans() ?? '',
                'at' => $order->created_at,
            ]);
        });

        DocumentVerification::with('user')->where('status', 'pending')->latest()->limit(2)->get()->each(function (DocumentVerification $doc) use ($items) {
            $items->push([
                'type' => 'moderation',
                'icon' => 'verified_user',
                'title' => $doc->user?->company_name ?: $doc->user?->name ?? '—',
                'subtitle' => __('admin.activity.supplier_pending'),
                'time' => $doc->created_at?->diffForHumans() ?? '',
                'at' => $doc->created_at,
            ]);
        });

        return $items->sortByDesc('at')->take($limit)->values()->all();
    }
}
