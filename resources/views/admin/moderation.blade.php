@extends('layouts.saas', [
    'title' => $pageTitle . ' - ' . __('common.app_name'),
    'navActive' => 'moderation',
])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <section class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
        @foreach ($stats as $stat)
            <article class="saas-card">
                <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">{{ $stat['label'] }}</p>
                <p class="mt-3 text-4xl font-extrabold text-primary">{{ $stat['value'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest shadow-card saas-panel">
        <div class="flex items-center justify-between border-b border-outline-variant/30 px-6 py-4">
            <h3 class="text-xl font-bold text-on-surface">{{ __('nav.admin.suppliers_validation') }}</h3>
            <span class="rounded-full bg-surface-container-low px-3 py-1 text-xs font-bold text-primary">{{ $documents->total() }} {{ __('common.items') }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('roles.supplier') }}</th>
                        <th>{{ __('roles.document') }}</th>
                        <th>{{ __('common.date') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr>
                            <td>
                                @php
                                    $statusClass = match ($document->status) {
                                        'approved' => 'bg-green-100 text-green-800 dark:bg-green-950 dark:text-green-100',
                                        'rejected' => 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-100',
                                        default => 'bg-secondary-container/30 text-primary',
                                    };
                                @endphp
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">{{ ucfirst($document->status) }}</span>
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary">storefront</span>
                                    <div>
                                        <p class="font-semibold">{{ $document->user?->name ?? '—' }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $document->user?->company_name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-on-surface-variant">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</td>
                            <td class="text-on-surface-variant">{{ $document->created_at?->format('d/m/Y') }}</td>
                            <td class="text-end">
                                @if ($document->status === 'pending')
                                    <div class="flex flex-wrap items-center justify-end gap-2">
                                        <form method="POST" action="{{ route('admin.moderation.approve', $document) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="saas-btn-primary saas-btn-sm">{{ __('common.approve') }}</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.moderation.reject', $document) }}" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" name="rejection_reason" required placeholder="{{ __('roles.rejection_reason') }}" class="saas-input w-40 text-xs">
                                            <button type="submit" class="saas-btn-danger saas-btn-sm">{{ __('common.reject') }}</button>
                                        </form>
                                    </div>
                                @elseif ($document->rejection_reason)
                                    <span class="text-xs text-on-surface-variant">{{ $document->rejection_reason }}</span>
                                @else
                                    <span class="text-xs text-on-surface-variant">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($documents->hasPages())
            <div class="border-t border-outline-variant/30 px-6 py-4">{{ $documents->links() }}</div>
        @endif
    </section>
@endsection
