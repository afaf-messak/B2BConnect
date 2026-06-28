@extends('layouts.saas', ['navActive' => 'users'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle">
        <x-slot:actions>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.users.create', ['role' => 'client']) }}" class="saas-btn-primary">{{ __('admin.add_client') }}</a>
                <a href="{{ route('admin.users.create', ['role' => 'supplier']) }}" class="saas-btn-secondary">{{ __('admin.add_supplier') }}</a>
                <a href="{{ route('admin.users.create') }}" class="saas-btn-ghost">{{ __('admin.add_user') }}</a>
            </div>
        </x-slot:actions>
    </x-saas.page-header>

    <x-admin.stats-row :stats="$stats" />

    <x-admin.filter-bar :action="route('admin.users.index')">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[200px] flex-1">
        <select name="role" class="saas-input w-auto">
            <option value="">{{ __('roles.role') ?? 'Role' }}</option>
            @foreach ([\App\Models\User::ROLE_CLIENT, \App\Models\User::ROLE_SUPPLIER, \App\Models\User::ROLE_ADMIN] as $roleOption)
                <option value="{{ $roleOption }}" @selected(($filters['role'] ?? '') === $roleOption)>{{ ucfirst($roleOption) }}</option>
            @endforeach
        </select>
        <select name="status" class="saas-input w-auto">
            <option value="">{{ __('common.status') }}</option>
            @foreach ([\App\Models\User::STATUS_ACTIVE, \App\Models\User::STATUS_PENDING, \App\Models\User::STATUS_SUSPENDED, \App\Models\User::STATUS_REJECTED] as $statusOption)
                <option value="{{ $statusOption }}" @selected(($filters['status'] ?? '') === $statusOption)>{{ ucfirst($statusOption) }}</option>
            @endforeach
        </select>
    </x-admin.filter-bar>

    <section class="saas-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('nav.admin.users') }}</th>
                        <th>{{ __('roles.role') ?? 'Role' }}</th>
                        <th>{{ __('admin.company') }}</th>
                        <th>{{ __('admin.registered_at') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                @php
                                    $badge = match ($user->account_status) {
                                        'active' => 'saas-badge-success',
                                        'pending' => 'saas-badge-warning',
                                        'suspended', 'rejected' => 'saas-badge-danger',
                                        default => 'saas-badge-primary',
                                    };
                                @endphp
                                <span class="saas-badge {{ $badge }}">{{ ucfirst($user->account_status) }}</span>
                            </td>
                            <td>
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $user->email }}</p>
                            </td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td class="text-on-surface-variant">{{ $user->company_name ?: '—' }}</td>
                            <td class="text-on-surface-variant">{{ $user->created_at?->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="saas-btn-secondary saas-btn-sm">{{ __('common.view') }}</a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="saas-btn-ghost saas-btn-sm">{{ __('common.edit') }}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="border-t border-outline-variant/20 px-6 py-4">{{ $users->links() }}</div>
        @endif
    </section>
@endsection
