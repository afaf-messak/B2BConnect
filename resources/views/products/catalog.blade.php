@extends($navItems ? 'layouts.saas' : 'layouts.saas-guest', [
    'title' => __('products.catalog_title') . ' - ' . __('common.app_name'),
    'pageTitle' => __('products.catalog_title'),
    'pageSubtitle' => __('products.catalog_subtitle'),
    'navActive' => 'products',
    'showSidebar' => (bool) $navItems,
])

@section('header-actions')
    @guest
        <a href="{{ route('login') }}" class="saas-btn-primary">{{ __('common.login') }}</a>
    @endguest
@endsection

@section('content')
    <form method="GET" class="mb-8 grid gap-4 glass-card p-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-8">
        <div class="saas-form-group md:col-span-2">
            <label for="catalog-q" class="saas-label-muted">{{ __('products.search') }}</label>
            <div class="relative">
                <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[20px] text-outline">search</span>
                <input id="catalog-q" type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('products.search_placeholder') }}" class="saas-input h-12 rounded-xl pl-10">
            </div>
        </div>
        <div class="saas-form-group">
            <label for="catalog-min-price" class="saas-label-muted">{{ __('products.price') }} min</label>
            <input id="catalog-min-price" type="number" step="0.01" min="0" inputmode="decimal" name="min_price" value="{{ $filters['min_price'] ?? '' }}" placeholder="0" class="saas-input h-12 rounded-xl">
        </div>
        <div class="saas-form-group">
            <label for="catalog-max-price" class="saas-label-muted">{{ __('products.price') }} max</label>
            <input id="catalog-max-price" type="number" step="0.01" min="0" inputmode="decimal" name="max_price" value="{{ $filters['max_price'] ?? '' }}" placeholder="5000" class="saas-input h-12 rounded-xl">
        </div>
        <div class="saas-form-group">
            <label for="catalog-category" class="saas-label-muted">{{ __('demandes.category') }}</label>
            <select id="catalog-category" name="category" class="saas-input h-12 rounded-xl">
                <option value="">{{ __('common.all') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(($filters['category'] ?? '') === $category)>{{ \App\Models\Product::localizedCategoryName($category) }}</option>
                @endforeach
            </select>
        </div>
        <div class="saas-form-group xl:col-span-2">
            <label for="catalog-supplier" class="saas-label-muted">{{ __('nav.suppliers') }}</label>
            <select id="catalog-supplier" name="supplier" class="saas-input h-12 rounded-xl">
                <option value="">{{ __('common.all') }}</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected(($filters['supplier'] ?? '') == $supplier->id)>{{ $supplier->company_name ?: $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col justify-end gap-3">
            <label class="flex h-12 items-center gap-2 rounded-xl border border-outline-variant/70 bg-white px-4 text-sm font-medium text-on-surface-variant dark:bg-surface-container">
                <input type="checkbox" name="in_stock" value="1" @checked(!empty($filters['in_stock'])) class="saas-checkbox">
                {{ __('common.in_stock') }}
            </label>
        </div>
        <div class="flex items-end gap-2 md:col-span-2 lg:col-span-3 xl:col-span-8 xl:justify-end">
            <a href="{{ route('products.catalog') }}" class="saas-btn-secondary h-12 flex-1 md:flex-none">
                <span class="material-symbols-outlined text-[20px]">restart_alt</span>
                {{ __('common.cancel') }}
            </a>
            <button type="submit" class="saas-btn-primary h-12 flex-1 md:flex-none">
                <span class="material-symbols-outlined text-[20px]">tune</span>
                {{ __('common.filter') }}
            </button>
        </div>
    </form>

    @if ($products->isEmpty())
        <div class="saas-card border-dashed text-center">
            <span class="material-symbols-outlined mb-4 text-5xl text-outline">shopping_bag</span>
            <h3 class="text-lg font-semibold">{{ __('common.no_results') }}</h3>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
                @php
                    $productSlug = \Illuminate\Support\Str::slug($product->name);
                    $containImage = in_array($productSlug, [
                        'hp-laserjet-pro-m404dn',
                        'carton-double-cannelure-60x40x40-cm',
                        'palette-europe-epal-1200x800-mm',
                        'casque-de-securite-3m-securefit',
                    ], true);
                @endphp
                <a href="{{ route('products.show', $product) }}" class="group glass-card overflow-hidden transition hover:-translate-y-1">
                    <div class="relative aspect-square overflow-hidden {{ $containImage ? 'bg-white' : 'bg-surface-container' }}">
                        @if ($product->imageUrl())
                            <img
                                src="{{ $product->imageUrl() }}"
                                alt="{{ $product->localizedName() }}"
                                class="h-full w-full transition group-hover:scale-105 {{ $containImage ? 'object-contain p-4' : 'object-cover' }}"
                            >
                        @else
                            <div class="flex h-full items-center justify-center text-outline">
                                <span class="material-symbols-outlined text-5xl">inventory_2</span>
                            </div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/45 to-transparent p-4 pt-12">
                            <h3 class="max-h-12 overflow-hidden text-base font-bold leading-tight text-white">{{ $product->localizedName() }}</h3>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-xs font-medium text-secondary">{{ $product->fournisseur?->company_name ?: $product->fournisseur?->name }}</p>
                        @if ($product->localizedCategory())
                            <p class="mt-1 text-xs font-medium text-on-surface-variant">{{ $product->localizedCategory() }}</p>
                        @endif
                        <p class="mt-2 text-lg font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-8 saas-pagination">{{ $products->links() }}</div>
    @endif
@endsection
