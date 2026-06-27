@extends('layouts.saas', ['navActive' => 'favorites'])

@section('content')
    <h1 class="mb-8 text-2xl font-bold">{{ __('marketplace.favorites_title') }}</h1>

    @if ($favorites->isEmpty())
        <div class="saas-card border-dashed py-16 text-center">
            <span class="material-symbols-outlined mb-4 text-5xl text-outline">favorite</span>
            <p>{{ __('marketplace.favorites_empty') }}</p>
            <a href="{{ route('marketplace.suppliers.index') }}" class="saas-btn-primary mt-6 inline-flex">{{ __('nav.marketplace') }}</a>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($favorites as $favorite)
                @php $supplier = $favorite->supplier; $profile = $supplier?->supplierProfile; @endphp
                @if ($supplier && $profile)
                    <article class="saas-card">
                        <h3 class="text-lg font-bold">{{ $supplier->company_name ?: $supplier->name }}</h3>
                        @if ($profile->tagline)
                            <p class="mt-1 text-sm text-on-surface-variant">{{ $profile->tagline }}</p>
                        @endif
                        <div class="mt-6 flex items-center gap-2">
                            <a href="{{ route('marketplace.suppliers.show', $profile) }}" class="saas-btn-primary flex-1 py-2.5">{{ __('marketplace.view_profile') }}</a>
                            <form method="POST" action="{{ route('client.favorites.destroy', $supplier) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-outline-variant/20 bg-surface-container text-error shadow-sm transition hover:border-primary/40" aria-label="{{ __('marketplace.unfavorite') }}">
                                    <span class="material-symbols-outlined text-lg">favorite</span>
                                </button>
                            </form>
                        </div>
                    </article>
                @endif
            @endforeach
        </div>
        <div class="mt-8">{{ $favorites->links() }}</div>
    @endif
@endsection
