@extends('layouts.saas', ['navActive' => 'orders'])

@section('content')
    @php
        $statusStyles = [
            'draft' => 'bg-surface-container text-on-surface-variant',
            'confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-100',
            'shipped' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-100',
            'delivered' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-100',
            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-100',
        ];
    @endphp

    <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="saas-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-on-surface-variant">{{ __('orders.stats.total') }}</p>
                    <p class="mt-1 text-3xl font-bold text-on-surface">{{ $stats['total'] ?? $orders->total() }}</p>
                </div>
                <span class="material-symbols-outlined text-3xl text-primary">shopping_cart</span>
            </div>
        </div>
        <div class="saas-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-on-surface-variant">{{ __('orders.stats.confirmed') }}</p>
                    <p class="mt-1 text-3xl font-bold text-blue-700 dark:text-blue-200">{{ $stats['confirmed'] ?? 0 }}</p>
                </div>
                <span class="material-symbols-outlined text-3xl text-blue-600">verified</span>
            </div>
        </div>
        <div class="saas-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-on-surface-variant">{{ __('orders.stats.shipped') }}</p>
                    <p class="mt-1 text-3xl font-bold text-amber-700 dark:text-amber-200">{{ $stats['shipped'] ?? 0 }}</p>
                </div>
                <span class="material-symbols-outlined text-3xl text-amber-600">local_shipping</span>
            </div>
        </div>
        <div class="saas-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-on-surface-variant">{{ __('orders.stats.delivered') }}</p>
                    <p class="mt-1 text-3xl font-bold text-green-700 dark:text-green-200">{{ $stats['delivered'] ?? 0 }}</p>
                </div>
                <span class="material-symbols-outlined text-3xl text-green-600">inventory</span>
            </div>
        </div>
    </div>

    @if (auth()->user()->isClient())
        <section class="saas-panel mb-6">
            <div class="saas-panel-header">
                <div>
                    <h3 class="text-lg font-bold text-on-surface">{{ __('orders.create_title') }}</h3>
                    <p class="mt-1 text-sm text-on-surface-variant">{{ __('orders.create_hint') }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('client.orders.store') }}" class="grid gap-4 p-6 md:grid-cols-[minmax(0,1fr)_160px_auto] md:items-end">
                @csrf
                <div class="saas-form-group">
                    <label for="order-product" class="saas-label-muted">{{ __('orders.product') }}</label>
                    <select id="order-product" name="product_id" class="saas-input h-12 rounded-xl" required>
                        <option value="">{{ __('orders.choose_product') }}</option>
                        @foreach ($products ?? [] as $product)
                            <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                                {{ $product->localizedName() }} - {{ number_format($product->price, 2) }} {{ __('common.currency') }} - {{ $product->stock }} {{ __('common.in_stock') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="saas-form-group">
                    <label for="order-quantity" class="saas-label-muted">{{ __('orders.quantity') }}</label>
                    <input id="order-quantity" type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" class="saas-input h-12 rounded-xl" required>
                </div>
                <button type="submit" class="saas-btn-primary h-12">
                    <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                    {{ __('orders.create_action') }}
                </button>
            </form>
        </section>
    @endif

    <section class="saas-panel">
        <div class="saas-panel-header">
            <div>
                <h3 class="text-lg font-bold text-on-surface">{{ __('nav.orders') }}</h3>
                <p class="mt-1 text-sm text-on-surface-variant">{{ __('orders.help') }}</p>
            </div>
            <form method="GET" class="flex flex-wrap items-center gap-2">
                <select name="status" class="saas-input h-10 min-w-40 rounded-lg">
                    <option value="">{{ __('orders.filters.all_statuses') }}</option>
                    @foreach (['draft', 'confirmed', 'shipped', 'delivered', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ __('orders.statuses.'.$status) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="saas-btn-primary h-10 rounded-lg">
                    <span class="material-symbols-outlined text-[20px]">tune</span>
                    {{ __('common.filter') }}
                </button>
                @if (! empty($filters['status']))
                    <a href="{{ auth()->user()->isClient() ? route('client.orders.index') : route('supplier.orders.index') }}" class="saas-btn-secondary h-10 rounded-lg" aria-label="{{ __('common.cancel') }}">
                        <span class="material-symbols-outlined text-[20px]">restart_alt</span>
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('orders.reference') }}</th>
                        <th>{{ __('orders.product') }}</th>
                        <th>{{ __('orders.quantity') }}</th>
                        @if (auth()->user()->isClient())
                            <th>{{ __('roles.supplier') }}</th>
                        @else
                            <th>{{ __('roles.client') }}</th>
                        @endif
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('products.price') }}</th>
                        <th>{{ __('orders.date') }}</th>
                        @if (auth()->user()->isClient() || auth()->user()->isSupplier())
                            <th class="text-end">{{ __('common.actions') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="font-mono text-sm">{{ $order->reference ?: '#'.$order->id }}</td>
                            <td>
                                <p class="font-semibold">{{ $order->product_name ?: $order->demande?->title ?: '-' }}</p>
                                @if ($order->demande)
                                    <p class="text-xs text-on-surface-variant">{{ __('nav.my_requests') }}: {{ $order->demande->title }}</p>
                                @endif
                            </td>
                            <td>{{ $order->quantity ?: 1 }}</td>
                            <td>
                                @if (auth()->user()->isClient())
                                    <p class="font-medium">{{ $order->supplier?->company_name ?: $order->supplier?->name ?: '-' }}</p>
                                @else
                                    <p class="font-medium">{{ $order->user?->company_name ?: $order->user?->name ?: '-' }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $order->user?->email }}</p>
                                @endif
                            </td>
                            <td>
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-bold {{ $statusStyles[$order->status] ?? $statusStyles['draft'] }}">
                                    {{ __('orders.statuses.'.$order->status) }}
                                </span>
                            </td>
                            <td class="font-bold text-primary">{{ number_format($order->total_price ?? 0, 2) }} {{ __('common.currency') }}</td>
                            <td class="text-on-surface-variant">{{ $order->ordered_at?->format('d/m/Y') ?? $order->created_at->format('d/m/Y') }}</td>
                            @if (auth()->user()->isClient())
                                <td>
                                    <div class="flex min-w-64 justify-end gap-2">
                                        <form method="POST" action="{{ route('client.orders.update', $order) }}" class="flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" min="1" value="{{ $order->quantity ?: 1 }}" class="saas-input h-10 w-24 rounded-lg" @disabled(in_array($order->status, ['shipped', 'delivered', 'cancelled'], true))>
                                            <button type="submit" class="saas-btn-secondary h-10 px-3" aria-label="{{ __('common.save') }}" @disabled(in_array($order->status, ['shipped', 'delivered', 'cancelled'], true))>
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('client.orders.destroy', $order) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="saas-btn-secondary h-10 px-3 text-red-700 hover:text-red-800" aria-label="{{ __('common.delete') }}" @disabled(in_array($order->status, ['shipped', 'delivered'], true))>
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @elseif (auth()->user()->isSupplier())
                                <td>
                                    <form method="POST" action="{{ route('supplier.orders.update', $order) }}" class="flex min-w-56 justify-end gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="saas-input h-10 min-w-32 rounded-lg">
                                            @foreach (['confirmed', 'shipped', 'delivered', 'cancelled'] as $status)
                                                <option value="{{ $status }}" @selected($order->status === $status)>{{ __('orders.statuses.'.$status) }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="saas-btn-secondary h-10 px-3" aria-label="{{ __('common.save') }}">
                                            <span class="material-symbols-outlined text-[20px]">save</span>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->isClient() || auth()->user()->isSupplier() ? 8 : 7 }}" class="py-12">
                                <div class="mx-auto max-w-md text-center">
                                    <span class="material-symbols-outlined text-5xl text-outline">shopping_cart</span>
                                    <h4 class="mt-3 text-base font-bold text-on-surface">{{ __('orders.empty_title') }}</h4>
                                    <p class="mt-2 text-sm text-on-surface-variant">{{ __('orders.empty_hint') }}</p>
                                    @if (auth()->user()->isClient())
                                        <div class="mt-5 flex flex-wrap justify-center gap-3">
                                            <a href="{{ route('products.catalog') }}" class="saas-btn-primary">{{ __('common.catalogue') }}</a>
                                            <a href="{{ route('client.demandes.index') }}" class="saas-btn-secondary">{{ __('common.new_request') }}</a>
                                        </div>
                                    @else
                                        <div class="mt-5">
                                            <a href="{{ route('supplier.demandes.index') }}" class="saas-btn-primary">{{ __('nav.my_requests') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </td>
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
