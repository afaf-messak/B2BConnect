<section id="stats" class="stats-section relative overflow-hidden py-28 lg:py-36">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-600/20 via-brand-900/40 to-violet-900/30"></div>
    <div class="absolute inset-0 grid-pattern opacity-20"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="section-label border-brand-400/40 bg-brand-500/20 text-brand-200">{{ __('landing.stats.label') }}</span>
            <h2 class="landing-display mt-6 text-3xl font-bold text-white sm:text-4xl lg:text-5xl">{{ __('landing.stats.title') }}</h2>
            <p class="mt-5 text-lg text-zinc-300">{{ __('landing.stats.subtitle') }}</p>
        </div>

        <div class="mt-20 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($landingStats as $i => $stat)
                <div class="stat-pill premium-card rounded-3xl p-8 text-center" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="text-4xl font-bold sm:text-5xl lg:text-6xl">
                        <span
                            class="landing-gradient-text"
                            x-data="counter({{ $stat['value'] }}, '{{ $stat['suffix'] }}')"
                            x-init="observe($el)"
                            x-text="display"
                        >0{{ $stat['suffix'] }}</span>
                    </div>
                    <p class="mt-3 text-sm font-medium text-zinc-300">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
