<header class="saas-navbar sticky top-0 z-40 flex h-16 items-center gap-3 border-b border-outline-variant/20 bg-surface/90 px-4 backdrop-blur-md sm:px-6 lg:px-8">
    @if ($showSidebar ?? true)
        <button type="button" id="saas-sidebar-toggle" class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-surface-container-low text-on-surface transition hover:bg-surface-container-high" aria-label="{{ __('common.sidebar.collapse') }}">
            <span id="saas-sidebar-toggle-icon" class="material-symbols-outlined">chevron_left</span>
        </button>
    @endif

    <div class="min-w-0 flex-1">
        @hasSection('page-header')
            @yield('page-header')
        @elseif (!empty($pageTitle))
            <h2 class="truncate text-lg font-bold text-on-surface sm:text-xl">{{ $pageTitle }}</h2>
            @if (!empty($pageSubtitle))
                <p class="truncate text-sm text-on-surface-variant">{{ $pageSubtitle }}</p>
            @endif
        @endif
    </div>

    <div class="flex shrink-0 items-center gap-1 sm:gap-2">
        <div class="saas-header-actions">
            @yield('header-actions')
        </div>

        {{-- Language switcher --}}
        <div class="relative" data-dropdown>
            <button type="button" data-dropdown-trigger class="flex h-10 items-center gap-1.5 rounded-xl px-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high" aria-label="{{ __('common.language.label') }}">
                <span class="material-symbols-outlined text-xl">language</span>
                <span class="hidden sm:inline">{{ strtoupper(app()->getLocale()) }}</span>
                <span class="material-symbols-outlined text-base">expand_more</span>
            </button>
            <div class="saas-dropdown" data-dropdown-menu>
                @foreach (['fr' => __('common.language.fr'), 'en' => __('common.language.en'), 'ar' => __('common.language.ar')] as $code => $label)
                    <form method="POST" action="{{ route('locale.switch', $code) }}">
                        @csrf
                        <button type="submit" class="saas-dropdown-item {{ app()->getLocale() === $code ? 'active' : '' }}">
                            {{ $label }}
                        </button>
                    </form>
                @endforeach
            </div>
        </div>

        @include('partials.theme-toggle')

        @auth
            <a href="{{ route('profile.edit') }}" class="ms-1 flex h-10 w-10 items-center justify-center rounded-full bg-primary text-sm font-bold text-on-primary ring-2 ring-surface transition hover:opacity-90" title="{{ auth()->user()->name }}">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </a>
        @endauth
    </div>
</header>
