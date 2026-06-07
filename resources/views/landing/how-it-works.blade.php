<section id="how-it-works" class="relative overflow-hidden bg-zinc-950 py-24 text-white lg:py-32">
    <div class="absolute inset-0 landing-mesh opacity-50"></div>
    <div class="absolute inset-0 grid-pattern opacity-30"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="text-sm font-semibold uppercase tracking-widest text-brand-400">{{ __('landing.how_it_works.label') }}</span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">{{ __('landing.how_it_works.title') }}</h2>
            <p class="mt-4 text-lg text-zinc-400">{{ __('landing.how_it_works.subtitle') }}</p>
        </div>

        <div class="mt-20 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            @foreach (__('landing.how_it_works.steps') as $i => $step)
                <div class="relative" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    @if ($i < 3)
                        <div class="absolute left-1/2 top-12 hidden h-px w-full bg-gradient-to-r from-brand-500/50 to-transparent lg:block"></div>
                    @endif
                    <div class="glass-card rounded-2xl p-8 text-center">
                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-500/20">
                            <span class="material-symbols-outlined text-2xl text-brand-400">{{ $step['icon'] }}</span>
                        </div>
                        <div class="mb-2 text-xs font-bold tracking-widest text-brand-400">{{ $step['num'] }}</div>
                        <h3 class="text-lg font-semibold">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-zinc-400">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
