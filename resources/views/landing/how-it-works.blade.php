<section id="how-it-works" class="relative overflow-hidden bg-zinc-950 py-28 text-white dark:bg-zinc-900/80 lg:py-36">
    <div class="absolute inset-0 landing-mesh opacity-40"></div>
    <div class="absolute inset-0 grid-pattern opacity-20"></div>
    <div class="section-glow absolute left-1/2 top-0 h-64 w-[40rem] -translate-x-1/2 bg-brand-600/20"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="section-label border-brand-500/30 bg-brand-500/10 text-brand-300">{{ __('landing.how_it_works.label') }}</span>
            <h2 class="landing-display mt-6 text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('landing.how_it_works.title') }}</h2>
            <p class="mt-5 text-lg text-zinc-400">{{ __('landing.how_it_works.subtitle') }}</p>
        </div>

        <div class="relative mt-24 grid gap-8 md:grid-cols-3">
            <div class="absolute left-[16.67%] right-[16.67%] top-16 hidden h-px md:block">
                <div class="step-connector h-full w-full"></div>
            </div>

            @foreach (__('landing.how_it_works.steps') as $i => $step)
                <div class="relative text-center" data-aos="fade-up" data-aos-delay="{{ $i * 120 }}">
                    <div class="relative mx-auto mb-8 flex h-20 w-20 items-center justify-center">
                        <div class="absolute inset-0 rounded-2xl bg-brand-500/20 blur-xl"></div>
                        <div class="relative flex h-20 w-20 items-center justify-center rounded-2xl border border-brand-500/30 bg-brand-500/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-3xl text-brand-300">{{ $step['icon'] }}</span>
                        </div>
                        <span class="absolute -right-2 -top-2 flex h-7 w-7 items-center justify-center rounded-full bg-brand-500 text-xs font-bold text-white shadow-lg shadow-brand-500/40">
                            {{ $step['num'] }}
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold">{{ $step['title'] }}</h3>
                    <p class="mx-auto mt-3 max-w-xs text-sm leading-relaxed text-zinc-400">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-20 text-center" data-aos="fade-up">
            <a href="{{ route('register') }}" class="btn-primary inline-flex items-center gap-2 rounded-2xl px-8 py-4 text-base font-semibold text-white">
                {{ __('landing.how_it_works.cta') }}
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
</section>
