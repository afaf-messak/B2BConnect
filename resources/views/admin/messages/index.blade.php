@extends('layouts.saas', ['navActive' => 'messages'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />
    <x-admin.stats-row :stats="$stats" />

    <x-admin.filter-bar :action="route('admin.messages.index')">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[240px] flex-1">
    </x-admin.filter-bar>

    <section class="saas-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.from') }}</th>
                        <th>{{ __('messages.to') }}</th>
                        <th>{{ __('messages.message') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('common.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $message->sender?->name }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $message->sender?->email }}</p>
                            </td>
                            <td>
                                <p class="font-semibold">{{ $message->receiver?->name }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $message->receiver?->email }}</p>
                            </td>
                            <td class="max-w-md truncate text-on-surface-variant">{{ $message->body }}</td>
                            <td>
                                <span class="saas-badge {{ $message->read_at ? 'saas-badge-success' : 'saas-badge-warning' }}">
                                    {{ $message->read_at ? __('messages.read') : __('messages.unread_status') }}
                                </span>
                            </td>
                            <td>{{ $message->created_at?->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($messages->hasPages())<div class="border-t px-6 py-4">{{ $messages->links() }}</div>@endif
    </section>
@endsection
