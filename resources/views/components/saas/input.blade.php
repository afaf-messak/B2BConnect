@props([
    'label' => null,
    'error' => null,
    'type' => 'text',
])

<div {{ $attributes->only('class')->merge(['class' => 'saas-form-group']) }}>
    @if ($label)
        <label {{ $attributes->whereStartsWith('id')->isNotEmpty() ? '' : '' }} for="{{ $attributes->get('id') }}" class="saas-label">{{ $label }}</label>
    @endif

    @if ($type === 'textarea')
        <textarea {{ $attributes->except('class', 'label', 'error', 'type')->merge(['class' => 'saas-textarea' . ($error ? ' saas-input-error' : '')]) }}>{{ $slot }}</textarea>
    @elseif ($type === 'select')
        <select {{ $attributes->except('class', 'label', 'error', 'type')->merge(['class' => 'saas-select' . ($error ? ' saas-input-error' : '')]) }}>{{ $slot }}</select>
    @else
        <input type="{{ $type }}" {{ $attributes->except('class', 'label', 'error', 'type')->merge(['class' => 'saas-input' . ($error ? ' saas-input-error' : '')]) }} />
    @endif

    @if ($error)
        <p class="saas-field-error">{{ $error }}</p>
    @endif
</div>
