<?php

namespace App\Support;

use App\Models\User;

class Navigation
{
    public static function forUser(?User $user, string $active = 'dashboard'): array
    {
        return match ($user?->role) {
            User::ROLE_ADMIN => self::adminItems($active),
            User::ROLE_SUPPLIER => self::supplierItems($active, $user),
            default => self::clientItems($active, $user),
        };
    }

    public static function supplierItems(string $active = 'dashboard', ?User $user = null): array
    {
        $unread = $user?->unreadMessagesCount() ?? 0;

        $items = [
            ['key' => 'dashboard', 'label' => __('nav.dashboard'), 'icon' => 'dashboard', 'href' => route('supplier.dashboard')],
            ['key' => 'company', 'label' => __('nav.company_profile'), 'icon' => 'storefront', 'href' => route('supplier.profile')],
            ['key' => 'products', 'label' => __('nav.products'), 'icon' => 'inventory_2', 'href' => route('supplier.products.index')],
            ['key' => 'demandes', 'label' => __('nav.demandes'), 'icon' => 'assignment', 'href' => route('supplier.demandes.index')],
            ['key' => 'offers', 'label' => __('nav.sent_offers'), 'icon' => 'local_offer', 'href' => route('supplier.offers')],
            ['key' => 'messages', 'label' => __('nav.messages'), 'icon' => 'mail', 'href' => route('messages.index'), 'badge' => $unread],
            ['key' => 'orders', 'label' => __('nav.orders'), 'icon' => 'shopping_cart', 'href' => route('supplier.orders.index')],
            ['key' => 'settings', 'label' => __('nav.settings'), 'icon' => 'settings', 'href' => route('supplier.settings')],
        ];

        return self::markActive($items, $active);
    }

    public static function clientItems(string $active = 'dashboard', ?User $user = null): array
    {
        $unread = $user?->unreadMessagesCount() ?? 0;

        $items = [
            ['key' => 'dashboard', 'label' => __('nav.dashboard'), 'icon' => 'dashboard', 'href' => route('client.dashboard')],
            ['key' => 'demandes', 'label' => __('nav.my_requests'), 'icon' => 'assignment', 'href' => route('client.demandes.index')],
            ['key' => 'offers', 'label' => __('nav.offers_received'), 'icon' => 'local_offer', 'href' => route('client.offers.index')],
            ['key' => 'marketplace', 'label' => __('nav.marketplace'), 'icon' => 'storefront', 'href' => route('marketplace.suppliers.index')],
            ['key' => 'favorites', 'label' => __('nav.favorites'), 'icon' => 'favorite', 'href' => route('client.favorites.index')],
            ['key' => 'products', 'label' => __('nav.products'), 'icon' => 'shopping_bag', 'href' => route('products.catalog')],
            ['key' => 'messages', 'label' => __('nav.messages'), 'icon' => 'mail', 'href' => route('messages.index'), 'badge' => $unread],
            ['key' => 'orders', 'label' => __('nav.orders'), 'icon' => 'shopping_cart', 'href' => route('client.orders.index')],
            ['key' => 'settings', 'label' => __('nav.settings'), 'icon' => 'settings', 'href' => route('client.settings')],
        ];

        return self::markActive($items, $active);
    }

    public static function adminItems(string $active = 'dashboard'): array
    {
        $items = [
            ['key' => 'dashboard', 'label' => __('nav.admin.dashboard'), 'icon' => 'dashboard', 'href' => route('admin.dashboard')],
            ['key' => 'users', 'label' => __('nav.admin.users'), 'icon' => 'group', 'href' => route('admin.users.index')],
            ['key' => 'moderation', 'label' => __('nav.admin.suppliers_validation'), 'icon' => 'verified_user', 'href' => route('admin.moderation')],
            ['key' => 'products', 'label' => __('nav.admin.products'), 'icon' => 'inventory_2', 'href' => route('admin.products.index')],
            ['key' => 'demandes', 'label' => __('nav.admin.demandes'), 'icon' => 'assignment', 'href' => route('admin.demandes.index')],
            ['key' => 'offers', 'label' => __('nav.admin.offers'), 'icon' => 'request_quote', 'href' => route('admin.offers.index')],
            ['key' => 'orders', 'label' => __('nav.admin.orders'), 'icon' => 'shopping_cart', 'href' => route('admin.orders.index')],
            ['key' => 'messages', 'label' => __('nav.admin.messages'), 'icon' => 'mail', 'href' => route('admin.messages.index')],
            ['key' => 'statistics', 'label' => __('nav.admin.analytics'), 'icon' => 'analytics', 'href' => route('admin.statistics')],
            ['key' => 'settings', 'label' => __('nav.admin.settings'), 'icon' => 'settings', 'href' => route('admin.settings')],
        ];

        return self::markActive($items, $active);
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return array<int, array<string, mixed>>
     */
    private static function markActive(array $items, string $active): array
    {
        return array_map(function (array $item) use ($active) {
            $item['active'] = $item['key'] === $active;

            return $item;
        }, $items);
    }
}
