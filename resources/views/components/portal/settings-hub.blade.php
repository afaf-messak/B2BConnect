@props([
    'quickLinks' => [],
    'showPlatform' => false,
    'showCompany' => false,
])

<div class="grid gap-6 lg:grid-cols-2">
    <section class="saas-panel p-6">
        <div class="mb-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">person</span>
            <h2 class="text-lg font-bold">{{ __('portal.settings.account') }}</h2>
        </div>
        <p class="mb-4 text-sm text-on-surface-variant">{{ __('portal.settings.account_desc') }}</p>
        <dl class="mb-4 space-y-3 text-sm">
            <div class="flex justify-between border-b border-outline-variant/20 pb-2">
                <dt class="text-on-surface-variant">{{ __('admin.full_name') }}</dt>
                <dd class="font-semibold">{{ auth()->user()->name }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-on-surface-variant">Email</dt>
                <dd class="font-semibold">{{ auth()->user()->email }}</dd>
            </div>
        </dl>
        <a href="{{ route('profile.edit') }}" class="saas-btn-secondary w-full justify-center">{{ __('portal.settings.edit_profile') }}</a>
    </section>

    @if ($showCompany)
        <section class="saas-panel p-6">
            <div class="mb-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-2xl text-primary">storefront</span>
                <h2 class="text-lg font-bold">{{ __('nav.company_profile') }}</h2>
            </div>
            <p class="mb-4 text-sm text-on-surface-variant">{{ __('portal.settings.company_desc') }}</p>
            <a href="{{ route('supplier.profile') }}" class="saas-btn-secondary w-full justify-center">{{ __('portal.settings.manage_company') }}</a>
        </section>
    @endif

    <section class="saas-panel p-6">
        <div class="mb-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">palette</span>
            <h2 class="text-lg font-bold">{{ __('portal.settings.appearance') }}</h2>
        </div>
        <p class="mb-4 text-sm text-on-surface-variant">{{ __('portal.settings.appearance_desc') }}</p>
        <button type="button" data-theme-toggle class="saas-btn-secondary w-full justify-center gap-2">
            <span class="material-symbols-outlined theme-icon-light">light_mode</span>
            <span class="material-symbols-outlined theme-icon-dark hidden">dark_mode</span>
            <span class="theme-label-light">{{ __('common.theme.dark') }}</span>
            <span class="theme-label-dark hidden">{{ __('common.theme.light') }}</span>
        </button>
    </section>

    <section class="saas-panel p-6">
        <div class="mb-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">language</span>
            <h2 class="text-lg font-bold">{{ __('portal.settings.language') }}</h2>
        </div>
        <p class="mb-4 text-sm text-on-surface-variant">{{ __('portal.settings.language_desc') }}</p>
        <div class="grid gap-2">
            @foreach (['fr' => __('common.language.fr'), 'en' => __('common.language.en'), 'ar' => __('common.language.ar')] as $code => $label)
                <form method="POST" action="{{ route('locale.switch', $code) }}">
                    @csrf
                    <button type="submit" class="saas-btn-secondary w-full justify-between {{ app()->getLocale() === $code ? 'ring-2 ring-primary' : '' }}">
                        <span>{{ $label }}</span>
                        @if (app()->getLocale() === $code)
                            <span class="material-symbols-outlined text-base text-primary">check</span>
                        @endif
                    </button>
                </form>
            @endforeach
        </div>
    </section>

    @if ($showPlatform)
        <section class="saas-panel p-6">
            <div class="mb-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-2xl text-primary">admin_panel_settings</span>
                <h2 class="text-lg font-bold">{{ __('admin.platform_settings') }}</h2>
            </div>
            <dl class="space-y-4 text-sm">
                <div class="flex justify-between border-b border-outline-variant/20 pb-3">
                    <dt class="text-on-surface-variant">{{ __('admin.app_name') }}</dt>
                    <dd class="font-semibold">{{ config('app.name') }}</dd>
                </div>
                <div class="flex justify-between border-b border-outline-variant/20 pb-3">
                    <dt class="text-on-surface-variant">{{ __('admin.environment') }}</dt>
                    <dd class="font-semibold">{{ config('app.env') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-on-surface-variant">{{ __('admin.timezone') }}</dt>
                    <dd class="font-semibold">{{ config('app.timezone') }}</dd>
                </div>
            </dl>
        </section>
    @endif
</div>

@if (count($quickLinks) > 0)
    <section class="saas-panel mt-6 p-6">
        <h2 class="mb-4 text-lg font-bold">{{ __('portal.settings.shortcuts') }}</h2>
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($quickLinks as $link)
                @if (($link['type'] ?? 'link') === 'logout')
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="saas-btn-danger w-full justify-start">{{ $link['label'] }}</button>
                    </form>
                @else
                    <a href="{{ $link['href'] }}" class="saas-btn-secondary justify-start">{{ $link['label'] }}</a>
                @endif
            @endforeach
        </div>
    </section>
@endif
