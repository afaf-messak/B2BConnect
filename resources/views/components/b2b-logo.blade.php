@props([
    'size' => 'md',
    'showTagline' => false,
    'href' => '/',
])

@php
    $sizes = [
        'sm' => ['compact' => 'h-9', 'full' => 'h-12'],
        'md' => ['compact' => 'h-10', 'full' => 'h-14'],
        'lg' => ['compact' => 'h-11', 'full' => 'h-16'],
    ];
    $s = $sizes[$size] ?? $sizes['md'];
    $heightClass = $showTagline ? $s['full'] : $s['compact'];
    $srcLight = $showTagline
        ? asset('images/b2bconnect-logo-transparent.png')
        : asset('images/b2bconnect-logo-mark-transparent.png');
    $srcDark = $showTagline
        ? asset('images/b2bconnect-logo-dark.png')
        : asset('images/b2bconnect-logo-mark-dark.png');
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group inline-flex items-center leading-none']) }}>
    <img
        src="{{ $srcLight }}"
        alt="{{ __('common.app_name') }}"
        class="b2b-logo-img block {{ $heightClass }} w-auto max-w-none object-contain transition-transform group-hover:scale-[1.02] dark:hidden"
    >
    <img
        src="{{ $srcDark }}"
        alt=""
        aria-hidden="true"
        class="b2b-logo-img block {{ $heightClass }} hidden w-auto max-w-none object-contain transition-transform group-hover:scale-[1.02] dark:block"
    >
</a>
