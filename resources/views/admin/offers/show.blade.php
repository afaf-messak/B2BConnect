@extends('layouts.saas', ['navActive' => 'offers'])

@section('content')
    <a href="{{ route('admin.offers.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <div class="grid gap-6 lg:grid-cols-3">
        <article class="saas-card lg:col-span-2 space-y-4">
            <p class="text-on-surface-variant">{{ $offre->description ?: '—' }}</p>
            <dl class="grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('roles.supplier') }}</dt><dd class="mt-1 font-semibold">{{ $offre->user?->company_name ?: $offre->user?->name }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('demandes.title') }}</dt><dd class="mt-1 font-semibold">{{ $offre->demande?->title ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('marketplace.price') }}</dt><dd class="mt-1 font-bold text-primary">{{ number_format($offre->price, 2) }} {{ __('common.currency') }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('common.status') }}</dt><dd class="mt-1 font-semibold">{{ ucfirst($offre->status) }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('common.date') }}</dt><dd class="mt-1 font-semibold">{{ $offre->created_at?->format('d/m/Y H:i') }}</dd></div>
            </dl>
        </article>
        <aside class="saas-card space-y-3">
            @if ($offre->user)<a href="{{ route('admin.users.show', $offre->user) }}" class="saas-btn-secondary w-full">{{ __('admin.view_supplier') }}</a>@endif
            @if ($offre->demande)<a href="{{ route('admin.demandes.show', $offre->demande) }}" class="saas-btn-secondary w-full">{{ __('admin.view_demande') }}</a>@endif
            <form method="POST" action="{{ route('admin.offers.destroy', $offre) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">@csrf @method('DELETE')<button type="submit" class="saas-btn-danger w-full">{{ __('common.delete') }}</button></form>
        </aside>
    </div>
@endsection
