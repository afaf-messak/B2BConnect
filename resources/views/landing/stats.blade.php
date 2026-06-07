<section id="stats" class="relative overflow-hidden bg-zinc-950 py-24 text-white lg:py-32">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-600/20 via-transparent to-violet-600/10"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ __('landing.stats.title') }}</h2>
            <p class="mt-4 text-zinc-400">{{ __('landing.stats.subtitle') }}</p>
        </div>

        <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach (__('landing.stats.items') as $i => $stat)
                <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="text-4xl font-bold sm:text-5xl lg:text-6xl">
                        <span
                            class="landing-gradient-text"
                            x-data="counter({{ $stat['value'] }}, '{{ $stat['suffix'] }}')"
                            x-init="observe($el)"
                            x-text="display"
                        >0{{ $stat['suffix'] }}</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-zinc-400">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
