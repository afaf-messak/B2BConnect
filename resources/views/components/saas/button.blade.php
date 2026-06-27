@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
])

@php
    $classes = match ($variant) {
        'secondary' => 'saas-btn-secondary',
        'danger' => 'saas-btn-danger',
        'ghost' => 'saas-btn-ghost',
        default => 'saas-btn-primary',
    };

    $classes .= match ($size) {
        'sm' => ' saas-btn-sm',
        'lg' => ' saas-btn-lg',
        'icon' => ' saas-btn-icon',
        default => '',
    };
@endphp

@if ($href)
    <a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => $type]) }}>{{ $slot }}</button>
@endif
