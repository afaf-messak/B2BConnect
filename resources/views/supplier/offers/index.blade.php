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
