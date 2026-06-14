@extends('layouts.saas', ['navActive' => 'moderation'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />
    <x-admin.stats-row :stats="$stats" />

    <x-admin.filter-bar :action="route('admin.moderation')">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[200px] flex-1">
        <select name="status" class="saas-input w-auto">
            <option value="">{{ __('common.status') }}</option>
            @foreach (['pending', 'approved', 'rejected'] as $s)
                <option value="{{ $s }}" @selected(($filters['status'] ?? '') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </x-admin.filter-bar>

    <section class="saas-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('roles.supplier') }}</th>
                        <th>{{ __('admin.ice_number') }}</th>
                        <th>{{ __('roles.document') }}</th>
                        <th>{{ __('common.date') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr>
                            <td>
                                @php $statusClass = match ($document->status) { 'approved' => 'bg-green-100 text-green-800', 'rejected' => 'bg-red-100 text-red-800', default => 'bg-secondary-container/30 text-primary' }; @endphp
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">{{ ucfirst($document->status) }}</span>
                            </td>
                            <td>
                                <p class="font-semibold">{{ $document->user?->company_name ?: $document->user?->name }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $document->user?->email }}</p>
                            </td>
                            <td class="font-mono text-sm">{{ $document->user?->ice ?: '—' }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</td>
                            <td>{{ $document->created_at?->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <a href="{{ route('admin.moderation.show', $document) }}" class="saas-btn-secondary saas-btn-sm">{{ __('admin.view_details') }}</a>
                                    @if ($document->status === 'pending')
                                        <form method="POST" action="{{ route('admin.moderation.approve', $document) }}">@csrf @method('PATCH')<button type="submit" class="saas-btn-primary saas-btn-sm">{{ __('common.approve') }}</button></form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($documents->hasPages())<div class="border-t px-6 py-4">{{ $documents->links() }}</div>@endif
    </section>
@endsection
