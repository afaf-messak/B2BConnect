<div class="relative" x-data="{ langOpen: false }">
    <button
        type="button"
        @click="langOpen = !langOpen"
        class="flex h-9 items-center gap-1.5 rounded-lg border border-zinc-200 px-2.5 text-sm font-medium text-zinc-600 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-800"
        aria-label="{{ __('common.language.label') }}"
        aria-expanded="false"
        :aria-expanded="langOpen"
    >
        <span class="material-symbols-outlined text-lg">language</span>
        <span>{{ strtoupper(app()->getLocale()) }}</span>
        <span class="material-symbols-outlined text-base transition-transform" :class="langOpen && 'rotate-180'">expand_more</span>
    </button>

    <div
        x-show="langOpen"
        x-transition
        @click.outside="langOpen = false"
        x-cloak
        class="absolute end-0 top-full z-50 mt-2 min-w-[10rem] overflow-hidden rounded-xl border border-zinc-200 bg-white py-1 shadow-xl dark:border-zinc-700 dark:bg-zinc-900"
    >
        @foreach (['fr' => __('common.language.fr'), 'en' => __('common.language.en'), 'ar' => __('common.language.ar')] as $code => $label)
            <a
                href="{{ route('locale.switch', $code) }}"
                @click="langOpen = false"
                class="flex w-full items-center justify-between px-4 py-2.5 text-start text-sm transition hover:bg-zinc-100 dark:hover:bg-zinc-800 {{ app()->getLocale() === $code ? 'font-semibold text-brand-600 dark:text-brand-400' : 'text-zinc-700 dark:text-zinc-300' }}"
            >
                {{ $label }}
                @if (app()->getLocale() === $code)
                    <span class="material-symbols-outlined text-base">check</span>
                @endif
            </a>
        @endforeach
    </div>
</div>
