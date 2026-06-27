@extends('layouts.saas', ['navActive' => 'dashboard'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <div class="mb-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
        @foreach ($stats as $stat)
            <article class="saas-card group transition hover:-translate-y-0.5 hover:shadow-soft">
                <div class="flex items-start justify-between gap-2">
                    <div class="min-w-0">
                        <p class="truncate text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ $stat['label'] }}</p>
                        <p class="mt-2 text-2xl font-bold text-on-surface xl:text-3xl">{{ $stat['value'] }}</p>
                    </div>
                    <span class="material-symbols-outlined shrink-0 text-2xl text-primary/40">{{ $stat['icon'] }}</span>
                </div>
            </article>
        @endforeach
    </div>

    <div class="mb-8 grid gap-6 xl:grid-cols-3">
        <section class="saas-card xl:col-span-2">
            <h3 class="text-lg font-bold">{{ __('admin.platform_growth') }}</h3>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('dashboard.admin_overview') }}</p>
            <div class="mt-6 h-72">
                <canvas id="admin-growth-chart" aria-label="{{ __('admin.platform_growth') }}"></canvas>
            </div>
        </section>
        <section class="saas-card">
            <h3 class="text-lg font-bold">{{ __('admin.user_distribution') }}</h3>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('nav.admin.users') }}</p>
            <div class="mt-6 flex h-72 items-center justify-center">
                <canvas id="admin-role-chart" aria-label="{{ __('admin.user_distribution') }}"></canvas>
            </div>
        </section>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="saas-card">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold">{{ __('admin.recent_activity') }}</h3>
                <a href="{{ route('admin.statistics') }}" class="text-sm font-medium text-primary hover:underline">{{ __('common.view_all') }}</a>
            </div>
            <div class="space-y-3">
                @forelse ($recentActivity as $item)
                    <div class="flex items-start gap-3 rounded-xl bg-surface-container-low px-4 py-3">
                        <span class="material-symbols-outlined mt-0.5 text-primary">{{ $item['icon'] }}</span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate font-semibold">{{ $item['title'] }}</p>
                            <p class="text-sm text-on-surface-variant">{{ $item['subtitle'] }}</p>
                        </div>
                        <span class="shrink-0 text-xs text-on-surface-variant">{{ $item['time'] }}</span>
                    </div>
                @empty
                    <p class="text-sm text-on-surface-variant">{{ __('common.no_results') }}</p>
                @endforelse
            </div>
        </section>
        <section class="saas-card">
            <h3 class="text-lg font-bold">{{ __('nav.admin.suppliers_validation') }}</h3>
            <p class="mt-1 text-sm text-on-surface-variant">{{ __('roles.moderation_subtitle') }}</p>
            <div class="mt-6 grid gap-3 sm:grid-cols-3">
                @foreach ([['label' => __('common.pending'), 'route' => route('admin.moderation', ['status' => 'pending'])], ['label' => __('common.approved'), 'route' => route('admin.moderation', ['status' => 'approved'])], ['label' => __('common.rejected'), 'route' => route('admin.moderation', ['status' => 'rejected'])]] as $link)
                    <a href="{{ $link['route'] }}" class="rounded-xl border border-outline-variant/30 bg-surface-container-lowest px-4 py-4 text-center transition hover:border-primary/30 hover:shadow-soft">
                        <span class="text-sm font-medium text-on-surface-variant">{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>
            <a href="{{ route('admin.moderation') }}" class="saas-btn-primary mt-6 inline-flex">{{ __('common.view') }}</a>
        </section>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const growth = @json($growthChart);
    const roles = @json($roleChart);

    new Chart(document.getElementById('admin-growth-chart'), {
        type: 'line',
        data: {
            labels: growth.labels,
            datasets: [
                { label: '{{ __('nav.admin.users') }}', data: growth.users, borderColor: '#00288e', backgroundColor: 'rgba(0,40,142,0.1)', tension: 0.35, fill: true },
                { label: '{{ __('nav.admin.orders') }}', data: growth.orders, borderColor: '#0060ac', backgroundColor: 'rgba(0,96,172,0.08)', tension: 0.35, fill: true },
                { label: '{{ __('nav.admin.demandes') }}', data: growth.demandes, borderColor: '#64a8fe', backgroundColor: 'rgba(100,168,254,0.08)', tension: 0.35, fill: true },
            ],
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } },
    });

    new Chart(document.getElementById('admin-role-chart'), {
        type: 'doughnut',
        data: {
            labels: roles.labels,
            datasets: [{ data: roles.values, backgroundColor: ['#00288e', '#0060ac', '#64a8fe'], borderWidth: 0 }],
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } },
    });
</script>
@endpush
