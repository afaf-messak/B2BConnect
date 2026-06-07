@extends(auth()->check() ? 'layouts.saas' : 'layouts.saas-guest', [
    'title' => __('marketplace.title') . ' - ' . __('common.app_name'),
    'navActive' => 'marketplace',
    'pageTitle' => __('marketplace.title'),
    'pageSubtitle' => __('marketplace.subtitle'),
    'showSidebar' => auth()->check(),
])

@section('content')
    <div class="mb-10 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest text-secondary">{{ __('nav.marketplace') }}</p>
        <h1 class="mt-2 text-4xl font-bold tracking-tight">{{ __('marketplace.title') }}</h1>
        <p class="mx-auto mt-4 max-w-2xl text-on-surface-variant">{{ __('marketplace.subtitle') }}</p>
    </div>

    <form method="GET" class="glass-card mb-8 grid gap-4 p-6 md:grid-cols-2 lg:grid-cols-6">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('marketplace.search_placeholder') }}" class="saas-input lg:col-span-2">
        <select name="industry" class="saas-input">
            <option value="">{{ __('marketplace.industry') }}</option>
            @foreach ($industries as $industry)
                <option value="{{ $industry }}" @selected(($filters['industry'] ?? '') === $industry)>{{ $industry }}</option>
            @endforeach
        </select>
        <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" placeholder="{{ __('marketplace.city') }}" class="saas-input">
        <select name="min_rating" class="saas-input">
            <option value="">{{ __('marketplace.min_rating') }}</option>
            @foreach ([4, 3, 2] as $rating)
                <option value="{{ $rating }}" @selected(($filters['min_rating'] ?? '') == $rating)">{{ $rating }}+</option>
            @endforeach
        </select>
        <select name="sort" class="saas-input">
            <option value="rating" @selected(($filters['sort'] ?? 'rating') === 'rating')>{{ __('marketplace.sort_rating') }}</option>
            <option value="name" @selected(($filters['sort'] ?? '') === 'name')>{{ __('marketplace.sort_name') }}</option>
            <option value="products" @selected(($filters['sort'] ?? '') === 'products')>{{ __('marketplace.sort_products') }}</option>
        </select>
        <button type="submit" class="saas-btn-primary lg:col-span-6">{{ __('common.filter') }}</button>
    </form>

    @if ($suppliers->isEmpty())
        <div class="saas-card border-dashed py-16 text-center">
            <span class="material-symbols-outlined mb-4 text-5xl text-outline">storefront</span>
            <h3 class="text-lg font-semibold">{{ __('common.no_results') }}</h3>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($suppliers as $supplier)
                @php
                    $profile = $supplier->supplierProfile;
                    $rating = $supplier->average_rating ? round((float) $supplier->average_rating, 1) : null;
                @endphp
                <article class="saas-card group transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-primary to-secondary text-lg font-bold text-on-primary">
                            {{ strtoupper(substr($supplier->company_name ?: $supplier->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="truncate text-lg font-bold">{{ $supplier->company_name ?: $supplier->name }}</h3>
                            @if ($profile?->tagline)
                                <p class="mt-1 truncate text-sm text-on-surface-variant">{{ $profile->tagline }}</p>
                            @endif
                            <div class="mt-2 flex flex-wrap gap-2 text-xs">
                                @if ($profile?->industry)
                                    <span class="rounded-full bg-secondary-container/40 px-2 py-0.5 font-medium text-primary">{{ $profile->industry }}</span>
                                @endif
                                @if ($profile?->city)
                                    <span class="text-on-surface-variant">{{ $profile->city }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <span class="flex items-center gap-1 font-semibold text-amber-600">
                            <span class="material-symbols-outlined text-base">star</span>
                            {{ $rating ?? __('marketplace.no_rating') }}
                        </span>
                        <span class="text-on-surface-variant">{{ __('marketplace.products_count', ['count' => $supplier->products_count]) }}</span>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('marketplace.suppliers.show', $profile) }}" class="saas-btn-primary flex-1 py-2.5">{{ __('marketplace.view_profile') }}</a>
                        @auth
                            @if (auth()->user()->isClient())
                                <a href="{{ route('messages.show', $supplier) }}" class="saas-btn-secondary flex-1 py-2.5">{{ __('marketplace.contact') }}</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="saas-btn-secondary flex-1 py-2.5">{{ __('marketplace.contact') }}</a>
                        @endauth
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-8">{{ $suppliers->links() }}</div>
    @endif
@endsection
