<section id="testimonials" class="relative overflow-hidden py-28 dark:bg-zinc-900/25 lg:py-36">
    <div class="section-glow absolute -left-32 top-1/2 h-80 w-80 bg-brand-500/8"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="section-label">{{ __('landing.testimonials.label') }}</span>
            <h2 class="landing-display mt-6 text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('landing.testimonials.title') }}</h2>
        </div>

        <div class="mt-20 grid gap-6 md:grid-cols-3">
            @foreach (__('landing.testimonials.items') as $i => $t)
                <div class="premium-card glass-card relative rounded-3xl p-8" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <span class="absolute right-6 top-6 text-5xl font-serif leading-none text-brand-500/15">"</span>
                    <div class="mb-5 flex gap-0.5 text-amber-400">
                        @for ($s = 0; $s < 5; $s++)
                            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                    <blockquote class="relative leading-relaxed text-zinc-600 dark:text-zinc-400">"{{ $t['quote'] }}"</blockquote>
                    <div class="mt-8 flex items-center gap-4 border-t border-zinc-200/60 pt-6 dark:border-zinc-700/60">
                        <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-brand-400 to-violet-500 shadow-lg shadow-brand-500/20"></div>
                        <div>
                            <div class="font-semibold">{{ $t['name'] }}</div>
                            <div class="text-sm text-zinc-500">{{ $t['role'] }}, {{ $t['company'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
