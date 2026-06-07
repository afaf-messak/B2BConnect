<section id="features" class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="text-sm font-semibold uppercase tracking-widest text-brand-600 dark:text-brand-400">{{ __('landing.features.label') }}</span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">
                {{ __('landing.features.title') }}
                <span class="landing-gradient-text">{{ __('landing.features.title_highlight') }}</span>
            </h2>
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('landing.features.subtitle') }}</p>
        </div>

        <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (__('landing.features.items') as $i => $feature)
                <div class="feature-card glass-card group rounded-2xl p-8" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl transition group-hover:scale-110 {{ $feature['iconClass'] }}">
                        <span class="material-symbols-outlined text-2xl">{{ $feature['icon'] }}</span>
                    </div>
                    <h3 class="text-xl font-semibold">{{ $feature['title'] }}</h3>
                    <p class="mt-3 leading-relaxed text-zinc-600 dark:text-zinc-400">{{ $feature['desc'] }}</p>
                    <a href="{{ route('register') }}" class="mt-5 inline-flex items-center gap-1 text-sm font-semibold text-brand-600 opacity-0 transition-all group-hover:opacity-100 dark:text-brand-400">
                        {{ __('landing.features.learn_more') }}
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
