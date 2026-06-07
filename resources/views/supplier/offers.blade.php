@extends('layouts.saas', [
    'title' => __('nav.offers') . ' - ' . __('common.app_name'),
    'navActive' => 'offers',
])

@section('header-actions')
    <a href="{{ route('supplier.offers.export') }}" class="saas-btn-secondary">{{ __('common.export') }}</a>
@endsection

@section('content')
    <form method="GET" action="{{ route('supplier.offers') }}" class="mb-6 flex flex-wrap gap-3">
        <input type="search" name="q" value="{{ $filters['q'] }}" placeholder="{{ __('common.search') }}" class="saas-input max-w-md flex-1">
        <select name="status" class="saas-input w-auto">
            <option value="">{{ __('common.all') }}</option>
            <option value="pending" @selected($filters['status'] === 'pending')>Pending</option>
            <option value="accepted" @selected($filters['status'] === 'accepted')>Accepted</option>
            <option value="rejected" @selected($filters['status'] === 'rejected')>Rejected</option>
        </select>
        <button type="submit" class="rounded-xl bg-secondary-container px-5 py-2.5 text-sm font-semibold text-on-secondary-container">{{ __('common.filter') }}</button>
    </form>

    <div class="grid gap-6 lg:grid-cols-3">
        @foreach ([$featuredOffer, ...$secondaryOffers] as $offer)
            @if ($offer)
                <article class="saas-card {{ !empty($offer['recommended']) ? 'ring-2 ring-primary/20' : '' }}">
                    <div class="mb-4 flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-bold">{{ $offer['company'] }}</h3>
                            <p class="text-sm text-on-surface-variant">{{ $offer['subtitle'] }}</p>
                        </div>
                        <span class="material-symbols-outlined text-primary">{{ $offer['icon'] }}</span>
                    </div>
                    <p class="text-2xl font-bold text-primary">{{ $offer['price'] }}</p>
                    <p class="mt-2 text-sm text-on-surface-variant">{{ $offer['delivery'] }} · {{ $offer['cargo'] }}</p>
                    @if (!empty($offer['id']) && !empty($offer['can_update']))
                        <div class="mt-4 flex gap-2">
                            <form method="POST" action="{{ route('supplier.offers.accept', $offer['id']) }}">@csrf @method('PATCH')<button class="saas-btn-primary flex-1 py-2 text-xs">{{ __('common.yes') }}</button></form>
                            <form method="POST" action="{{ route('supplier.offers.reject', $offer['id']) }}">@csrf @method('PATCH')<button class="saas-btn-secondary flex-1 py-2 text-xs">{{ __('common.no') }}</button></form>
                        </div>
                    @endif
                </article>
            @endif
        @endforeach
    </div>
@endsection
