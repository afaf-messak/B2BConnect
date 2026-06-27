@props([
    'product' => null,
    'src' => null,
    'alt' => '',
    'size' => 'card',
])

@php
    $url = $src ?? $product?->imageUrl();
    $altText = $alt ?: ($product?->localizedName() ?? $product?->name ?? '');
    $frameClass = match ($size) {
        'hero' => 'product-image-frame product-image-frame--hero',
        'thumb' => 'product-image-frame product-image-frame--thumb',
        'landing' => 'product-image-frame product-image-frame--landing',
        default => 'product-image-frame',
    };
@endphp

<div {{ $attributes->merge(['class' => $frameClass]) }}>
    @if ($url)
        <img
            src="{{ $url }}"
            alt="{{ $altText }}"
            class="product-image-frame__img"
            loading="lazy"
            decoding="async"
        >
    @else
        <div class="product-image-frame__placeholder">
            <span class="material-symbols-outlined">inventory_2</span>
        </div>
    @endif
</div>
