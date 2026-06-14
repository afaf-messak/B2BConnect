<section id="faq" class="relative overflow-hidden bg-zinc-50 py-28 dark:bg-zinc-900/40 lg:py-36">
    <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="section-label">{{ __('landing.faq.label') }}</span>
            <h2 class="landing-display mt-6 text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('landing.faq.title') }}</h2>
            <p class="mt-5 text-zinc-600 dark:text-zinc-400">{{ __('landing.faq.subtitle') }}</p>
        </div>

        <div class="mt-14 space-y-3" data-aos="fade-up" data-aos-delay="100">
            @foreach (__('landing.faq.items') as $faq)
                <details class="faq-item group glass-card overflow-hidden rounded-2xl transition hover:shadow-lg">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 font-semibold">
                        <span>{{ $faq['q'] }}</span>
                        <span class="faq-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-brand-500/10 text-brand-600 transition-transform duration-300 dark:text-brand-400">
                            <span class="material-symbols-outlined text-lg">add</span>
                        </span>
                    </summary>
                    <div class="border-t border-zinc-200/60 px-6 pb-5 pt-4 leading-relaxed text-zinc-600 dark:border-zinc-700/60 dark:text-zinc-400">
                        {{ $faq['a'] }}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
