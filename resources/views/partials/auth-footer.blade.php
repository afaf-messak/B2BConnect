<footer class="relative overflow-hidden border-t border-zinc-200 bg-zinc-950 text-zinc-300 dark:border-zinc-800">
    <div class="absolute inset-0 grid-pattern opacity-10"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-4">
            <div class="md:col-span-2">
                <x-b2b-logo size="sm" :showTagline="true" href="/" />
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-zinc-400">{{ __('landing.footer.tagline') }}</p>
            </div>
            <div>
                <h4 class="mb-4 text-xs font-bold uppercase tracking-[0.15em] text-zinc-500">{{ __('landing.footer.product') }}</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/#features" class="transition hover:text-brand-400">{{ __('landing.nav.features') }}</a></li>
                    <li><a href="/#marketplace" class="transition hover:text-brand-400">{{ __('landing.nav.marketplace') }}</a></li>
                    <li><a href="{{ route('products.catalog') }}" class="transition hover:text-brand-400">{{ __('landing.footer.catalog') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class="mb-4 text-xs font-bold uppercase tracking-[0.15em] text-zinc-500">{{ __('landing.footer.legal') }}</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.privacy') }}</a></li>
                    <li><a href="#" class="transition hover:text-brand-400">{{ __('landing.footer.terms') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-zinc-800 pt-8 sm:flex-row">
            <p class="text-sm text-zinc-500">&copy; {{ date('Y') }} {{ __('common.app_name') }}. {{ __('landing.footer.rights') }}</p>
        </div>
    </div>
</footer>
