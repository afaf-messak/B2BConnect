<section id="trusted" class="border-y border-zinc-200/80 bg-white py-16 dark:border-zinc-800 dark:bg-zinc-950">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="mb-10 text-center text-sm font-medium uppercase tracking-widest text-zinc-500" data-aos="fade-up">
            {{ __('landing.trusted.title') }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-x-12 gap-y-8 opacity-60 grayscale transition hover:opacity-80 hover:grayscale-0" data-aos="fade-up" data-aos-delay="100">
            @foreach (__('landing.trusted.brands') as $brand)
                <div class="flex items-center gap-2 text-lg font-semibold tracking-tight text-zinc-700 dark:text-zinc-300">
                    <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-zinc-200 to-zinc-300 dark:from-zinc-700 dark:to-zinc-600"></div>
                    {{ $brand }}
                </div>
            @endforeach
        </div>
    </div>
</section>
