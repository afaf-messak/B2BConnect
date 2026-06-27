@extends('layouts.saas', [
    'title' => $title . ' - ' . __('common.app_name'),
    'navActive' => $navActive ?? 'dashboard',
])

@section('header-actions')
    <button type="button" class="saas-btn-secondary">{{ __('common.export') }}</button>
    <button type="button" class="saas-btn-primary">{{ __('common.add') }}</button>
@endsection

@section('content')
    <section class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
        @foreach ($stats as $stat)
            <article class="saas-card">
                <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">{{ $stat['label'] }}</p>
                <p class="mt-3 text-4xl font-extrabold text-primary">{{ $stat['value'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="saas-panel">
        <div class="saas-panel-header">
            <h3 class="text-xl font-bold text-on-surface">{{ $title }}</h3>
            <span class="saas-badge saas-badge-primary">{{ count($rows) }} {{ __('common.items') }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('common.status') }}</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Meta</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                        <tr>
                            <td><span class="saas-badge saas-badge-primary">{{ $row['status'] }}</span></td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary">{{ $row['icon'] }}</span>
                                    <div>
                                        <p class="font-semibold">{{ $row['title'] }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $row['subtitle'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-on-surface-variant">{{ $row['subtitle'] }}</td>
                            <td class="text-on-surface-variant">{{ $row['meta'] }}</td>
                            <td class="text-end">
                                <button type="button" class="saas-btn-ghost saas-btn-icon" aria-label="{{ __('common.actions') }}">
                                    <span class="material-symbols-outlined">more_vert</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
