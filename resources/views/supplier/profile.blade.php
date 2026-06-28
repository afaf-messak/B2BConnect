@extends('layouts.saas', [
    'title' => __('nav.profile') . ' - ' . __('common.app_name'),
    'navActive' => 'profile',
])

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        <section class="saas-card lg:col-span-1">
            <div class="flex flex-col items-center text-center">
                <div class="grid h-20 w-20 place-items-center rounded-2xl bg-primary text-2xl font-bold text-on-primary">{{ $supplierInitials }}</div>
                <h2 class="mt-4 text-xl font-bold">{{ $company['name'] }}</h2>
                <p class="text-sm text-on-surface-variant">{{ $company['status'] }}</p>
                <div class="mt-4 flex items-center gap-1 text-amber-500">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' {{ $i < 4 ? 1 : 0 }};">star</span>
                    @endfor
                    <span class="ms-2 text-sm text-on-surface-variant">{{ $company['rating'] }}</span>
                </div>
            </div>
            <div class="mt-6 space-y-3 text-sm text-on-surface-variant">
                <p class="flex items-center gap-2"><span class="material-symbols-outlined text-base">location_on</span>{{ $company['location'] }}</p>
                <p class="flex items-center gap-2"><span class="material-symbols-outlined text-base">call</span>{{ $company['phone'] }}</p>
                <p class="flex items-center gap-2"><span class="material-symbols-outlined text-base">language</span>{{ $company['website'] }}</p>
            </div>
        </section>

        <section class="saas-card lg:col-span-2">
            <h3 class="text-lg font-bold">{{ __('nav.profile') }}</h3>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                @foreach ($services as $service)
                    <div class="rounded-xl bg-surface-container-low p-4">
                        <span class="material-symbols-outlined text-primary">{{ $service['icon'] }}</span>
                        <h4 class="mt-2 font-semibold">{{ $service['title'] }}</h4>
                        <p class="mt-1 text-sm text-on-surface-variant">{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                <h4 class="font-semibold">Reviews</h4>
                <div class="mt-4 space-y-4">
                    @foreach ($reviews as $review)
                        <article class="rounded-xl border border-outline-variant/20 p-4">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold">{{ $review['name'] }}</p>
                                <span class="text-xs text-on-surface-variant">{{ $review['date'] }}</span>
                            </div>
                            <p class="mt-2 text-sm text-on-surface-variant">{{ $review['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
