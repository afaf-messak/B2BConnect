<footer class="relative overflow-hidden border-t border-zinc-200 bg-zinc-950 text-zinc-300 dark:border-zinc-800">
    <div class="absolute inset-0 grid-pattern opacity-10"></div>
    <div class="section-glow absolute bottom-0 left-1/2 h-64 w-[50rem] -translate-x-1/2 bg-brand-600/10"></div>

    <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <x-b2b-logo size="sm" :showTagline="true" href="/" />
                <p class="mt-5 max-w-sm text-sm leading-relaxed text-zinc-400">{{ __('landing.footer.tagline') }}</p>
                <div class="mt-8 flex gap-3">
                    @foreach (['linkedin', 'twitter', 'mail'] as $social)
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-xl border border-zinc-800 bg-zinc-900 text-zinc-400 transition hover:border-brand-500/50 hover:text-brand-400">
                            <span class="material-symbols-outlined text-lg">{{ $social === 'twitter' ? 'tag' : ($social === 'linkedin' ? 'work' : 'mail') }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="mb-5 text-xs font-bold uppercase tracking-[0.15em] text-zinc-500">{{ __('landing.footer.product') }}</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#features" class="transition hover:text-brand-400">{{ __('landing.nav.features') }}</a></li>
                    <li><a href="#marketplace" class="transition hover:text-brand-400">{{ __('landing.nav.marketplace') }}</a></li>
                    <li><a href="#messaging" class="transition hover:text-brand-400">{{ __('landing.messaging.label') }}</a></li>
                    <li><a href="#how-it-works" class="transition hover:text-brand-400">{{ __('landing.nav.how_it_works') }}</a></li>
                    <li><a href="{{ route('products.catalog') }}" class="transition hover:text-brand-400">{{ __('landing.footer.catalog') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-5 text-xs font-bold uppercase tracking-[0.15em] text-zinc-500">{{ __('landing.footer.company') }}</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.about') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.careers') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.blog') }}</a></li>
                    <li><a href="#faq" class="transition hover:text-brand-400">{{ __('landing.nav.faq') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-5 text-xs font-bold uppercase tracking-[0.15em] text-zinc-500">{{ __('landing.footer.legal') }}</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.privacy') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.terms') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.cookies') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-16 flex flex-col items-center justify-between gap-4 border-t border-zinc-800 pt-8 sm:flex-row">
            <p class="text-sm text-zinc-500">&copy; {{ date('Y') }} B2BConnect. {{ __('landing.footer.rights') }}</p>
            <div class="flex items-center gap-3">
                @include('landing.lang-switcher')
                <button type="button" data-theme-toggle class="flex items-center gap-2 rounded-xl border border-zinc-800 bg-zinc-900 px-3 py-1.5 text-sm text-zinc-400 transition hover:border-zinc-700 hover:text-zinc-200">
                    <span class="material-symbols-outlined text-base theme-icon-light">dark_mode</span>
                    <span class="material-symbols-outlined hidden text-base theme-icon-dark">light_mode</span>
                    <span class="theme-label-light">{{ __('landing.footer.dark_mode') }}</span>
                    <span class="theme-label-dark hidden">{{ __('landing.footer.light_mode') }}</span>
                </button>
            </div>
        </div>
    </div>
</footer>
