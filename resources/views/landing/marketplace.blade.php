<section id="marketplace" class="relative overflow-hidden bg-zinc-50 py-28 dark:bg-zinc-900/40 lg:py-36">
    <div class="absolute inset-0 grid-pattern opacity-50"></div>
    <div class="section-glow absolute -left-20 bottom-0 h-72 w-72 bg-brand-500/10"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-16 lg:grid-cols-2 lg:gap-20">
            <div data-aos="fade-right">
                <span class="section-label">{{ __('landing.marketplace.label') }}</span>
                <h2 class="landing-display mt-6 text-3xl font-bold sm:text-4xl lg:text-5xl">
                    {{ __('landing.marketplace.title') }}
                    <span class="landing-gradient-text">{{ __('landing.marketplace.title_highlight') }}</span>
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-zinc-600 dark:text-zinc-400">{{ __('landing.marketplace.subtitle') }}</p>

                <div class="mt-8 flex flex-wrap gap-2">
                    @foreach (__('landing.marketplace.categories') as $cat)
                        <span class="rounded-full border border-zinc-200/80 bg-white px-4 py-2 text-sm font-medium transition hover:border-brand-300 hover:bg-brand-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:border-brand-700 dark:hover:bg-brand-500/10">
                            {{ $cat }}
                        </span>
                    @endforeach
                </div>

                <a href="{{ route('products.catalog') }}" class="btn-primary mt-10 inline-flex items-center gap-2 rounded-2xl px-7 py-3.5 text-sm font-semibold text-white">
                    {{ __('landing.marketplace.cta') }}
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>

            <div class="relative" data-aos="fade-left">
                @php
                    $productImages = [
                        'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Metal_tubes_stored_in_a_yard.jpg/330px-Metal_tubes_stored_in_a_yard.jpg',
                        'https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Diverse_Kanisterformen.png/250px-Diverse_Kanisterformen.png',
                        'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Sharp_GP2Y0A21YK_IR_proximity_sensor_cropped.jpg/250px-Sharp_GP2Y0A21YK_IR_proximity_sensor_cropped.jpg',
                        asset('images/landing/products/pallet-film.jpg'),
                    ];
                @endphp

                <div class="grid grid-cols-2 gap-4">
                    @foreach (__('landing.marketplace.products') as $i => $product)
                        <div class="product-shine premium-card glass-card rounded-2xl p-5 {{ $i % 2 === 1 ? 'mt-10' : '' }}" data-aos="zoom-in" data-aos-delay="{{ $i * 90 }}">
                            <div class="relative mb-4 h-28 overflow-hidden rounded-xl bg-gradient-to-br from-zinc-100 via-zinc-50 to-brand-50 dark:from-zinc-800 dark:via-zinc-800 dark:to-brand-900/30">
                                <div class="absolute inset-0 bg-gradient-to-t from-brand-500/5 to-transparent"></div>
                                <img
                                    src="{{ $productImages[$i] ?? $productImages[0] }}"
                                    alt="{{ $product['name'] }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >
                                <span class="absolute left-2 top-2 rounded-full bg-brand-500/10 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-brand-600 dark:text-brand-400">
                                    {{ $product['badge'] }}
                                </span>
                            </div>
                            <h4 class="font-semibold leading-snug">{{ $product['name'] }}</h4>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-sm font-bold text-brand-600 dark:text-brand-400">{{ $product['price'] }}</span>
                                <span class="text-xs text-zinc-500">{{ $product['supplier'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="absolute -right-4 top-1/2 animate-float glass-card rounded-2xl px-4 py-3 shadow-xl">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-brand-500">filter_alt</span>
                        <span class="text-xs font-medium">{{ __('landing.marketplace.float_filter') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
