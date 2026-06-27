@extends('layouts.saas', ['navActive' => 'demandes'])

@section('content')
    <a href="{{ route('admin.demandes.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle">
        <x-slot:actions>
            <a href="{{ route('admin.demandes.edit', $demande) }}" class="saas-btn-primary">{{ __('common.edit') }}</a>
        </x-slot:actions>
    </x-saas.page-header>

    <div class="grid gap-6 lg:grid-cols-3">
        <article class="saas-card lg:col-span-2 space-y-4">
            <p class="text-on-surface-variant">{{ $demande->description }}</p>
            <dl class="grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('roles.client') }}</dt><dd class="mt-1 font-semibold">{{ $demande->user?->name }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('demandes.category') }}</dt><dd class="mt-1 font-semibold">{{ $demande->category ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('demandes.quantity') ?? 'Quantity' }}</dt><dd class="mt-1 font-semibold">{{ $demande->quantity }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('demandes.budget') }}</dt><dd class="mt-1 font-semibold">{{ $demande->budget ? number_format($demande->budget, 2).' '.__('common.currency') : '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('common.status') }}</dt><dd class="mt-1 font-semibold">{{ ucfirst($demande->status) }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('common.date') }}</dt><dd class="mt-1 font-semibold">{{ $demande->created_at?->format('d/m/Y') }}</dd></div>
            </dl>
        </article>
        <aside class="saas-card space-y-3">
            <a href="{{ route('admin.users.show', $demande->user) }}" class="saas-btn-secondary w-full">{{ __('admin.view_client') }}</a>
            <form method="POST" action="{{ route('admin.demandes.destroy', $demande) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">@csrf @method('DELETE')<button type="submit" class="saas-btn-danger w-full">{{ __('admin.delete_demande') }}</button></form>
        </aside>
    </div>

    @if ($demande->offres->isNotEmpty())
        <section class="saas-panel mt-6 overflow-hidden">
            <div class="border-b px-6 py-4"><h3 class="font-bold">{{ __('nav.admin.offers') }} ({{ $demande->offres->count() }})</h3></div>
            <div class="overflow-x-auto">
                <table class="saas-table">
                    <thead><tr><th>{{ __('roles.supplier') }}</th><th>{{ __('marketplace.price') }}</th><th>{{ __('common.status') }}</th><th></th></tr></thead>
                    <tbody>
                        @foreach ($demande->offres as $offre)
                            <tr>
                                <td>{{ $offre->user?->company_name ?: $offre->user?->name }}</td>
                                <td class="font-bold text-primary">{{ number_format($offre->price, 2) }} {{ __('common.currency') }}</td>
                                <td>{{ ucfirst($offre->status) }}</td>
                                <td class="text-end"><a href="{{ route('admin.offers.show', $offre) }}" class="saas-btn-ghost saas-btn-sm">{{ __('common.view') }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
@endsection
