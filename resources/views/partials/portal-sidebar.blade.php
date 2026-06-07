<aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:flex lg:w-[280px] lg:flex-col lg:border-r lg:border-outline-variant/40 lg:bg-surface lg:px-5 lg:py-8">
    <div class="flex items-center gap-3 px-3">
        <div class="grid h-10 w-10 place-items-center rounded-lg bg-primary text-on-primary">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
        </div>
        <div>
            <h1 class="text-lg font-bold text-primary">SupplyLink</h1>
            <p class="text-[10px] font-semibold uppercase tracking-widest text-outline">Logistics Portal</p>
        </div>
    </div>

    <nav class="mt-12 flex-1 space-y-2">
        @foreach ($navItems as $item)
            <a href="{{ $item['href'] }}" class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 active:scale-[0.98] {{ $item['active'] ? 'bg-secondary-container text-on-secondary-container shadow-sm' : 'text-on-surface-variant hover:translate-x-1 hover:bg-surface-container-high' }}">
                <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                <span class="flex-1">{{ $item['label'] }}</span>
                @if (!empty($item['badge']))
                    <span class="grid h-5 min-w-5 place-items-center rounded-full bg-error px-1.5 text-[10px] font-bold text-white">{{ $item['badge'] > 99 ? '99+' : $item['badge'] }}</span>
                @endif
            </a>
        @endforeach
    </nav>

    <div class="mt-auto space-y-1 border-t border-outline-variant/20 pt-6">
        @include('partials.theme-toggle-sidebar')
        <a class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high" href="{{ route('profile.edit') }}">
            <span class="material-symbols-outlined">settings</span>
            <span>Parametres</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high">
                <span class="material-symbols-outlined">logout</span>
                <span>Deconnexion</span>
            </button>
        </form>
    </div>
</aside>
