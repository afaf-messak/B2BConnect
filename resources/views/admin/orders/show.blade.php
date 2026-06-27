@extends('layouts.saas', ['navActive' => 'orders'])

@section('content')
    <a href="{{ route('admin.orders.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <div class="grid gap-6 lg:grid-cols-3">
        <article class="saas-card lg:col-span-2">
            <dl class="grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('roles.client') }}</dt><dd class="mt-1 font-semibold">{{ $order->user?->name }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('roles.supplier') }}</dt><dd class="mt-1 font-semibold">{{ $order->supplier?->company_name ?: $order->supplier?->name ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('orders.product') }}</dt><dd class="mt-1 font-semibold">{{ $order->product_name ?: $order->product?->name ?: $order->demande?->title ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('orders.quantity') ?? 'Quantity' }}</dt><dd class="mt-1 font-semibold">{{ $order->quantity ?? 1 }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('products.price') }}</dt><dd class="mt-1 font-bold text-primary">{{ number_format($order->total_price ?? 0, 2) }} {{ __('common.currency') }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('orders.date') }}</dt><dd class="mt-1 font-semibold">{{ $order->ordered_at?->format('d/m/Y') ?? $order->created_at?->format('d/m/Y') }}</dd></div>
            </dl>
        </article>
        <aside class="saas-card">
            <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="space-y-4">
                @csrf
                @method('PATCH')
                <div class="saas-form-group">
                    <label class="saas-label">{{ __('common.status') }}</label>
                    <select name="status" class="saas-input">
                        @foreach (['pending', 'processing', 'completed', 'cancelled'] as $s)
                            <option value="{{ $s }}" @selected($order->status === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="saas-btn-primary w-full">{{ __('admin.update_order_status') }}</button>
            </form>
        </aside>
    </div>
@endsection
