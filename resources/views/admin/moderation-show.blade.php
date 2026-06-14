@extends('layouts.saas', ['navActive' => 'moderation'])

@section('content')
    <a href="{{ route('admin.moderation') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <div class="grid gap-6 lg:grid-cols-3">
        <article class="saas-card lg:col-span-2">
            <dl class="grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('common.company') }}</dt><dd class="mt-1 font-bold">{{ $supplier?->company_name ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('admin.ice_number') }}</dt><dd class="mt-1 font-mono font-bold">{{ $supplier?->ice ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">Email</dt><dd class="mt-1 font-bold">{{ $supplier?->email }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('admin.account_status') }}</dt><dd class="mt-1 font-bold">{{ ucfirst($supplier?->supplierStatusLabel() ?? '—') }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('roles.document') }}</dt><dd class="mt-1 font-bold">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('common.status') }}</dt><dd class="mt-1 font-bold">{{ ucfirst($document->status) }}</dd></div>
            </dl>
            @if ($document->rejection_reason)
                <p class="mt-6 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-800">{{ $document->rejection_reason }}</p>
            @endif
        </article>
        <aside class="saas-card space-y-4">
            @if ($document->status === 'pending')
                <form method="POST" action="{{ route('admin.moderation.approve', $document) }}">@csrf @method('PATCH')<button type="submit" class="saas-btn-primary w-full">{{ __('common.approve') }}</button></form>
                <form method="POST" action="{{ route('admin.moderation.reject', $document) }}" class="space-y-3">@csrf @method('PATCH')
                    <textarea name="rejection_reason" rows="3" required placeholder="{{ __('roles.rejection_reason') }}" class="saas-input w-full text-sm"></textarea>
                    <button type="submit" class="saas-btn-danger w-full">{{ __('common.reject') }}</button>
                </form>
            @else
                <p class="text-sm text-on-surface-variant">{{ __('admin.supplier_review') }}: {{ ucfirst($document->status) }}</p>
            @endif
        </aside>
    </div>
@endsection
