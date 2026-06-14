@extends('layouts.saas', ['navActive' => 'offers'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />
    <x-admin.stats-row :stats="$stats" />

    <x-admin.filter-bar :action="route('admin.offers.index')">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[200px] flex-1">
        <select name="status" class="saas-input w-auto">
            <option value="">{{ __('common.status') }}</option>
            @foreach (['pending', 'accepted', 'rejected'] as $s)
                <option value="{{ $s }}" @selected(($filters['status'] ?? '') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </x-admin.filter-bar>

    <section class="saas-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('marketplace.quotation_title') }}</th>
                        <th>{{ __('roles.supplier') }}</th>
                        <th>{{ __('demandes.title') }}</th>
                        <th>{{ __('marketplace.price') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('common.date') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $offre)
                        <tr>
                            <td class="font-semibold">{{ $offre->title }}</td>
                            <td>{{ $offre->user?->company_name ?: $offre->user?->name }}</td>
                            <td>{{ $offre->demande?->title ?: '—' }}</td>
                            <td class="font-bold text-primary">{{ number_format($offre->price, 2) }} {{ __('common.currency') }}</td>
                            <td><span class="saas-badge saas-badge-primary">{{ ucfirst($offre->status) }}</span></td>
                            <td>{{ $offre->created_at?->format('d/m/Y') }}</td>
                            <td class="text-end"><a href="{{ route('admin.offers.show', $offre) }}" class="saas-btn-secondary saas-btn-sm">{{ __('common.view') }}</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($offers->hasPages())<div class="border-t px-6 py-4">{{ $offers->links() }}</div>@endif
    </section>
@endsection
