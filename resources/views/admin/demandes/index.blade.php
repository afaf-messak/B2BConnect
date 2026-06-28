@extends('layouts.saas', ['navActive' => 'demandes'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle">
        <x-slot:actions>
            <a href="{{ route('admin.demandes.create') }}" class="saas-btn-primary">{{ __('admin.add_demande') }}</a>
        </x-slot:actions>
    </x-saas.page-header>
    <x-admin.stats-row :stats="$stats" />

    <x-admin.filter-bar :action="route('admin.demandes.index')">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[200px] flex-1">
        <select name="status" class="saas-input w-auto">
            <option value="">{{ __('common.status') }}</option>
            @foreach (['pending', 'approved', 'rejected', 'completed'] as $s)
                <option value="{{ $s }}" @selected(($filters['status'] ?? '') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </x-admin.filter-bar>

    <section class="saas-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('demandes.title') }}</th>
                        <th>{{ __('roles.client') }}</th>
                        <th>{{ __('demandes.budget') }}</th>
                        <th>{{ __('demandes.category') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('common.date') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($demandes as $demande)
                        <tr>
                            <td class="font-semibold">{{ $demande->title }}</td>
                            <td>{{ $demande->user?->name }}</td>
                            <td>{{ $demande->budget ? number_format($demande->budget, 2).' '.__('common.currency') : '—' }}</td>
                            <td>{{ $demande->category ?: '—' }}</td>
                            <td><span class="saas-badge saas-badge-primary">{{ ucfirst($demande->status) }}</span></td>
                            <td>{{ $demande->created_at?->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.demandes.show', $demande) }}" class="saas-btn-secondary saas-btn-sm">{{ __('common.view') }}</a>
                                    <a href="{{ route('admin.demandes.edit', $demande) }}" class="saas-btn-ghost saas-btn-sm">{{ __('common.edit') }}</a>
                                    <form method="POST" action="{{ route('admin.demandes.destroy', $demande) }}" class="inline" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">@csrf @method('DELETE')<button type="submit" class="saas-btn-danger saas-btn-sm">{{ __('common.delete') }}</button></form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($demandes->hasPages())<div class="border-t px-6 py-4">{{ $demandes->links() }}</div>@endif
    </section>
@endsection
