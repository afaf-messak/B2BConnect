<section id="faq" class="bg-zinc-50 py-24 dark:bg-zinc-900/50 lg:py-32">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="text-sm font-semibold uppercase tracking-widest text-brand-600 dark:text-brand-400">{{ __('landing.faq.label') }}</span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">{{ __('landing.faq.title') }}</h2>
        </div>

        <div class="mt-12 space-y-3" data-aos="fade-up" data-aos-delay="100">
            @foreach (__('landing.faq.items') as $faq)
                <details class="faq-item group glass-card rounded-xl">
                    <summary class="flex cursor-pointer list-none items-center justify-between px-6 py-5 font-semibold">
                        {{ $faq['q'] }}
                        <span class="faq-icon material-symbols-outlined text-brand-500 transition-transform duration-300">add</span>
                    </summary>
                    <div class="border-t border-zinc-200/80 px-6 pb-5 pt-4 text-zinc-600 dark:border-zinc-700/80 dark:text-zinc-400">
                        {{ $faq['a'] }}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
