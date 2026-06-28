@extends('layouts.saas', ['navActive' => 'offers'])

@section('content')
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div class="grid gap-4 sm:grid-cols-3">
            <div class="saas-card py-4 text-center sm:min-w-[140px]">
                <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
                <p class="text-xs text-on-surface-variant">{{ __('nav.sent_offers') }}</p>
            </div>
            <div class="saas-card py-4 text-center sm:min-w-[140px]">
                <p class="text-2xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
                <p class="text-xs text-on-surface-variant">{{ __('marketplace.pending_offers') }}</p>
            </div>
            <div class="saas-card py-4 text-center sm:min-w-[140px]">
                <p class="text-2xl font-bold text-green-600">{{ $stats['accepted'] }}</p>
                <p class="text-xs text-on-surface-variant">{{ __('marketplace.accepted_offers') }}</p>
            </div>
        </div>
        <a href="{{ route('supplier.offers.export', request()->query()) }}" class="saas-btn-secondary text-sm">{{ __('common.export') }}</a>
    </div>

    <form method="GET" class="mb-6 grid gap-3 rounded-3xl border border-outline-variant/50 bg-surface p-4 shadow-sm sm:grid-cols-[1.7fr_auto_auto]">
        <label class="sr-only" for="offers-search">{{ __('common.search') }}</label>
        <div class="relative w-full">
            <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-[20px] text-outline">search</span>
            <input id="offers-search" type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input h-14 rounded-2xl pl-12 pr-4 w-full" />
        </div>

        <label class="sr-only" for="offers-status">{{ __('common.status') }}</label>
        <select id="offers-status" name="status" class="saas-input h-14 rounded-2xl w-full max-w-[220px]">
            <option value="">{{ __('common.status') }}</option>
            @foreach (['pending', 'accepted', 'rejected'] as $status)
                <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>

        <button type="submit" class="saas-btn-primary h-14 rounded-2xl px-6 text-sm font-semibold">{{ __('common.filter') }}</button>
    </form>

    <section class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest shadow-card">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('marketplace.quotation_title') }}</th>
                        <th>{{ __('demandes.title') }}</th>
                        <th>{{ __('marketplace.price') }}</th>
                        <th>{{ __('marketplace.delivery_days') }}</th>
                        <th>{{ __('common.status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $offre)
                        <tr>
                            <td class="font-semibold">{{ $offre->title }}</td>
                            <td>{{ $offre->demande?->title }}</td>
                            <td>{{ number_format($offre->price, 2) }} {{ __('common.currency') }}</td>
                            <td>{{ $offre->delivery_time_days }}</td>
                            <td><span class="rounded-full bg-secondary-container/30 px-2 py-0.5 text-xs font-semibold">{{ ucfirst($offre->status) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-on-surface-variant">
                                {{ __('marketplace.sent_offers_empty') }}
                                <a href="{{ route('supplier.demandes.index') }}" class="mt-2 block font-semibold text-primary">{{ __('nav.demandes') }}</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($offers->hasPages())
            <div class="border-t border-outline-variant/20 px-6 py-4">{{ $offers->links() }}</div>
        @endif
    </section>
@endsection
