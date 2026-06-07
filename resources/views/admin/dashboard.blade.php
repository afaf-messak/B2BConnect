@extends('layouts.saas', ['navActive' => 'dashboard'])

@section('content')
    <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <article class="saas-card group transition hover:-translate-y-0.5 hover:shadow-soft">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ $stat['label'] }}</p>
                        <p class="mt-2 text-3xl font-bold text-on-surface">{{ $stat['value'] }}</p>
                    </div>
                    <span class="material-symbols-outlined text-3xl text-primary/40">{{ $stat['icon'] }}</span>
                </div>
            </article>
        @endforeach
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="saas-card">
            <h3 class="text-lg font-bold">{{ __('nav.admin.demandes') }}</h3>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('dashboard.admin_activity') }}</p>
            <div class="mt-4 space-y-2">
                @foreach (['Electronics Wholesale', 'Raw Materials Import', 'Urgent Parts Delivery'] as $item)
                    <div class="flex items-center justify-between rounded-xl bg-surface-container-low px-4 py-3 text-sm">
                        <span>{{ $item }}</span>
                        <span class="rounded-full bg-secondary-container/30 px-2 py-0.5 text-xs font-semibold text-primary">Active</span>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="saas-card">
            <h3 class="text-lg font-bold">{{ __('nav.admin.statistics') }}</h3>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('dashboard.admin_overview') }}</p>
            <a href="{{ route('admin.statistics') }}" class="saas-btn-primary mt-6 inline-flex">{{ __('common.view') }}</a>
        </section>
    </div>
@endsection
