@extends('layouts.saas', ['navActive' => 'orders'])

@section('content')
    <section class="saas-panel">
        <div class="saas-panel-header">
            <h3 class="text-lg font-bold text-on-surface">{{ __('nav.orders') }}</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('orders.reference') }}</th>
                        <th>{{ __('orders.product') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('products.price') }}</th>
                        <th>{{ __('orders.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="font-mono text-sm">{{ $order->reference ?: '#'.$order->id }}</td>
                            <td>
                                <p class="font-semibold">{{ $order->product_name ?: $order->demande?->title ?: '—' }}</p>
                                @if ($order->user && auth()->user()->isAdmin())
                                    <p class="text-xs text-on-surface-variant">{{ $order->user->name }}</p>
                                @endif
                            </td>
                            <td><span class="saas-badge saas-badge-primary">{{ ucfirst($order->status) }}</span></td>
                            <td class="font-bold text-primary">{{ number_format($order->total_price ?? 0, 2) }} {{ __('common.currency') }}</td>
                            <td class="text-on-surface-variant">{{ $order->ordered_at?->format('d/m/Y') ?? $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($orders->hasPages())
            <div class="saas-panel-footer saas-pagination">{{ $orders->links() }}</div>
        @endif
    </section>
@endsection
