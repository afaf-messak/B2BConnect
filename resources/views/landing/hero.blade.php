<section id="hero" class="landing-mesh grid-pattern relative min-h-screen overflow-hidden pt-28 pb-20 lg:pt-36 lg:pb-32">
    <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="particle left-[10%] top-[20%] h-2 w-2 bg-brand-400/40" style="animation-delay: 0s;"></div>
        <div class="particle left-[85%] top-[15%] h-3 w-3 bg-violet-400/30" style="animation-delay: 1s;"></div>
        <div class="particle left-[70%] top-[60%] h-2 w-2 bg-blue-400/35" style="animation-delay: 2s;"></div>
        <div class="particle left-[20%] top-[70%] h-4 w-4 bg-brand-300/25" style="animation-delay: 3s;"></div>
        <div class="particle left-[50%] top-[40%] h-1.5 w-1.5 bg-cyan-400/40" style="animation-delay: 1.5s;"></div>
        <div class="absolute -left-32 top-1/4 h-96 w-96 rounded-full bg-brand-500/20 blur-3xl animate-pulse-glow" :style="`transform: translate(${parallax.x * 0.02}px, ${parallax.y * 0.02}px)`"></div>
        <div class="absolute -right-32 top-1/3 h-80 w-80 animate-pulse-glow rounded-full bg-violet-500/15 blur-3xl [animation-delay:2s]" :style="`transform: translate(${parallax.x * -0.015}px, ${parallax.y * -0.015}px)`"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-16 lg:grid-cols-2 lg:gap-12">
            <div data-aos="fade-up" data-aos-duration="800">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-brand-200/60 bg-brand-50/80 px-4 py-1.5 text-sm font-medium text-brand-700 dark:border-brand-500/30 dark:bg-brand-500/10 dark:text-brand-300">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-brand-500"></span>
                    </span>
                    {{ __('landing.hero.badge') }}
                </div>

                <h1 class="text-4xl font-bold leading-[1.08] tracking-tight sm:text-5xl lg:text-6xl xl:text-7xl">
                    {{ __('landing.hero.title') }}
                    <span class="landing-gradient-text block">{{ __('landing.hero.title_highlight') }}</span>
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-400 sm:text-xl">
                    {{ __('landing.hero.subtitle') }}
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <a href="{{ route('marketplace.suppliers.index') }}" class="btn-primary group inline-flex items-center gap-2 rounded-xl px-7 py-3.5 text-base font-semibold text-white">
                        {{ __('landing.hero.cta_primary') }}
                        <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1">arrow_forward</span>
                    </a>
                    <a href="{{ route('products.catalog') }}" class="btn-secondary inline-flex items-center gap-2 rounded-xl border border-zinc-200 px-7 py-3.5 text-base font-semibold dark:border-zinc-700">
                        <span class="material-symbols-outlined text-xl text-brand-500">shopping_bag</span>
                        {{ __('landing.hero.cta_secondary') }}
                    </a>
                </div>

                <div class="mt-12 flex flex-wrap items-center gap-6 text-sm text-zinc-500">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-brand-500">verified</span>
                        {{ __('landing.hero.trust_verified') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-brand-500">lock</span>
                        {{ __('landing.hero.trust_messaging') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-brand-500">bolt</span>
                        {{ __('landing.hero.trust_offers') }}
                    </span>
                </div>
            </div>

            <div class="hero-dashboard relative" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="hero-dashboard-inner glow-brand relative">
                    <div class="glass-card overflow-hidden rounded-2xl">
                        <div class="flex items-center gap-2 border-b border-zinc-200/80 px-4 py-3 dark:border-zinc-700/80">
                            <div class="flex gap-1.5">
                                <div class="h-3 w-3 rounded-full bg-red-400/80"></div>
                                <div class="h-3 w-3 rounded-full bg-amber-400/80"></div>
                                <div class="h-3 w-3 rounded-full bg-emerald-400/80"></div>
                            </div>
                            <div class="mx-auto flex h-6 w-48 items-center justify-center rounded-md bg-zinc-100 text-[10px] text-zinc-400 dark:bg-zinc-800">{{ __('landing.hero.dashboard_url') }}</div>
                        </div>
                        <div class="grid grid-cols-12 gap-3 p-4">
                            <div class="col-span-3 space-y-2">
                                <div class="h-8 rounded-lg bg-brand-500/20"></div>
                                <div class="h-6 rounded-lg bg-zinc-100 dark:bg-zinc-800"></div>
                                <div class="h-6 rounded-lg bg-zinc-100 dark:bg-zinc-800"></div>
                                <div class="h-6 rounded-lg bg-zinc-100 dark:bg-zinc-800"></div>
                            </div>
                            <div class="col-span-9 space-y-3">
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="rounded-xl bg-gradient-to-br from-brand-500/20 to-brand-600/10 p-3">
                                        <div class="text-[10px] text-zinc-500">{{ __('landing.hero.stat_rfqs') }}</div>
                                        <div class="text-xl font-bold text-brand-600 dark:text-brand-400">24</div>
                                    </div>
                                    <div class="rounded-xl bg-zinc-100 p-3 dark:bg-zinc-800">
                                        <div class="text-[10px] text-zinc-500">{{ __('landing.hero.stat_offers') }}</div>
                                        <div class="text-xl font-bold">156</div>
                                    </div>
                                    <div class="rounded-xl bg-zinc-100 p-3 dark:bg-zinc-800">
                                        <div class="text-[10px] text-zinc-500">{{ __('landing.hero.stat_orders') }}</div>
                                        <div class="text-xl font-bold">89</div>
                                    </div>
                                </div>
                                <div class="rounded-xl bg-zinc-50 p-3 dark:bg-zinc-800/50">
                                    <div class="mb-2 flex items-center justify-between">
                                        <span class="text-xs font-medium">{{ __('landing.hero.activity_title') }}</span>
                                        <span class="text-[10px] text-brand-500">{{ __('landing.hero.activity_live') }}</span>
                                    </div>
                                    <div class="space-y-2">
                                        @foreach (__('landing.hero.activity_items') as $item)
                                            <div class="flex items-center gap-2 rounded-lg bg-white px-2 py-1.5 dark:bg-zinc-900">
                                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                                                <span class="text-[11px] text-zinc-600 dark:text-zinc-400">{{ $item }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -left-6 top-1/4 animate-float glass-card rounded-xl px-4 py-3 shadow-xl">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/20">
                                <span class="material-symbols-outlined text-sm text-emerald-600">trending_up</span>
                            </div>
                            <div>
                                <div class="text-xs text-zinc-500">{{ __('landing.hero.float_conversion') }}</div>
                                <div class="text-sm font-bold text-emerald-600">+34%</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -right-4 bottom-1/4 animate-float-delayed glass-card rounded-xl px-4 py-3 shadow-xl">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-500/20">
                                <span class="material-symbols-outlined text-sm text-brand-600">chat</span>
                            </div>
                            <div>
                                <div class="text-xs text-zinc-500">{{ __('landing.hero.float_message') }}</div>
                                <div class="text-sm font-medium">{{ __('landing.hero.float_replied') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
