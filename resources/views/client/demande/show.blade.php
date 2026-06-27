@extends('layouts.saas', [
    'title' => $demande->title . ' - ' . __('common.app_name'),
    'navActive' => 'demandes',
])

@section('content')
    <a href="{{ route('client.demandes.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <div class="grid gap-6 lg:grid-cols-3">
        <article class="saas-card lg:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-bold">{{ $demande->title }}</h2>
                <span class="rounded-full bg-secondary-container/30 px-3 py-1 text-sm font-semibold text-primary">{{ ucfirst($demande->status) }}</span>
            </div>
            <p class="mt-4 whitespace-pre-line text-on-surface-variant">{{ $demande->description }}</p>
            <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('demandes.budget') }}</dt><dd class="mt-1 font-bold">{{ $demande->budget ? number_format($demande->budget, 2) . ' ' . __('common.currency') : '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('demandes.category') }}</dt><dd class="mt-1 font-bold">{{ $demande->category ?: '—' }}</dd></div>
            </dl>
        </article>
        <aside class="space-y-4">
            <article class="saas-card">
                <h3 class="font-bold">{{ __('nav.offers_received') }} ({{ $demande->offres->count() }})</h3>
                <div class="mt-3 space-y-4">
                    @forelse ($demande->offres as $offre)
                        <div class="rounded-xl border border-outline-variant/20 bg-surface-container-low p-4 text-sm">
                            <p class="font-semibold">{{ $offre->title }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $offre->user?->company_name ?: $offre->user?->name }}</p>
                            <p class="mt-2 font-bold text-primary">{{ number_format($offre->price, 2) }} {{ __('common.currency') }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $offre->delivery_time_days }} {{ __('marketplace.delivery_days') }}</p>
                            @if ($offre->status === 'pending')
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <form method="POST" action="{{ route('client.offers.accept', $offre) }}">
                                        @csrf
                                        <button type="submit" class="saas-btn-primary py-1.5 text-xs">{{ __('marketplace.accept_offer') }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('client.offers.reject', $offre) }}">
                                        @csrf
                                        <button type="submit" class="saas-btn-secondary py-1.5 text-xs">{{ __('marketplace.reject_offer') }}</button>
                                    </form>
                                </div>
                            @else
                                <span class="mt-2 inline-block rounded-full bg-secondary-container/30 px-2 py-0.5 text-xs font-semibold">{{ ucfirst($offre->status) }}</span>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-on-surface-variant">{{ __('marketplace.offers_empty') }}</p>
                    @endforelse
                </div>
            </article>
        </aside>
    </div>
@endsection
