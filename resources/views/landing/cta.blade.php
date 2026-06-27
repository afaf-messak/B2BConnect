<section id="cta" class="py-28 dark:bg-zinc-900/20 lg:py-36">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[2rem]" data-aos="zoom-in">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-600 via-brand-700 to-violet-700"></div>
            <div class="absolute inset-0 landing-aurora opacity-60"></div>
            <div class="absolute inset-0 grid-pattern opacity-20"></div>
            <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-violet-400/20 blur-3xl"></div>

            <div class="relative px-8 py-20 text-center text-white sm:px-16 lg:py-28">
                <h2 class="landing-display text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('landing.cta.title') }}</h2>
                <p class="mx-auto mt-5 max-w-2xl text-lg text-brand-100">{{ __('landing.cta.subtitle') }}</p>

                <div class="mt-12 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('marketplace.suppliers.index') }}"
                       class="inline-flex items-center gap-2 rounded-2xl bg-white px-8 py-4 text-base font-semibold text-brand-700 shadow-2xl shadow-black/20 transition hover:-translate-y-1 hover:shadow-white/20">
                        <span class="material-symbols-outlined">search</span>
                        {{ __('landing.cta.primary') }}
                    </a>
                    <a href="{{ route('register') }}"
                       class="btn-glass inline-flex items-center gap-2 rounded-2xl px-8 py-4 text-base font-semibold text-white">
                        <span class="material-symbols-outlined">storefront</span>
                        {{ __('landing.cta.secondary') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
