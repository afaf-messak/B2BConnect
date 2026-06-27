<section id="hero" class="landing-aurora relative flex min-h-screen flex-col overflow-hidden">
    <canvas id="hero-particles" class="pointer-events-none absolute inset-0 h-full w-full opacity-60" aria-hidden="true"></canvas>
    <div class="grid-pattern pointer-events-none absolute inset-0" aria-hidden="true"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="shape-blob absolute -left-24 top-1/4 h-[28rem] w-[28rem] bg-brand-500/15 blur-3xl"
             :style="`transform: translate(${parallax.x * 0.03}px, ${parallax.y * 0.03}px)`"></div>
        <div class="shape-blob absolute -right-32 top-1/3 h-96 w-96 bg-violet-500/12 blur-3xl [animation-delay:3s]"
             :style="`transform: translate(${parallax.x * -0.025}px, ${parallax.y * -0.025}px)`"></div>
        <div class="absolute bottom-0 left-1/2 h-px w-3/4 -translate-x-1/2 bg-gradient-to-r from-transparent via-brand-500/30 to-transparent"></div>
        <div class="particle left-[8%] top-[18%] h-2 w-2 bg-brand-400/50"></div>
        <div class="particle left-[92%] top-[22%] h-3 w-3 bg-violet-400/40 [animation-delay:1.5s]"></div>
        <div class="particle left-[75%] top-[65%] h-2 w-2 bg-cyan-400/45 [animation-delay:2.5s]"></div>
        <div class="particle left-[15%] top-[72%] h-4 w-4 bg-brand-300/30 [animation-delay:0.8s]"></div>
    </div>

    <div class="relative mx-auto flex flex-1 max-w-7xl items-center px-4 pb-16 pt-32 sm:px-6 lg:px-8 lg:pb-24 lg:pt-40">
        <div class="grid w-full items-center gap-16 lg:grid-cols-2 lg:gap-20">
            {{-- Copy --}}
            <div data-aos="fade-up" data-aos-duration="900">
                <div class="section-label mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-brand-500"></span>
                    </span>
                    {{ __('landing.hero.badge', ['count' => $heroDashboard['suppliers']]) }}
                </div>

                <h1 class="landing-display text-4xl font-bold sm:text-5xl lg:text-6xl xl:text-[4.25rem]">
                    {{ __('landing.hero.title') }}
                    <span class="landing-gradient-text mt-2 block">{{ __('landing.hero.title_highlight') }}</span>
                </h1>

                <p class="mt-7 max-w-xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-400 sm:text-xl">
                    {{ __('landing.hero.subtitle') }}
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <a href="{{ route('marketplace.suppliers.index') }}"
                       class="btn-primary group inline-flex items-center gap-2.5 rounded-2xl px-8 py-4 text-base font-semibold text-white">
                        <span class="material-symbols-outlined text-xl">search</span>
                        {{ __('landing.hero.cta_primary') }}
                        <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1">arrow_forward</span>
                    </a>
                    <a href="{{ route('register') }}"
                       class="btn-outline group inline-flex items-center gap-2.5 rounded-2xl px-8 py-4 text-base font-semibold text-zinc-800 dark:text-zinc-100">
                        <span class="material-symbols-outlined text-xl text-brand-500">storefront</span>
                        {{ __('landing.hero.cta_secondary') }}
                    </a>
                </div>

                <div class="mt-12 flex flex-wrap gap-3">
                    @foreach ([
                        ['icon' => 'verified', 'text' => __('landing.hero.trust_verified')],
                        ['icon' => 'forum', 'text' => __('landing.hero.trust_messaging')],
                        ['icon' => 'bolt', 'text' => __('landing.hero.trust_offers')],
                    ] as $trust)
                        <span class="glass inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm text-zinc-600 dark:text-zinc-400">
                            <span class="material-symbols-outlined text-base text-brand-500">{{ $trust['icon'] }}</span>
                            {{ $trust['text'] }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- Illustration --}}
            <div class="hero-dashboard relative" data-aos="fade-left" data-aos-duration="1100" data-aos-delay="150">
                <div class="hero-dashboard-inner glow-brand relative">
                    {{-- Main dashboard mockup --}}
                    <div class="glass-card overflow-hidden rounded-3xl dark:ring-1 dark:ring-brand-400/25">
                        <div class="flex items-center gap-2 border-b border-zinc-200/60 px-5 py-3.5 dark:border-zinc-700/60">
                            <div class="flex gap-1.5">
                                <div class="h-3 w-3 rounded-full bg-red-400/90"></div>
                                <div class="h-3 w-3 rounded-full bg-amber-400/90"></div>
                                <div class="h-3 w-3 rounded-full bg-emerald-400/90"></div>
                            </div>
                            <div class="mx-auto flex h-7 w-52 items-center justify-center rounded-lg bg-zinc-100/80 text-[10px] text-zinc-400 dark:bg-zinc-800/80">
                                {{ __('landing.hero.dashboard_url') }}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 p-5">
                            {{-- Sidebar --}}
                            <div class="col-span-3 space-y-2">
                                <div class="flex h-9 items-center gap-2 rounded-xl bg-brand-500/15 px-2">
                                    <div class="h-5 w-5 rounded-md bg-brand-500/30"></div>
                                    <div class="h-2 flex-1 rounded bg-brand-500/20"></div>
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="flex h-7 items-center gap-2 rounded-lg px-2">
                                        <div class="h-4 w-4 rounded bg-zinc-200 dark:bg-zinc-700"></div>
                                        <div class="h-2 flex-1 rounded bg-zinc-100 dark:bg-zinc-800"></div>
                                    </div>
                                @endfor
                            </div>

                            {{-- Main content --}}
                            <div class="col-span-9 space-y-4">
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="rounded-2xl bg-gradient-to-br from-brand-500/25 to-brand-600/10 p-4 ring-1 ring-brand-500/20 dark:from-brand-400/30 dark:to-brand-600/20 dark:ring-brand-400/30">
                                        <div class="text-[10px] font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">{{ __('landing.hero.stat_rfqs') }}</div>
                                        <div class="mt-1 text-2xl font-bold text-brand-600 dark:text-brand-300">{{ $heroDashboard['rfqs'] }}</div>
                                        <div class="mt-2 h-1 overflow-hidden rounded-full bg-brand-500/20 dark:bg-brand-300/20">
                                            <div class="h-full rounded-full bg-brand-500 dark:bg-brand-300" style="width: {{ max($heroDashboard['rfq_progress'], 8) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="rounded-2xl bg-zinc-50 p-4 dark:bg-zinc-800/80 dark:ring-1 dark:ring-zinc-600/40">
                                        <div class="text-[10px] font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">{{ __('landing.hero.stat_offers') }}</div>
                                        <div class="mt-1 text-2xl font-bold dark:text-white">{{ $heroDashboard['offers'] }}</div>
                                    </div>
                                    <div class="rounded-2xl bg-zinc-50 p-4 dark:bg-zinc-800/80 dark:ring-1 dark:ring-zinc-600/40">
                                        <div class="text-[10px] font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">{{ __('landing.hero.stat_orders') }}</div>
                                        <div class="mt-1 text-2xl font-bold dark:text-white">{{ $heroDashboard['orders'] }}</div>
                                    </div>
                                </div>

                                {{-- Activity feed --}}
                                <div class="rounded-2xl bg-zinc-50/80 p-4 dark:bg-zinc-800/70 dark:ring-1 dark:ring-zinc-600/30">
                                    <div class="mb-3 flex items-center justify-between">
                                        <span class="text-xs font-semibold dark:text-zinc-100">{{ __('landing.hero.activity_title') }}</span>
                                        <span class="flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-2 py-0.5 text-[10px] font-medium text-emerald-600 dark:bg-emerald-400/15 dark:text-emerald-300">
                                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                            {{ __('landing.hero.activity_live') }}
                                        </span>
                                    </div>
                                    <div class="space-y-2">
                                        @foreach ($heroDashboard['activity'] as $item)
                                            <div class="flex items-center gap-2.5 rounded-xl bg-white px-3 py-2 dark:bg-zinc-900/70 dark:ring-1 dark:ring-zinc-700/40">
                                                <div class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-emerald-400"></div>
                                                <span class="text-[11px] text-zinc-600 dark:text-zinc-300">{{ $item }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Mini product row --}}
                                @if (! empty($heroDashboard['products']))
                                <div class="flex gap-2">
                                    @foreach ($heroDashboard['products'] as $product)
                                        <div class="flex-1 rounded-xl bg-white p-2.5 dark:bg-zinc-900/70 dark:ring-1 dark:ring-zinc-700/40">
                                            <div class="mb-2 flex h-10 items-center justify-center rounded-lg bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-700 dark:to-zinc-800">
                                                <span class="material-symbols-outlined text-lg text-zinc-400 dark:text-zinc-300">inventory_2</span>
                                            </div>
                                            <div class="truncate text-[10px] font-medium dark:text-zinc-200">{{ $product['name'] }}</div>
                                            <div class="text-[10px] font-bold text-brand-600 dark:text-brand-300">{{ $product['price'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Floating cards --}}
                    <div class="absolute -left-8 top-[18%] animate-float glass-card rounded-2xl px-5 py-4 shadow-2xl dark:ring-1 dark:ring-brand-400/20">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/15 dark:bg-emerald-400/20">
                                <span class="material-symbols-outlined text-lg text-emerald-600 dark:text-emerald-300">trending_up</span>
                            </div>
                            <div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-300">{{ __('landing.hero.float_conversion') }}</div>
                                <div class="text-lg font-bold text-emerald-600 dark:text-emerald-300">{{ $heroDashboard['conversion'] }}%</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -right-6 bottom-[22%] animate-float-delayed glass-card rounded-2xl px-5 py-4 shadow-2xl dark:ring-1 dark:ring-brand-400/20">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500/15 dark:bg-brand-400/20">
                                <span class="material-symbols-outlined text-lg text-brand-600 dark:text-brand-300">chat</span>
                            </div>
                            <div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-300">{{ __('landing.hero.float_message') }}</div>
                                <div class="text-sm font-semibold dark:text-white">{{ __('landing.hero.float_replied') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-4 left-1/4 animate-float glass-card rounded-2xl px-4 py-3 shadow-xl [animation-delay:1s] dark:ring-1 dark:ring-violet-400/20">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base text-violet-500 dark:text-violet-300">handshake</span>
                            <span class="text-xs font-medium dark:text-zinc-100">{{ __('landing.hero.float_deal') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
