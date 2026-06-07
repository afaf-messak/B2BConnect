<section id="benefits" class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-16 lg:grid-cols-2">
            <div data-aos="fade-right">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-blue-500/10 px-3 py-1 text-sm font-medium text-blue-600 dark:text-blue-400">
                    <span class="material-symbols-outlined text-base">shopping_cart</span>
                    {{ __('landing.benefits.clients_badge') }}
                </div>
                <h3 class="text-2xl font-bold sm:text-3xl">{{ __('landing.benefits.clients_title') }}</h3>
                <ul class="mt-8 space-y-4">
                    @foreach (__('landing.benefits.clients_items') as $item)
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/10">
                                <span class="material-symbols-outlined text-sm text-blue-600 dark:text-blue-400">check</span>
                            </span>
                            <span class="text-zinc-600 dark:text-zinc-400">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" class="btn-primary mt-8 inline-flex items-center gap-2 rounded-xl px-6 py-3 text-sm font-semibold text-white">
                    {{ __('landing.benefits.clients_cta') }}
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>

            <div data-aos="fade-left">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-500/10 px-3 py-1 text-sm font-medium text-violet-600 dark:text-violet-400">
                    <span class="material-symbols-outlined text-base">storefront</span>
                    {{ __('landing.benefits.suppliers_badge') }}
                </div>
                <h3 class="text-2xl font-bold sm:text-3xl">{{ __('landing.benefits.suppliers_title') }}</h3>
                <ul class="mt-8 space-y-4">
                    @foreach (__('landing.benefits.suppliers_items') as $item)
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-violet-500/10">
                                <span class="material-symbols-outlined text-sm text-violet-600 dark:text-violet-400">check</span>
                            </span>
                            <span class="text-zinc-600 dark:text-zinc-400">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" class="mt-8 inline-flex items-center gap-2 rounded-xl border border-violet-200 px-6 py-3 text-sm font-semibold text-violet-700 transition hover:bg-violet-50 dark:border-violet-800 dark:text-violet-300 dark:hover:bg-violet-500/10">
                    {{ __('landing.benefits.suppliers_cta') }}
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>
