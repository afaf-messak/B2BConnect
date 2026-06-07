<section id="testimonials" class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="text-sm font-semibold uppercase tracking-widest text-brand-600 dark:text-brand-400">{{ __('landing.testimonials.label') }}</span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">{{ __('landing.testimonials.title') }}</h2>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-3">
            @foreach (__('landing.testimonials.items') as $i => $t)
                <div class="feature-card glass-card rounded-2xl p-8" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="mb-4 flex gap-0.5 text-amber-400">
                        @for ($s = 0; $s < 5; $s++)
                            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                    <blockquote class="leading-relaxed text-zinc-600 dark:text-zinc-400">"{{ $t['quote'] }}"</blockquote>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="h-11 w-11 rounded-full bg-gradient-to-br from-brand-400 to-violet-500"></div>
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
