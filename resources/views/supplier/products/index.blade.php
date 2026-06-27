@extends('layouts.saas', [
    'title' => __('products.title') . ' - ' . __('common.app_name'),
    'pageTitle' => __('products.title'),
    'pageSubtitle' => __('products.subtitle'),
    'navActive' => 'products',
])

@section('header-actions')
    <a href="{{ route('supplier.products.create') }}" class="saas-btn-primary">
        <span class="material-symbols-outlined text-lg">add</span>
        {{ __('products.add') }}
    </a>
@endsection

@section('content')
    <form method="GET" class="mb-8 flex flex-wrap items-end gap-4 glass-card p-5">
        <div class="min-w-[220px] flex-1">
            <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ __('products.search') }}</label>
            <input type="search" name="q" value="{{ $filters['q'] }}" placeholder="{{ __('products.search_placeholder') }}" class="saas-input">
        </div>
        <div>
            <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ __('products.stock_filter') }}</label>
            <select name="stock" class="saas-input">
                <option value="">{{ __('common.all') }}</option>
                <option value="in_stock" @selected($filters['stock'] === 'in_stock')>{{ __('common.in_stock') }}</option>
                <option value="out_of_stock" @selected($filters['stock'] === 'out_of_stock')>{{ __('common.out_of_stock') }}</option>
            </select>
        </div>
        <button type="submit" class="rounded-xl bg-secondary-container px-5 py-2.5 text-sm font-semibold text-on-secondary-container">{{ __('common.filter') }}</button>
    </form>

    @if ($products->isEmpty())
        <div class="saas-card border-dashed text-center">
            <span class="material-symbols-outlined mb-4 text-5xl text-outline">inventory_2</span>
            <h3 class="text-lg font-semibold text-on-surface">{{ __('products.empty_title') }}</h3>
            <p class="mt-2 text-sm text-on-surface-variant">{{ __('products.empty_text') }}</p>
            <a href="{{ route('supplier.products.create') }}" class="saas-btn-primary mt-6">{{ __('products.add') }}</a>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <article class="glass-card overflow-hidden transition hover:-translate-y-0.5">
                    <div class="aspect-[4/3] bg-surface-container">
                        @if ($product->imageUrl())
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full items-center justify-center text-outline">
                                <span class="material-symbols-outlined text-5xl">image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-lg font-bold text-on-surface">{{ $product->name }}</h3>
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100' }}">
                                {{ $product->stock > 0 ? $product->stock . ' ' . __('common.in_stock') : __('common.out_of_stock') }}
                            </span>
                        </div>
                        <p class="mt-2 line-clamp-2 text-sm text-on-surface-variant">{{ $product->description ?: __('products.no_description') }}</p>
                        <p class="mt-4 text-xl font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</p>
                        <div class="mt-5 flex gap-2">
                            <a href="{{ route('products.show', $product) }}" class="saas-btn-secondary flex-1 py-2">{{ __('common.view') }}</a>
                            <a href="{{ route('supplier.products.edit', $product) }}" class="flex-1 rounded-xl bg-secondary-container py-2 text-center text-sm font-semibold text-on-secondary-container">{{ __('common.edit') }}</a>
                            <form method="POST" action="{{ route('supplier.products.destroy', $product) }}" onsubmit="return confirm('{{ __('common.confirm_delete') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="rounded-xl border border-red-200 px-3 py-2 text-error hover:bg-red-50 dark:border-red-800 dark:hover:bg-red-950">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-8">{{ $products->links() }}</div>
    @endif
@endsection
