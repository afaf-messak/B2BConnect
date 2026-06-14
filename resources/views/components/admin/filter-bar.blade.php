@props(['action', 'method' => 'GET'])

<form method="{{ $method === 'GET' ? 'GET' : 'POST' }}" action="{{ $action }}" class="mb-6 flex flex-wrap items-end gap-3">
    @if ($method !== 'GET')
        @csrf
        @method($method)
    @endif
    {{ $slot }}
    <button type="submit" class="saas-btn-primary">{{ __('common.filter') }}</button>
    @if (request()->query())
        <a href="{{ $action }}" class="saas-btn-secondary">{{ __('common.all') }}</a>
    @endif
</form>
