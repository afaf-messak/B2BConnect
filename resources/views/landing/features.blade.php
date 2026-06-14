<section id="features" class="relative overflow-hidden py-28 dark:bg-zinc-900/25 lg:py-36">
    <div class="section-glow absolute right-0 top-1/3 h-80 w-80 bg-violet-500/8"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="section-label">{{ __('landing.features.label') }}</span>
            <h2 class="landing-display mt-6 text-3xl font-bold sm:text-4xl lg:text-5xl">
                {{ __('landing.features.title') }}
                <span class="landing-gradient-text">{{ __('landing.features.title_highlight') }}</span>
            </h2>
            <p class="mt-5 text-lg text-zinc-600 dark:text-zinc-400">{{ __('landing.features.subtitle') }}</p>
        </div>

        <div class="mt-20 grid auto-rows-fr gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (__('landing.features.items') as $i => $feature)
                <div
                    class="feature-card glass-card group rounded-3xl p-8 {{ $i === 0 ? 'sm:col-span-2 lg:col-span-2 lg:row-span-1' : '' }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ $i * 70 }}"
                >
                    <div class="flex h-full flex-col">
                        <div class="feature-icon mb-6 flex h-14 w-14 items-center justify-center rounded-2xl {{ $feature['iconClass'] }}">
                            <span class="material-symbols-outlined text-2xl">{{ $feature['icon'] }}</span>
                        </div>
                        <h3 class="text-xl font-semibold tracking-tight">{{ $feature['title'] }}</h3>
                        <p class="mt-3 flex-1 leading-relaxed text-zinc-600 dark:text-zinc-400">{{ $feature['desc'] }}</p>
                        <a href="{{ $i === 2 ? route('products.catalog') : route('register') }}"
                           class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 transition-colors hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">
                            {{ __('landing.features.learn_more') }}
                            <span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
