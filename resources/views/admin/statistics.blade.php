@extends('layouts.saas', ['navActive' => 'statistics'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="saas-panel p-6">
            <h2 class="mb-4 text-lg font-bold">{{ __('admin.platform_growth') }}</h2>
            <canvas id="growthChart" height="200"></canvas>
        </section>
        <section class="saas-panel p-6">
            <h2 class="mb-4 text-lg font-bold">{{ __('admin.user_distribution') }}</h2>
            <canvas id="roleChart" height="200"></canvas>
        </section>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <section class="saas-panel overflow-hidden">
            <div class="border-b px-6 py-4">
                <h2 class="font-bold">{{ __('admin.top_suppliers') }}</h2>
            </div>
            <ul class="divide-y">
                @forelse ($topSuppliers as $supplier)
                    <li class="flex items-center justify-between px-6 py-3">
                        <div>
                            <p class="font-semibold">{{ $supplier->company_name ?: $supplier->name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $supplier->products_count ?? 0 }} {{ __('nav.products') }}</p>
                        </div>
                        <span class="saas-badge saas-badge-primary">{{ $supplier->offers_count ?? 0 }} {{ __('nav.offers') }}</span>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-on-surface-variant">{{ __('common.no_results') }}</li>
                @endforelse
            </ul>
        </section>

        <section class="saas-panel overflow-hidden">
            <div class="border-b px-6 py-4">
                <h2 class="font-bold">{{ __('admin.top_products') }}</h2>
            </div>
            <ul class="divide-y">
                @forelse ($topProducts as $product)
                    <li class="flex items-center justify-between px-6 py-3">
                        <div>
                            <p class="font-semibold">{{ $product->name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $product->fournisseur?->company_name }}</p>
                        </div>
                        <span class="saas-badge saas-badge-primary">{{ $product->orders_count ?? 0 }} {{ __('nav.orders') }}</span>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-on-surface-variant">{{ __('common.no_results') }}</li>
                @endforelse
            </ul>
        </section>

        <section class="saas-panel overflow-hidden">
            <div class="border-b px-6 py-4">
                <h2 class="font-bold">{{ __('admin.top_clients') }}</h2>
            </div>
            <ul class="divide-y">
                @forelse ($topClients as $client)
                    <li class="flex items-center justify-between px-6 py-3">
                        <div>
                            <p class="font-semibold">{{ $client->name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $client->email }}</p>
                        </div>
                        <span class="saas-badge saas-badge-primary">{{ $client->demandes_count ?? 0 }} {{ __('nav.demandes') }}</span>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-on-surface-variant">{{ __('common.no_results') }}</li>
                @endforelse
            </ul>
        </section>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const growth = @json($growthChart ?? []);
    const roles = @json($roleChart ?? []);

    if (document.getElementById('growthChart')) {
        new Chart(document.getElementById('growthChart'), {
            type: 'line',
            data: {
                labels: growth.labels ?? [],
                datasets: [
                    { label: '{{ __('nav.admin.users') }}', data: growth.users ?? [], borderColor: '#00288e', backgroundColor: 'rgba(0,40,142,0.1)', fill: true, tension: 0.35 },
                    { label: '{{ __('nav.admin.orders') }}', data: growth.orders ?? [], borderColor: '#0060ac', backgroundColor: 'rgba(0,96,172,0.08)', fill: true, tension: 0.35 },
                    { label: '{{ __('nav.admin.demandes') }}', data: growth.demandes ?? [], borderColor: '#64a8fe', backgroundColor: 'rgba(100,168,254,0.08)', fill: true, tension: 0.35 },
                ]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
        });
    }

    if (document.getElementById('roleChart')) {
        new Chart(document.getElementById('roleChart'), {
            type: 'doughnut',
            data: {
                labels: roles.labels ?? [],
                datasets: [{
                    data: roles.values ?? [],
                    backgroundColor: ['#00288e', '#0060ac', '#64a8fe']
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    }
});
</script>
@endpush
