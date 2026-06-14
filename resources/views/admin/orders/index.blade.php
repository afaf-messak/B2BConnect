@extends('layouts.saas', ['navActive' => 'orders'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />
    <x-admin.stats-row :stats="$stats" />

    <x-admin.filter-bar :action="route('admin.orders.index')">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[200px] flex-1">
        <select name="status" class="saas-input w-auto">
            <option value="">{{ __('common.status') }}</option>
            @foreach (['pending', 'processing', 'completed', 'cancelled'] as $s)
                <option value="{{ $s }}" @selected(($filters['status'] ?? '') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </x-admin.filter-bar>

    <section class="saas-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('orders.reference') }}</th>
                        <th>{{ __('roles.client') }}</th>
                        <th>{{ __('roles.supplier') }}</th>
                        <th>{{ __('orders.product') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('products.price') }}</th>
                        <th>{{ __('orders.date') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="font-mono text-sm">{{ $order->reference ?: '#'.$order->id }}</td>
                            <td>{{ $order->user?->name }}</td>
                            <td>{{ $order->supplier?->company_name ?: $order->supplier?->name ?: '—' }}</td>
                            <td>{{ $order->product_name ?: $order->product?->name ?: $order->demande?->title ?: '—' }}</td>
                            <td><span class="saas-badge saas-badge-primary">{{ ucfirst($order->status) }}</span></td>
                            <td class="font-bold text-primary">{{ number_format($order->total_price ?? 0, 2) }} {{ __('common.currency') }}</td>
                            <td>{{ $order->ordered_at?->format('d/m/Y') ?? $order->created_at?->format('d/m/Y') }}</td>
                            <td class="text-end"><a href="{{ route('admin.orders.show', $order) }}" class="saas-btn-secondary saas-btn-sm">{{ __('common.view') }}</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())<div class="border-t px-6 py-4">{{ $orders->links() }}</div>@endif
    </section>
@endsection
