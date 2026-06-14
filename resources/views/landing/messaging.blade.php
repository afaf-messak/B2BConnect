<section id="messaging" class="relative overflow-hidden py-28 dark:bg-zinc-900/30 lg:py-36">
    <div class="section-glow absolute right-0 top-1/4 h-96 w-96 bg-blue-500/8"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-16 lg:grid-cols-2 lg:gap-20">
            <div class="order-2 lg:order-1" data-aos="fade-right">
                <div class="relative">
                    <div class="glass-card glow-brand overflow-hidden rounded-3xl">
                        <div class="border-b border-zinc-200/60 px-6 py-4 dark:border-zinc-700/60">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div class="h-11 w-11 rounded-full bg-gradient-to-br from-brand-400 to-violet-600"></div>
                                        <span class="absolute -bottom-0.5 -right-0.5 h-3.5 w-3.5 rounded-full border-2 border-white bg-emerald-500 dark:border-zinc-900"></span>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Atlas Industries</div>
                                        <div class="flex items-center gap-1 text-xs text-emerald-500">
                                            {{ __('landing.messaging.online') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" class="flex h-8 w-8 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <span class="material-symbols-outlined text-base text-zinc-500">videocam</span>
                                    </button>
                                    <button type="button" class="flex h-8 w-8 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <span class="material-symbols-outlined text-base text-zinc-500">more_vert</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 p-6">
                            <div class="max-w-[85%] rounded-2xl rounded-bl-md bg-zinc-100 px-4 py-3 text-sm leading-relaxed dark:bg-zinc-800">
                                {{ __('landing.messaging.chat_1') }}
                            </div>
                            <div class="ms-auto max-w-[85%] rounded-2xl rounded-br-md bg-gradient-to-br from-brand-500 to-brand-600 px-4 py-3 text-sm leading-relaxed text-white shadow-lg shadow-brand-500/25">
                                {{ __('landing.messaging.chat_2') }}
                            </div>
                            <div class="max-w-[85%] rounded-2xl rounded-bl-md bg-zinc-100 px-4 py-3 text-sm leading-relaxed dark:bg-zinc-800">
                                {{ __('landing.messaging.chat_3') }}
                            </div>
                            <div class="flex items-center gap-1.5 px-2">
                                <span class="typing-dot h-2 w-2 rounded-full bg-zinc-400"></span>
                                <span class="typing-dot h-2 w-2 rounded-full bg-zinc-400"></span>
                                <span class="typing-dot h-2 w-2 rounded-full bg-zinc-400"></span>
                            </div>
                        </div>

                        <div class="border-t border-zinc-200/60 px-6 py-4 dark:border-zinc-700/60">
                            <div class="flex items-center gap-3 rounded-2xl bg-zinc-100 px-4 py-3 dark:bg-zinc-800">
                                <span class="material-symbols-outlined text-zinc-400">attach_file</span>
                                <span class="flex-1 text-sm text-zinc-400">{{ __('landing.messaging.placeholder') }}</span>
                                <button type="button" class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand-500 text-white shadow-lg shadow-brand-500/30">
                                    <span class="material-symbols-outlined text-lg">send</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -left-6 top-8 animate-float-delayed glass-card rounded-2xl px-4 py-3 shadow-xl">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-500">done_all</span>
                            <span class="text-xs font-medium">{{ __('landing.messaging.float_read') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2" data-aos="fade-left">
                <span class="section-label">{{ __('landing.messaging.label') }}</span>
                <h2 class="landing-display mt-6 text-3xl font-bold sm:text-4xl lg:text-5xl">
                    {{ __('landing.messaging.title') }}
                    <span class="landing-gradient-text">{{ __('landing.messaging.title_highlight') }}</span>
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-zinc-600 dark:text-zinc-400">{{ __('landing.messaging.subtitle') }}</p>

                <ul class="mt-10 space-y-4">
                    @foreach (__('landing.messaging.items') as $item)
                        <li class="flex items-center gap-3 rounded-2xl border border-zinc-200/60 bg-white/50 px-5 py-4 dark:border-zinc-700/60 dark:bg-zinc-900/30">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand-500/10">
                                <span class="material-symbols-outlined text-brand-500">check_circle</span>
                            </span>
                            <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
