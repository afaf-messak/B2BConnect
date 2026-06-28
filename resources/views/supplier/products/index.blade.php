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
    <form method="GET" class="mb-8 grid gap-4 glass-card p-5 md:grid-cols-[minmax(280px,1fr)_200px_160px] xl:grid-cols-[minmax(360px,1fr)_220px_180px] items-end">
        <div class="min-w-0">
            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ __('products.search') }}</label>
            <div class="relative">
                <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-[20px] text-outline">search</span>
                <input id="product-search" type="search" name="q" value="{{ $filters['q'] }}" placeholder="{{ __('products.search_placeholder') }}" class="saas-input h-14 rounded-2xl pl-12 pr-4 shadow-sm">
            </div>
        </div>
        <div class="min-w-0">
            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ __('products.stock_filter') }}</label>
            <select name="stock" class="saas-input h-14 rounded-2xl">
                <option value="">{{ __('common.all') }}</option>
                <option value="in_stock" @selected($filters['stock'] === 'in_stock')>{{ __('common.in_stock') }}</option>
                <option value="out_of_stock" @selected($filters['stock'] === 'out_of_stock')>{{ __('common.out_of_stock') }}</option>
            </select>
        </div>
        <button type="submit" class="saas-btn-primary inline-flex h-14 w-full items-center justify-center gap-2 rounded-2xl px-5 text-sm font-semibold md:w-auto">
            <span class="material-symbols-outlined text-[20px]">tune</span>
            {{ __('common.filter') }}
        </button>
    </form>

    @if ($products->isEmpty())
        <div class="saas-card border-dashed text-center">
            <span class="material-symbols-outlined mb-4 text-5xl text-outline">inventory_2</span>
            <h3 class="text-lg font-semibold text-on-surface">{{ __('products.empty_title') }}</h3>
            <p class="mt-2 text-sm text-on-surface-variant">{{ __('products.empty_text') }}</p>
            <a href="{{ route('supplier.products.create') }}" class="saas-btn-primary mt-6">{{ __('products.add') }}</a>
        </div>
    @else
        <div class="grid items-stretch gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <article class="glass-card flex h-full min-h-[430px] flex-col overflow-hidden p-0 transition hover:-translate-y-0.5">
                    <div class="h-48 shrink-0 bg-surface-container sm:h-52">
                        @if ($product->imageUrl())
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full items-center justify-center text-outline">
                                <span class="material-symbols-outlined text-5xl">image</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-1 flex-col gap-3 p-4">
                        <div class="flex min-h-[42px] items-start justify-between gap-3">
                            <h3 class="min-w-0 text-sm font-semibold leading-snug text-on-surface">{{ $product->name }}</h3>
                            <span class="shrink-0 rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100' }}">
                                {{ $product->stock > 0 ? $product->stock . ' ' . __('common.in_stock') : __('common.out_of_stock') }}
                            </span>
                        </div>
                        <p class="min-h-[36px] text-xs leading-5 text-on-surface-variant line-clamp-2">{{ $product->description ?: __('products.no_description') }}</p>
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-base font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</p>
                        </div>
                        <div class="mt-auto grid grid-cols-3 gap-2 pt-3">
                            <a href="{{ route('products.show', $product) }}" class="saas-btn-secondary inline-flex min-w-0 items-center justify-center gap-1.5 rounded-xl px-2 py-2 text-xs font-semibold">
                                <span class="material-symbols-outlined text-base">visibility</span>
                                <span class="truncate">{{ __('common.view') }}</span>
                            </a>
                            <a href="{{ route('supplier.products.edit', $product) }}" class="saas-btn-primary inline-flex min-w-0 items-center justify-center gap-1.5 rounded-xl px-2 py-2 text-xs font-semibold">
                                <span class="material-symbols-outlined text-base">edit</span>
                                <span class="truncate">{{ __('common.edit') }}</span>
                            </a>
                            <form method="POST" action="{{ route('supplier.products.destroy', $product) }}" onsubmit="return confirm('{{ __('common.confirm_delete') }}')" class="min-w-0">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex w-full min-w-0 items-center justify-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-2 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100 dark:border-red-800 dark:bg-transparent dark:text-red-300 dark:hover:bg-red-950">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                    <span class="truncate">{{ __('common.delete') }}</span>
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
