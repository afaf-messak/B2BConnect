<nav
    id="landing-nav"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-500"
    :class="scrolled ? 'nav-scrolled py-3' : 'py-5'"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="/" class="group flex items-center gap-2.5">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 shadow-lg shadow-brand-500/30 transition-transform group-hover:scale-105">
                <span class="material-symbols-outlined text-lg text-white">hub</span>
            </div>
            <span class="text-lg font-semibold tracking-tight">B2BConnect</span>
        </a>

        <div class="hidden items-center gap-8 md:flex">
            <a href="#features" class="text-sm font-medium text-zinc-600 transition hover:text-brand-600 dark:text-zinc-400 dark:hover:text-brand-400">{{ __('landing.nav.features') }}</a>
            <a href="#how-it-works" class="text-sm font-medium text-zinc-600 transition hover:text-brand-600 dark:text-zinc-400 dark:hover:text-brand-400">{{ __('landing.nav.how_it_works') }}</a>
            <a href="#marketplace" class="text-sm font-medium text-zinc-600 transition hover:text-brand-600 dark:text-zinc-400 dark:hover:text-brand-400">{{ __('landing.nav.marketplace') }}</a>
            <a href="#faq" class="text-sm font-medium text-zinc-600 transition hover:text-brand-600 dark:text-zinc-400 dark:hover:text-brand-400">{{ __('landing.nav.faq') }}</a>
        </div>

        <div class="hidden items-center gap-3 md:flex">
            @include('landing.lang-switcher')
            <button type="button" data-theme-toggle class="flex h-9 w-9 items-center justify-center rounded-lg border border-zinc-200 text-zinc-600 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-800">
                <span class="material-symbols-outlined text-xl theme-icon-light">dark_mode</span>
                <span class="material-symbols-outlined hidden text-xl theme-icon-dark">light_mode</span>
            </button>
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-zinc-700 transition hover:text-brand-600 dark:text-zinc-300">{{ __('landing.nav.login') }}</a>
            <a href="{{ route('register') }}" class="btn-primary rounded-xl px-5 py-2.5 text-sm font-semibold text-white">{{ __('landing.nav.get_started') }}</a>
        </div>

        <div class="flex items-center gap-2 md:hidden">
            @include('landing.lang-switcher')
            <button type="button" class="flex h-10 w-10 items-center justify-center rounded-lg border border-zinc-200 dark:border-zinc-700" @click="mobileOpen = !mobileOpen" aria-label="{{ __('landing.nav.menu') }}">
                <span class="material-symbols-outlined" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
            </button>
        </div>
    </div>

    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-cloak
        class="glass mx-4 mt-2 rounded-2xl border border-zinc-200/80 p-4 md:hidden dark:border-zinc-700/80"
    >
        <div class="flex flex-col gap-1">
            <a href="#features" @click="mobileOpen = false" class="rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-zinc-100 dark:hover:bg-zinc-800">{{ __('landing.nav.features') }}</a>
            <a href="#how-it-works" @click="mobileOpen = false" class="rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-zinc-100 dark:hover:bg-zinc-800">{{ __('landing.nav.how_it_works') }}</a>
            <a href="#marketplace" @click="mobileOpen = false" class="rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-zinc-100 dark:hover:bg-zinc-800">{{ __('landing.nav.marketplace') }}</a>
            <a href="#faq" @click="mobileOpen = false" class="rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-zinc-100 dark:hover:bg-zinc-800">{{ __('landing.nav.faq') }}</a>
            <hr class="my-2 border-zinc-200 dark:border-zinc-700">
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium">{{ __('landing.nav.login') }}</a>
            <a href="{{ route('register') }}" class="btn-primary mt-1 rounded-xl px-3 py-2.5 text-center text-sm font-semibold text-white">{{ __('landing.nav.get_started') }}</a>
        </div>
    </div>
</nav>
