@php
    $showSidebar = $showSidebar ?? true;
    $locale = app()->getLocale();
    $isRtl = $locale === 'ar';
@endphp

@if ($showSidebar && !empty($navItems))
    <aside id="saas-sidebar" class="saas-sidebar fixed inset-y-0 start-0 z-50 flex flex-col border-e border-outline-variant/40 bg-surface px-3 py-6 lg:px-4">
        <div class="flex items-center gap-3 px-2">
            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-primary text-on-primary shadow-card">
                <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
            </div>
            <div class="saas-brand-text min-w-0 overflow-hidden transition-all">
                <h1 class="truncate text-lg font-bold text-primary">{{ __('common.app_name') }}</h1>
                <p class="truncate text-[10px] font-semibold uppercase tracking-widest text-outline">{{ __('common.portal') }}</p>
            </div>
        </div>

        <nav class="custom-scrollbar mt-8 flex-1 space-y-1 overflow-y-auto pe-1">
            @foreach ($navItems as $item)
                <a href="{{ $item['href'] }}"
                   title="{{ $item['label'] }}"
                   class="saas-nav-item relative flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition-all duration-200 active:scale-[0.98] {{ !empty($item['active']) ? 'bg-secondary-container text-on-secondary-container shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">{{ $item['icon'] }}</span>
                    <span class="saas-nav-label flex-1">{{ $item['label'] }}</span>
                    @if (!empty($item['badge']))
                        <span class="saas-nav-badge grid h-5 min-w-5 place-items-center rounded-full bg-error px-1.5 text-[10px] font-bold text-white">{{ $item['badge'] > 99 ? '99+' : $item['badge'] }}</span>
                    @endif
                </a>
            @endforeach
        </nav>

        <div class="mt-4 space-y-1 border-t border-outline-variant/20 pt-4">
            <button type="button" data-theme-toggle class="saas-nav-item flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high">
                <span class="material-symbols-outlined theme-icon-light shrink-0">light_mode</span>
                <span class="material-symbols-outlined theme-icon-dark hidden shrink-0">dark_mode</span>
                <span class="saas-sidebar-footer-text theme-label-light">{{ __('common.theme.dark') }}</span>
                <span class="saas-sidebar-footer-text theme-label-dark hidden">{{ __('common.theme.light') }}</span>
            </button>
            <a href="{{ route('profile.edit') }}" class="saas-nav-item flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high">
                <span class="material-symbols-outlined shrink-0">settings</span>
                <span class="saas-sidebar-footer-text">{{ __('nav.settings') }}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="saas-nav-item flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high">
                    <span class="material-symbols-outlined shrink-0">logout</span>
                    <span class="saas-sidebar-footer-text">{{ __('nav.logout') }}</span>
                </button>
            </form>
        </div>
    </aside>
@endif
