@props(['stats'])

<div class="mb-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5">
    @foreach ($stats as $stat)
        <article class="saas-card py-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-on-surface-variant">{{ $stat['label'] }}</p>
            <p class="mt-2 text-2xl font-bold text-primary">{{ $stat['value'] }}</p>
        </article>
    @endforeach
</div>
