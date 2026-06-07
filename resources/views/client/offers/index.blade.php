@extends('layouts.saas', [
    'title' => __('marketplace.offers_title') . ' - ' . __('common.app_name'),
    'navActive' => 'offers',
])

@section('content')
    <div class="mb-8 grid gap-4 sm:grid-cols-3">
        <div class="saas-card text-center">
            <p class="text-3xl font-bold text-primary">{{ $stats['total'] }}</p>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('nav.offers_received') }}</p>
        </div>
        <div class="saas-card text-center">
            <p class="text-3xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('marketplace.pending_offers') }}</p>
        </div>
        <div class="saas-card text-center">
            <p class="text-3xl font-bold text-green-600">{{ $stats['accepted'] }}</p>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('marketplace.accepted_offers') }}</p>
        </div>
    </div>

    <form method="GET" class="mb-6 flex flex-wrap gap-3">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[200px] flex-1">
        <select name="status" class="saas-input w-auto">
            <option value="">{{ __('common.status') }}</option>
            @foreach (['pending', 'accepted', 'rejected'] as $status)
                <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        <button type="submit" class="saas-btn-primary">{{ __('common.filter') }}</button>
    </form>

    @forelse ($offers as $offre)
        <article class="saas-card mb-4">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-secondary">{{ __('marketplace.from_supplier', ['name' => $offre->user?->company_name ?: $offre->user?->name]) }}</p>
                    <h3 class="mt-1 text-xl font-bold">{{ $offre->title }}</h3>
                    <p class="mt-1 text-sm text-on-surface-variant">{{ __('marketplace.for_request', ['title' => $offre->demande?->title]) }}</p>
                    <p class="mt-3 whitespace-pre-line text-sm">{{ Str::limit($offre->description, 280) }}</p>
                    <div class="mt-4 flex flex-wrap gap-4 text-sm">
                        <span class="font-bold text-primary">{{ number_format($offre->price, 2) }} {{ __('common.currency') }}</span>
                        <span class="text-on-surface-variant">{{ $offre->delivery_time_days }} {{ __('marketplace.delivery_days') }}</span>
                        <span class="rounded-full bg-secondary-container/30 px-2 py-0.5 text-xs font-semibold">{{ ucfirst($offre->status) }}</span>
                    </div>
                </div>
                @if ($offre->status === 'pending')
                    <div class="flex shrink-0 flex-wrap gap-2">
                        <form method="POST" action="{{ route('client.offers.accept', $offre) }}">
                            @csrf
                            <button type="submit" class="saas-btn-primary">{{ __('marketplace.accept_offer') }}</button>
                        </form>
                        <form method="POST" action="{{ route('client.offers.reject', $offre) }}">
                            @csrf
                            <button type="submit" class="saas-btn-secondary">{{ __('marketplace.reject_offer') }}</button>
                        </form>
                        @if ($offre->user)
                            <a href="{{ route('messages.show', $offre->user) }}" class="saas-btn-secondary">{{ __('marketplace.contact') }}</a>
                        @endif
                    </div>
                @endif
            </div>
        </article>
    @empty
        <div class="saas-card border-dashed py-16 text-center">
            <span class="material-symbols-outlined mb-4 text-5xl text-outline">request_quote</span>
            <p>{{ __('marketplace.offers_empty') }}</p>
            <a href="{{ route('client.demandes.index') }}" class="saas-btn-primary mt-6 inline-flex">{{ __('nav.my_requests') }}</a>
        </div>
    @endforelse

    <div class="mt-6">{{ $offers->links() }}</div>
@endsection
