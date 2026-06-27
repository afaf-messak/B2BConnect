@extends('layouts.saas', ['navActive' => 'users'])

@section('content')
    <a href="{{ route('admin.users.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle">
        <x-slot:actions>
            <a href="{{ route('admin.users.edit', $user) }}" class="saas-btn-primary">{{ __('common.edit') }}</a>
        </x-slot:actions>
    </x-saas.page-header>

    <div class="grid gap-6 lg:grid-cols-3">
        <article class="saas-card lg:col-span-2">
            <dl class="grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('admin.full_name') }}</dt><dd class="mt-1 font-semibold">{{ $user->name }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">Email</dt><dd class="mt-1 font-semibold">{{ $user->email }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('admin.company') }}</dt><dd class="mt-1 font-semibold">{{ $user->company_name ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('admin.ice_number') }}</dt><dd class="mt-1 font-semibold">{{ $user->ice ?: '—' }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('roles.role') }}</dt><dd class="mt-1 font-semibold">{{ ucfirst($user->role) }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('admin.account_status') }}</dt><dd class="mt-1 font-semibold">{{ ucfirst($user->supplierStatusLabel()) }}</dd></div>
                <div><dt class="text-xs font-semibold uppercase text-on-surface-variant">{{ __('admin.registered_at') }}</dt><dd class="mt-1 font-semibold">{{ $user->created_at?->format('d/m/Y H:i') }}</dd></div>
            </dl>
        </article>
        <aside class="space-y-4">
            <article class="saas-card">
                <h3 class="font-bold">{{ __('admin.activity_overview') }}</h3>
                <dl class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><dt>{{ __('admin.demandes_count') }}</dt><dd class="font-bold">{{ $user->demandes_count }}</dd></div>
                    <div class="flex justify-between"><dt>{{ __('admin.offers_count') }}</dt><dd class="font-bold">{{ $user->offres_count }}</dd></div>
                    <div class="flex justify-between"><dt>{{ __('admin.orders_count') }}</dt><dd class="font-bold">{{ $user->orders_count }}</dd></div>
                    <div class="flex justify-between"><dt>{{ __('admin.products_count') }}</dt><dd class="font-bold">{{ $user->products_count }}</dd></div>
                    <div class="flex justify-between"><dt>{{ __('admin.messages_count') }}</dt><dd class="font-bold">{{ $user->sent_messages_count + $user->received_messages_count }}</dd></div>
                </dl>
            </article>
            @if ($user->id !== auth()->id() && ! $user->isAdmin())
                <article class="saas-card space-y-3">
                    @if ($user->isSuspended())
                        <form method="POST" action="{{ route('admin.users.activate', $user) }}">@csrf @method('PATCH')<button type="submit" class="saas-btn-primary w-full">{{ __('admin.activate_user') }}</button></form>
                    @else
                        <form method="POST" action="{{ route('admin.users.suspend', $user) }}">@csrf @method('PATCH')<button type="submit" class="saas-btn-secondary w-full">{{ __('admin.suspend_user') }}</button></form>
                    @endif
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">@csrf @method('DELETE')<button type="submit" class="saas-btn-danger w-full">{{ __('admin.delete_user') }}</button></form>
                </article>
            @endif
        </aside>
    </div>

    @if ($user->demandes->isNotEmpty())
        <section class="saas-panel mt-6 overflow-hidden">
            <div class="border-b px-6 py-4"><h3 class="font-bold">{{ __('nav.admin.demandes') }}</h3></div>
            <div class="overflow-x-auto">
                <table class="saas-table">
                    <thead><tr><th>{{ __('demandes.title') }}</th><th>{{ __('common.status') }}</th><th>{{ __('common.date') }}</th><th></th></tr></thead>
                    <tbody>
                        @foreach ($user->demandes as $demande)
                            <tr>
                                <td class="font-semibold">{{ $demande->title }}</td>
                                <td>{{ ucfirst($demande->status) }}</td>
                                <td>{{ $demande->created_at?->format('d/m/Y') }}</td>
                                <td class="text-end"><a href="{{ route('admin.demandes.show', $demande) }}" class="saas-btn-ghost saas-btn-sm">{{ __('common.view') }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    @if ($user->products->isNotEmpty())
        <section class="saas-panel mt-6 overflow-hidden">
            <div class="border-b px-6 py-4"><h3 class="font-bold">{{ __('nav.admin.products') }}</h3></div>
            <div class="overflow-x-auto">
                <table class="saas-table">
                    <thead><tr><th>{{ __('products.name') }}</th><th>{{ __('products.price') }}</th><th>{{ __('products.stock') }}</th><th></th></tr></thead>
                    <tbody>
                        @foreach ($user->products as $product)
                            <tr>
                                <td class="font-semibold">{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 2) }} {{ __('common.currency') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td class="text-end"><a href="{{ route('admin.products.edit', $product) }}" class="saas-btn-ghost saas-btn-sm">{{ __('common.edit') }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    @if ($user->offres->isNotEmpty())
        <section class="saas-panel mt-6 overflow-hidden">
            <div class="border-b px-6 py-4"><h3 class="font-bold">{{ __('nav.admin.offers') }}</h3></div>
            <div class="overflow-x-auto">
                <table class="saas-table">
                    <thead><tr><th>{{ __('marketplace.quotation_title') }}</th><th>{{ __('common.status') }}</th><th></th></tr></thead>
                    <tbody>
                        @foreach ($user->offres as $offre)
                            <tr>
                                <td class="font-semibold">{{ $offre->title }}</td>
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
