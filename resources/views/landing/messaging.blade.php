<section id="messaging" class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-16 lg:grid-cols-2">
            <div class="order-2 lg:order-1" data-aos="fade-right">
                <div class="glass-card glow-brand overflow-hidden rounded-2xl">
                    <div class="border-b border-zinc-200/80 px-5 py-4 dark:border-zinc-700/80">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-brand-400 to-brand-600"></div>
                            <div>
                                <div class="font-semibold">Atlas Industries</div>
                                <div class="flex items-center gap-1 text-xs text-emerald-500">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    {{ __('landing.messaging.online') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 p-5">
                        <div class="max-w-[80%] rounded-2xl rounded-bl-md bg-zinc-100 px-4 py-3 text-sm dark:bg-zinc-800">{{ __('landing.messaging.chat_1') }}</div>
                        <div class="ms-auto max-w-[80%] rounded-2xl rounded-br-md bg-brand-500 px-4 py-3 text-sm text-white">{{ __('landing.messaging.chat_2') }}</div>
                        <div class="max-w-[80%] rounded-2xl rounded-bl-md bg-zinc-100 px-4 py-3 text-sm dark:bg-zinc-800">{{ __('landing.messaging.chat_3') }}</div>
                    </div>
                    <div class="border-t border-zinc-200/80 px-5 py-3 dark:border-zinc-700/80">
                        <div class="flex items-center gap-2 rounded-xl bg-zinc-100 px-4 py-2.5 dark:bg-zinc-800">
                            <span class="text-sm text-zinc-400">{{ __('landing.messaging.placeholder') }}</span>
                            <span class="material-symbols-outlined ms-auto text-brand-500">send</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2" data-aos="fade-left">
                <span class="text-sm font-semibold uppercase tracking-widest text-brand-600 dark:text-brand-400">{{ __('landing.messaging.label') }}</span>
                <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">
                    {{ __('landing.messaging.title') }}
                    <span class="landing-gradient-text">{{ __('landing.messaging.title_highlight') }}</span>
                </h2>
                <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">{{ __('landing.messaging.subtitle') }}</p>
                <ul class="mt-8 space-y-4">
                    @foreach (__('landing.messaging.items') as $item)
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-brand-500">check_circle</span>
                            <span class="text-zinc-600 dark:text-zinc-400">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
