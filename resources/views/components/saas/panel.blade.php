@props(['title' => null, 'badge' => null])

<section {{ $attributes->merge(['class' => 'saas-panel']) }}>
    @if ($title || isset($header))
        <div class="saas-panel-header">
            @if ($title)
                <h3 class="text-lg font-bold text-on-surface">{{ $title }}</h3>
            @endif
            @if (isset($header))
                {{ $header }}
            @endif
            @if ($badge)
                <span class="saas-badge saas-badge-primary">{{ $badge }}</span>
            @endif
        </div>
    @endif

    <div class="saas-panel-body">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="saas-panel-footer">{{ $footer }}</div>
    @endif
</section>
