@extends('layouts.saas', [
    'title' => ($supplier->company_name ?: $supplier->name) . ' - ' . __('common.app_name'),
    'pageTitle' => $supplier->company_name ?: $supplier->name,
    'pageSubtitle' => $supplier->email,
    'navActive' => 'suppliers',
])

@section('header-actions')
    <a href="{{ route('messages.show', $supplier) }}" class="saas-btn-primary">
        <span class="material-symbols-outlined">chat</span>
        {{ __('products.contact_supplier') }}
    </a>
    <a href="{{ route('client.demandes.index') }}" class="saas-btn-secondary">
        <span class="material-symbols-outlined">assignment</span>
        {{ __('common.new_request') }}
    </a>
@endsection

@section('content')
    <a href="{{ route('client.suppliers.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <section>
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-xl font-bold">{{ __('nav.products') }}</h3>
            <a href="{{ route('products.catalog', ['supplier' => $supplier->id]) }}" class="text-sm font-medium text-primary hover:underline">{{ __('products.catalog_title') }}</a>
        </div>

        @if ($products->isEmpty())
            <div class="saas-card border-dashed text-center text-on-surface-variant">{{ __('common.no_results') }}</div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                    <article class="glass-card overflow-hidden">
                        <div class="aspect-square bg-surface-container">
                            @if ($product->imageUrl())
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full items-center justify-center text-outline">
                                    <span class="material-symbols-outlined text-4xl">inventory_2</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold">{{ $product->name }}</h4>
                            <p class="mt-1 text-sm font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</p>
                            <div class="mt-3 flex gap-2">
                                <a href="{{ route('products.show', $product) }}" class="saas-btn-secondary flex-1 py-2 text-xs">{{ __('common.view') }}</a>
                                <a href="{{ route('messages.show', ['user' => $supplier, 'product' => $product->id]) }}" class="flex-1 rounded-lg bg-secondary-container py-2 text-center text-xs font-semibold text-on-secondary-container">{{ __('products.request_info') }}</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-8">{{ $products->links() }}</div>
        @endif
    </section>
@endsection
