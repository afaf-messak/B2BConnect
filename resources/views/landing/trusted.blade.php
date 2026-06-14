<section id="trusted" class="relative overflow-hidden border-y border-zinc-200/60 bg-white/50 py-14 dark:border-zinc-800 dark:bg-zinc-950/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">
                {{ __('landing.trusted.title') }}
            </p>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('landing.trusted.subtitle') }}
            </p>
        </div>

        <div class="relative mt-10 overflow-hidden" data-aos="fade-up" data-aos-delay="80">
            <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-24 bg-gradient-to-r from-white to-transparent dark:from-zinc-950"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-24 bg-gradient-to-l from-white to-transparent dark:from-zinc-950"></div>
            <div class="marquee-track flex w-max items-center gap-4">
                @foreach (array_merge(__('landing.trusted.sectors'), __('landing.trusted.sectors')) as $sector)
                    <div class="flex shrink-0 items-center gap-2.5 rounded-full border border-zinc-200/80 bg-white px-5 py-2.5 shadow-sm dark:border-zinc-700/80 dark:bg-zinc-900/80">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ $sector['iconClass'] }}">
                            <span class="material-symbols-outlined text-base">{{ $sector['icon'] }}</span>
                        </span>
                        <span class="whitespace-nowrap text-sm font-semibold text-zinc-700 dark:text-zinc-300">{{ $sector['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-10 flex flex-wrap items-center justify-center gap-6 text-center" data-aos="fade-up" data-aos-delay="120">
            @foreach (__('landing.trusted.pillars') as $pillar)
                <div class="flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                    <span class="material-symbols-outlined text-base text-brand-500">{{ $pillar['icon'] }}</span>
                    <span>{{ $pillar['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
