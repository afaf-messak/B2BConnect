@extends(auth()->check() ? 'layouts.saas' : 'layouts.saas-guest', [
    'title' => ($supplier->company_name ?: $supplier->name) . ' - ' . __('common.app_name'),
    'navActive' => 'marketplace',
    'pageTitle' => $supplier->company_name ?: $supplier->name,
    'showSidebar' => auth()->check(),
])

@section('content')
    <div class="relative overflow-hidden rounded-3xl border border-outline-variant/30 bg-gradient-to-br from-surface-container-lowest via-surface-container to-secondary-container/20 p-8 shadow-card lg:p-12">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
            <div class="flex gap-6">
                <div class="grid h-20 w-20 shrink-0 place-items-center rounded-2xl bg-primary text-2xl font-bold text-on-primary">
                    {{ strtoupper(substr($supplier->company_name ?: $supplier->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-3">
                        <h1 class="text-3xl font-bold">{{ $supplier->company_name ?: $supplier->name }}</h1>
                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800 dark:bg-green-900/40 dark:text-green-200">
                            <span class="material-symbols-outlined text-sm">verified</span>
                            {{ __('marketplace.verified_supplier') }}
                        </span>
                    </div>
                    @if ($profile->tagline)
                        <p class="mt-2 text-lg text-on-surface-variant">{{ $profile->tagline }}</p>
                    @endif
                    <div class="mt-4 flex flex-wrap gap-4 text-sm text-on-surface-variant">
                        @if ($profile->city || $profile->country)
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">location_on</span>{{ collect([$profile->city, $profile->country])->filter()->join(', ') }}</span>
                        @endif
                        @if ($averageRating)
                            <span class="flex items-center gap-1 font-semibold text-amber-600"><span class="material-symbols-outlined text-base">star</span>{{ $averageRating }} ({{ __('marketplace.reviews_count', ['count' => $reviewsCount]) }})</span>
                        @endif
                        @if ($profile->response_time_hours)
                            <span>{{ __('marketplace.response_time', ['hours' => $profile->response_time_hours]) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                @auth
                    @if (auth()->user()->isClient())
                        @if ($isFavorite)
                            <form method="POST" action="{{ route('client.favorites.destroy', $supplier) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-outline-variant/20 bg-surface-container text-error shadow-sm transition hover:border-primary/40" aria-label="{{ __('marketplace.unfavorite') }}">
                                    <span class="material-symbols-outlined text-lg">favorite</span>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('client.favorites.store', $supplier) }}">
                                @csrf
                                <button type="submit" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-outline-variant/20 bg-surface-container text-primary shadow-sm transition hover:border-primary/40" aria-label="{{ __('marketplace.favorite') }}">
                                    <span class="material-symbols-outlined text-lg">favorite</span>
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('messages.show', $supplier) }}" class="saas-btn-primary">{{ __('marketplace.contact') }}</a>
                        <a href="{{ route('client.demandes.index') }}" class="saas-btn-secondary">{{ __('marketplace.request_quote') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="saas-btn-primary">{{ __('common.login') }}</a>
                @endauth
                @if ($profile->website)
                    <a href="{{ $profile->website }}" target="_blank" rel="noopener" class="saas-btn-secondary">{{ __('marketplace.website') }}</a>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-10 grid gap-8 lg:grid-cols-3">
        <div class="space-y-8 lg:col-span-2">
            @if ($profile->bio)
                <section class="saas-card">
                    <h2 class="text-xl font-bold">{{ __('marketplace.about') }}</h2>
                    <p class="mt-4 whitespace-pre-line leading-relaxed text-on-surface-variant">{{ $profile->bio }}</p>
                </section>
            @endif

            @if ($profile->services)
                <section class="saas-card">
                    <h2 class="text-xl font-bold">{{ __('marketplace.services') }}</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($profile->services as $service)
                            <span class="rounded-full bg-secondary-container/30 px-3 py-1 text-sm font-medium text-primary">{{ is_array($service) ? ($service['name'] ?? '') : $service }}</span>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="saas-card">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-xl font-bold">{{ __('marketplace.products') }}</h2>
                    <a href="{{ route('products.catalog', ['supplier' => $supplier->id]) }}" class="text-sm font-semibold text-primary">{{ __('common.view_all') }}</a>
                </div>
                @if ($products->isEmpty())
                    <p class="text-sm text-on-surface-variant">{{ __('common.no_results') }}</p>
                @else
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($products as $product)
                            <a href="{{ route('products.show', $product) }}" class="rounded-2xl border border-outline-variant/20 p-4 transition hover:border-primary/40">
                                <p class="font-semibold">{{ $product->name }}</p>
                                <p class="mt-1 text-sm font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>

        <aside class="space-y-6">
            <section class="saas-card">
                <h2 class="text-lg font-bold">{{ __('marketplace.reviews') }}</h2>
                @forelse ($reviews as $review)
                    <div class="mt-4 border-t border-outline-variant/20 pt-4 first:mt-0 first:border-0 first:pt-0">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold">{{ $review->client?->company_name ?: $review->client?->name }}</p>
                            <span class="text-amber-600">{{ str_repeat('★', $review->rating) }}</span>
                        </div>
                        @if ($review->body)
                            <p class="mt-2 text-sm text-on-surface-variant">{{ $review->body }}</p>
                        @endif
                    </div>
                @empty
                    <p class="mt-3 text-sm text-on-surface-variant">{{ __('marketplace.no_rating') }}</p>
                @endforelse
            </section>
        </aside>
    </div>

    <div class="mt-6">
        <a href="{{ route('marketplace.suppliers.index') }}" class="inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            {{ __('common.back') }}
        </a>
    </div>
@endsection
