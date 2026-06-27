@extends('layouts.saas', ['navActive' => 'dashboard'])

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold">{{ __('nav.dashboard') }}</h2>
        <p class="text-on-surface-variant">{{ $pageSubtitle ?? '' }} — {{ $supplierName }}</p>
    </div>

    <div class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
        @foreach ($stats as $stat)
            <article class="saas-card">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">{{ $stat['label'] }}</p>
                        <p class="mt-2 text-3xl font-bold text-primary">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-xs font-medium text-on-surface-variant">{{ $stat['badge'] }}</p>
                    </div>
                    <span class="material-symbols-outlined text-3xl text-primary/50">{{ $stat['icon'] }}</span>
                </div>
            </article>
        @endforeach
    </div>

    <section class="saas-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-lg font-bold">{{ __('nav.demandes') }}</h3>
            <a href="{{ route('supplier.demandes.index') }}" class="text-sm font-medium text-primary">{{ __('common.view') }}</a>
        </div>
        <div class="space-y-3">
            @foreach ($requests as $request)
                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl bg-surface-container-low px-4 py-3">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">{{ $request['icon'] }}</span>
                        <div>
                            <p class="font-semibold">{{ $request['title'] }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $request['company'] }} · {{ $request['time'] }}</p>
                        </div>
                    </div>
                    <span class="font-bold text-primary">{{ $request['amount'] }}</span>
                </div>
            @endforeach
        </div>
    </section>
@endsection
