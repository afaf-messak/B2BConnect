<section id="why-choose" class="relative overflow-hidden py-28 dark:bg-zinc-900/35 lg:py-36">
    <div class="section-glow absolute -left-32 top-1/4 h-96 w-96 bg-brand-500/10"></div>
    <div class="section-glow absolute -right-32 bottom-1/4 h-80 w-80 bg-violet-500/10"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">
            <span class="section-label">{{ __('landing.why_choose.label') }}</span>
            <h2 class="landing-display mt-6 text-3xl font-bold sm:text-4xl lg:text-5xl">
                {{ __('landing.why_choose.title') }}
                <span class="landing-gradient-text">{{ __('landing.why_choose.title_highlight') }}</span>
            </h2>
            <p class="mt-5 text-lg leading-relaxed text-zinc-600 dark:text-zinc-400">
                {{ __('landing.why_choose.subtitle') }}
            </p>
        </div>

        <div class="mt-20 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (__('landing.why_choose.items') as $i => $item)
                <div class="premium-card gradient-border group" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="gradient-border-inner p-8">
                        <div class="feature-icon mb-6 flex h-14 w-14 items-center justify-center rounded-2xl {{ $item['iconClass'] }}">
                            <span class="material-symbols-outlined text-2xl">{{ $item['icon'] }}</span>
                        </div>
                        <h3 class="text-xl font-semibold tracking-tight">{{ $item['title'] }}</h3>
                        <p class="mt-3 leading-relaxed text-zinc-600 dark:text-zinc-400">{{ $item['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 grid gap-6 lg:grid-cols-2" data-aos="fade-up" data-aos-delay="200">
            <div class="premium-card glass-card rounded-3xl p-8 lg:p-10">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-blue-500/10 px-3 py-1 text-sm font-semibold text-blue-600 dark:text-blue-400">
                    <span class="material-symbols-outlined text-base">shopping_cart</span>
                    {{ __('landing.benefits.clients_badge') }}
                </div>
                <h3 class="text-2xl font-bold">{{ __('landing.benefits.clients_title') }}</h3>
                <ul class="mt-6 space-y-3">
                    @foreach (__('landing.benefits.clients_items') as $item)
                        <li class="flex items-start gap-3 text-zinc-600 dark:text-zinc-400">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-blue-500/15">
                                <span class="material-symbols-outlined text-xs text-blue-600">check</span>
                            </span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('marketplace.suppliers.index') }}" class="btn-primary mt-8 inline-flex items-center gap-2 rounded-xl px-6 py-3 text-sm font-semibold text-white">
                    {{ __('landing.benefits.clients_cta') }}
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>

            <div class="premium-card glass-card rounded-3xl p-8 lg:p-10">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-500/10 px-3 py-1 text-sm font-semibold text-violet-600 dark:text-violet-400">
                    <span class="material-symbols-outlined text-base">storefront</span>
                    {{ __('landing.benefits.suppliers_badge') }}
                </div>
                <h3 class="text-2xl font-bold">{{ __('landing.benefits.suppliers_title') }}</h3>
                <ul class="mt-6 space-y-3">
                    @foreach (__('landing.benefits.suppliers_items') as $item)
                        <li class="flex items-start gap-3 text-zinc-600 dark:text-zinc-400">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-violet-500/15">
                                <span class="material-symbols-outlined text-xs text-violet-600">check</span>
                            </span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" class="btn-outline mt-8 inline-flex items-center gap-2 rounded-xl px-6 py-3 text-sm font-semibold">
                    {{ __('landing.benefits.suppliers_cta') }}
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>
