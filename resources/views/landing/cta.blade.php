<section id="cta" class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-600 via-brand-700 to-violet-700 px-8 py-16 text-center text-white sm:px-16 lg:py-24" data-aos="zoom-in">
            <div class="absolute inset-0 grid-pattern opacity-20"></div>
            <div class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 h-64 w-64 rounded-full bg-violet-400/20 blur-3xl"></div>

            <div class="relative">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">{{ __('landing.cta.title') }}</h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-brand-100">{{ __('landing.cta.subtitle') }}</p>
                <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-brand-700 shadow-xl transition hover:-translate-y-0.5 hover:shadow-2xl">
                        {{ __('landing.cta.primary') }}
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                        {{ __('landing.cta.secondary') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
