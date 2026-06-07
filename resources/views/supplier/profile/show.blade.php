@extends('layouts.saas', ['navActive' => 'company'])

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">{{ __('marketplace.public_profile') }}</h1>
            <p class="text-sm text-on-surface-variant">{{ $supplier->company_name ?: $supplier->name }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('supplier.profile.edit') }}" class="saas-btn-secondary">{{ __('marketplace.edit_profile') }}</a>
            <a href="{{ route('supplier.profile', ['preview' => 1]) }}" class="saas-btn-primary">{{ __('marketplace.preview_public') }}</a>
        </div>
    </div>

    <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @foreach ([
            ['label' => __('nav.products'), 'value' => $stats['products']],
            ['label' => __('nav.sent_offers'), 'value' => $stats['offers_sent']],
            ['label' => __('marketplace.accepted_offers'), 'value' => $stats['offers_won']],
            ['label' => __('marketplace.reviews'), 'value' => $stats['reviews']],
            ['label' => 'Rating', 'value' => $stats['rating'] ?? '—'],
        ] as $stat)
            <div class="saas-card text-center">
                <p class="text-2xl font-bold text-primary">{{ $stat['value'] }}</p>
                <p class="mt-1 text-xs text-on-surface-variant">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>

    <article class="saas-card">
        @if ($profile->tagline)
            <p class="text-lg font-medium text-secondary">{{ $profile->tagline }}</p>
        @endif
        <p class="mt-4 whitespace-pre-line text-on-surface-variant">{{ $profile->bio ?: '—' }}</p>
        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('marketplace.industry') }}</dt><dd class="mt-1 font-semibold">{{ $profile->industry ?: '—' }}</dd></div>
            <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('marketplace.location') }}</dt><dd class="mt-1 font-semibold">{{ collect([$profile->city, $profile->country])->filter()->join(', ') ?: '—' }}</dd></div>
            <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('marketplace.website') }}</dt><dd class="mt-1 font-semibold">{{ $profile->website ?: '—' }}</dd></div>
            <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('marketplace.is_public') }}</dt><dd class="mt-1 font-semibold">{{ $profile->is_public ? __('common.yes') : __('common.no') }}</dd></div>
        </dl>
    </article>
@endsection
