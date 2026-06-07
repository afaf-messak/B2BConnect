<footer class="border-t border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-700">
                        <span class="material-symbols-outlined text-lg text-white">hub</span>
                    </div>
                    <span class="text-lg font-semibold">B2BConnect</span>
                </a>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">{{ __('landing.footer.tagline') }}</p>
            </div>

            <div>
                <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-zinc-900 dark:text-zinc-100">{{ __('landing.footer.product') }}</h4>
                <ul class="space-y-3 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="#features" class="transition hover:text-brand-600">{{ __('landing.nav.features') }}</a></li>
                    <li><a href="#marketplace" class="transition hover:text-brand-600">{{ __('landing.nav.marketplace') }}</a></li>
                    <li><a href="#messaging" class="transition hover:text-brand-600">{{ __('landing.messaging.label') }}</a></li>
                    <li><a href="#how-it-works" class="transition hover:text-brand-600">{{ __('landing.nav.how_it_works') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-zinc-900 dark:text-zinc-100">{{ __('landing.footer.company') }}</h4>
                <ul class="space-y-3 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="#" class="transition hover:text-brand-600">{{ __('landing.footer.about') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-600">{{ __('landing.footer.careers') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-600">{{ __('landing.footer.blog') }}</a></li>
                    <li><a href="#faq" class="transition hover:text-brand-600">{{ __('landing.nav.faq') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-zinc-900 dark:text-zinc-100">{{ __('landing.footer.legal') }}</h4>
                <ul class="space-y-3 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="#" class="transition hover:text-brand-600">{{ __('landing.footer.privacy') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-600">{{ __('landing.footer.terms') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-600">{{ __('landing.footer.cookies') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-zinc-200 pt-8 sm:flex-row dark:border-zinc-800">
            <p class="text-sm text-zinc-500">&copy; {{ date('Y') }} B2BConnect. {{ __('landing.footer.rights') }}</p>
            <div class="flex items-center gap-3">
                @include('landing.lang-switcher')
                <button type="button" data-theme-toggle class="flex items-center gap-2 rounded-lg border border-zinc-200 px-3 py-1.5 text-sm text-zinc-600 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-800">
                    <span class="material-symbols-outlined text-base theme-icon-light">dark_mode</span>
                    <span class="material-symbols-outlined hidden text-base theme-icon-dark">light_mode</span>
                    <span class="theme-label-light">{{ __('landing.footer.dark_mode') }}</span>
                    <span class="theme-label-dark hidden">{{ __('landing.footer.light_mode') }}</span>
                </button>
            </div>
        </div>
    </div>
</footer>
