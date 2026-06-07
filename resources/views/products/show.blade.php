@extends($navItems ? 'layouts.saas' : 'layouts.saas-guest', [
    'title' => $product->name . ' - ' . __('common.app_name'),
    'pageTitle' => $product->name,
    'pageSubtitle' => $product->fournisseur?->company_name,
    'navActive' => 'products',
    'showSidebar' => (bool) $navItems,
])

@section('content')
    <a href="{{ route('products.catalog') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <div class="grid gap-8 lg:grid-cols-2">
        <div class="overflow-hidden rounded-2xl bg-surface-container shadow-card">
            @if ($product->imageUrl())
                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
            @else
                <div class="flex aspect-square items-center justify-center text-outline">
                    <span class="material-symbols-outlined text-7xl">inventory_2</span>
                </div>
            @endif
        </div>

        <div class="saas-card">
            <p class="text-sm font-semibold uppercase tracking-wide text-secondary">{{ $product->fournisseur?->company_name ?: $product->fournisseur?->name }}</p>
            <h1 class="mt-2 text-3xl font-bold">{{ $product->name }}</h1>
            <p class="mt-4 text-3xl font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</p>
            <div class="mt-4 inline-flex items-center gap-2 rounded-full px-3 py-1 text-sm font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-red-100 text-red-800' }}">
                {{ $product->stock > 0 ? $product->stock . ' ' . __('common.in_stock') : __('common.out_of_stock') }}
            </div>
            <div class="mt-6 border-t border-outline-variant/20 pt-6">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-on-surface-variant">{{ __('products.description') }}</h2>
                <p class="mt-3 whitespace-pre-line text-sm leading-relaxed">{{ $product->description ?: __('products.no_description') }}</p>
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                @auth
                    @if (auth()->user()->isClient() && $product->fournisseur && $product->stock > 0)
                        <form method="POST" action="{{ route('client.products.order', $product) }}" class="flex flex-wrap items-end gap-3">
                            @csrf
                            <div>
                                <label class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('orders.quantity') }}</label>
                                <input type="number" name="quantity" min="{{ max(1, (int) $product->moq) }}" value="{{ max(1, (int) $product->moq) }}" class="saas-input mt-1 w-24">
                            </div>
                            <button type="submit" class="saas-btn-primary">{{ __('marketplace.buy_now') }}</button>
                        </form>
                        <a href="{{ route('messages.show', ['user' => $product->fournisseur, 'product' => $product->id]) }}" class="saas-btn-secondary">{{ __('products.contact_supplier') }}</a>
                        @php $profile = $product->fournisseur->supplierProfile ?? \App\Models\SupplierProfile::ensureFor($product->fournisseur); @endphp
                        <a href="{{ route('marketplace.suppliers.show', $profile) }}" class="saas-btn-secondary">{{ __('products.view_profile') }}</a>
                    @elseif (auth()->user()->isClient() && $product->fournisseur)
                        <a href="{{ route('messages.show', ['user' => $product->fournisseur, 'product' => $product->id]) }}" class="saas-btn-primary">{{ __('products.contact_supplier') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="saas-btn-primary">{{ __('common.login') }}</a>
                @endauth
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <section class="mt-12">
            <h2 class="mb-6 text-xl font-bold">{{ __('products.related') }}</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($related as $item)
                    <a href="{{ route('products.show', $item) }}" class="saas-card transition hover:-translate-y-0.5">
                        <p class="font-semibold">{{ $item->name }}</p>
                        <p class="mt-1 text-sm font-bold text-primary">{{ number_format($item->price, 2) }} {{ __('common.currency') }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection
