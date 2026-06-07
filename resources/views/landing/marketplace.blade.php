<section id="marketplace" class="relative overflow-hidden bg-zinc-50 py-24 dark:bg-zinc-900/50 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-16 lg:grid-cols-2">
            <div data-aos="fade-right">
                <span class="text-sm font-semibold uppercase tracking-widest text-brand-600 dark:text-brand-400">{{ __('landing.marketplace.label') }}</span>
                <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">
                    {{ __('landing.marketplace.title') }}
                    <span class="landing-gradient-text">{{ __('landing.marketplace.title_highlight') }}</span>
                </h2>
                <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('landing.marketplace.subtitle') }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    @foreach (__('landing.marketplace.categories') as $cat)
                        <span class="rounded-full border border-zinc-200 bg-white px-4 py-1.5 text-sm font-medium dark:border-zinc-700 dark:bg-zinc-800">{{ $cat }}</span>
                    @endforeach
                </div>
            </div>

            <div class="relative" data-aos="fade-left">
                <div class="grid grid-cols-2 gap-4">
                    @foreach (__('landing.marketplace.products') as $i => $product)
                        <div class="feature-card glass-card rounded-2xl p-5 {{ $i % 2 === 1 ? 'mt-8' : '' }}" data-aos="zoom-in" data-aos-delay="{{ $i * 80 }}">
                            <div class="mb-3 flex h-24 items-center justify-center rounded-xl bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-700">
                                <span class="material-symbols-outlined text-4xl text-zinc-400">inventory_2</span>
                            </div>
                            <span class="text-[10px] font-semibold uppercase tracking-wider text-brand-500">{{ $product['badge'] }}</span>
                            <h4 class="mt-1 font-semibold">{{ $product['name'] }}</h4>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm font-bold text-brand-600 dark:text-brand-400">{{ $product['price'] }}</span>
                                <span class="text-xs text-zinc-500">{{ $product['supplier'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
