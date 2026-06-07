@extends('layouts.saas', ['navActive' => 'dashboard'])

@section('content')
    <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <a href="{{ $stat['href'] ?? '#' }}" class="saas-card group block transition hover:-translate-y-1 hover:shadow-soft">
                <div class="flex items-center justify-between">
                    <span class="material-symbols-outlined text-3xl text-primary">{{ $stat['icon'] }}</span>
                    <span class="text-3xl font-bold text-on-surface">{{ $stat['value'] }}</span>
                </div>
                <p class="mt-4 text-sm font-semibold text-on-surface-variant group-hover:text-primary">{{ $stat['label'] }}</p>
            </a>
        @endforeach
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <section class="saas-card lg:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold">{{ __('nav.my_requests') }}</h3>
                <a href="{{ route('client.demandes.index') }}" class="text-sm font-medium text-primary">{{ __('common.view') }}</a>
            </div>
            <p class="text-sm text-on-surface-variant">{{ __('dashboard.client_hint') }}</p>
        </section>
        <section class="saas-card">
            <h3 class="text-lg font-bold">{{ __('nav.products') }}</h3>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('products.catalog_subtitle') }}</p>
            <a href="{{ route('products.catalog') }}" class="saas-btn-primary mt-6 w-full">{{ __('common.view') }}</a>
            <a href="{{ route('client.demandes.index') }}" class="saas-btn-secondary mt-3 w-full">{{ __('common.new_request') }}</a>
        </section>
    </div>
@endsection
