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
    <form method="GET" class="mb-8 grid gap-4 glass-card p-5 md:grid-cols-2 xl:grid-cols-6">
        <div class="xl:col-span-2">
            <label class="saas-label-muted">{{ __('products.search') }}</label>
            <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" class="saas-input">
        </div>
        <div>
            <label class="saas-label-muted">{{ __('products.price') }} min</label>
            <input type="number" step="0.01" name="min_price" value="{{ $filters['min_price'] ?? '' }}" class="saas-input">
        </div>
        <div>
            <label class="saas-label-muted">{{ __('products.price') }} max</label>
            <input type="number" step="0.01" name="max_price" value="{{ $filters['max_price'] ?? '' }}" class="saas-input">
        </div>
        <div>
            <label class="saas-label-muted">{{ __('nav.suppliers') }}</label>
            <select name="supplier" class="saas-input">
                <option value="">{{ __('common.all') }}</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected(($filters['supplier'] ?? '') == $supplier->id)>{{ $supplier->company_name ?: $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col justify-end gap-3">
            <label class="flex items-center gap-2 text-sm text-on-surface-variant">
                <input type="checkbox" name="in_stock" value="1" @checked(!empty($filters['in_stock'])) class="saas-checkbox">
                {{ __('common.in_stock') }}
            </label>
            <button type="submit" class="saas-btn-secondary w-full">{{ __('common.filter') }}</button>
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
                <a href="{{ route('products.show', $product) }}" class="group glass-card overflow-hidden transition hover:-translate-y-1">
                    <div class="aspect-square bg-surface-container">
                        @if ($product->imageUrl())
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition group-hover:scale-105">
                        @else
                            <div class="flex h-full items-center justify-center text-outline">
                                <span class="material-symbols-outlined text-5xl">inventory_2</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-xs font-medium text-secondary">{{ $product->fournisseur?->company_name ?: $product->fournisseur?->name }}</p>
                        <h3 class="mt-1 font-bold text-on-surface group-hover:text-primary">{{ $product->name }}</h3>
                        <p class="mt-2 text-lg font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-8 saas-pagination">{{ $products->links() }}</div>
    @endif
@endsection
