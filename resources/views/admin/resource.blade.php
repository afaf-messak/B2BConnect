<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SupplyLink Admin - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00288e',
                        'secondary-container': '#64a8fe',
                        'on-secondary-container': '#003c70',
                        surface: '#f8f9ff',
                        'surface-container-low': '#eff4ff',
                        'surface-container-high': '#dce9ff',
                        'surface-container-lowest': '#ffffff',
                        'on-surface': '#0b1c30',
                        'on-surface-variant': '#444653',
                        'outline-variant': '#c4c5d5',
                        error: '#ba1a1a',
                    },
                    fontFamily: {
                        sans: ['Geist', 'sans-serif'],
                    },
                    boxShadow: {
                        soft: '0 4px 20px rgba(15, 23, 42, 0.06)',
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Geist', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>

<body class="bg-surface text-on-surface">
    <aside class="fixed left-0 top-0 z-50 flex h-screen w-[280px] flex-col border-r border-outline-variant/40 bg-surface py-8">
        <div class="mb-10 flex items-center gap-3 px-8">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">hub</span>
            </div>
            <div>
                <h1 class="text-xl font-extrabold text-primary">SupplyLink</h1>
                <p class="text-xs text-on-surface-variant">Admin Portal</p>
            </div>
        </div>

        <nav class="flex-1 space-y-1">
            @foreach ($navItems as $item)
                <a href="{{ $item['href'] }}" class="mx-4 mb-2 flex items-center gap-4 rounded-xl px-4 py-3 transition-all active:scale-[0.98] {{ $item['active'] ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:translate-x-1 hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="border-t border-outline-variant/20 px-4 pt-6">
            <a href="{{ route('admin.settings') }}" class="flex items-center gap-4 rounded-xl px-4 py-3 text-on-surface-variant transition hover:bg-surface-container-high">
                <span class="material-symbols-outlined">settings</span>
                <span class="text-sm font-medium">Settings</span>
            </a>
            <a href="#" class="flex items-center gap-4 rounded-xl px-4 py-3 text-on-surface-variant transition hover:bg-surface-container-high">
                <span class="material-symbols-outlined">help</span>
                <span class="text-sm font-medium">Help</span>
            </a>
        </div>
    </aside>

    <header class="fixed left-[280px] right-0 top-0 z-40 flex h-16 items-center justify-between border-b border-outline-variant/20 bg-surface/90 px-8 backdrop-blur-md">
        <div class="relative w-full max-w-xl">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <input class="w-full rounded-full border-none bg-surface-container-low py-2.5 pl-12 pr-4 focus:ring-2 focus:ring-primary" placeholder="Search admin resources..." type="search">
        </div>
        <div class="flex items-center gap-3">
            <button class="rounded-full p-2 transition hover:bg-surface-container-high" type="button">
                <span class="material-symbols-outlined text-on-surface-variant">notifications</span>
            </button>
            <button class="rounded-full p-2 transition hover:bg-surface-container-high" type="button">
                <span class="material-symbols-outlined text-on-surface-variant">chat_bubble</span>
            </button>
            <div class="ml-3 flex h-10 w-10 items-center justify-center rounded-full bg-primary text-sm font-bold text-white">A</div>
        </div>
    </header>

    <main class="ml-[280px] min-h-screen px-8 pb-12 pt-24">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <span class="material-symbols-outlined">{{ $icon }}</span>
                </div>
                <h2 class="text-3xl font-extrabold text-on-surface">{{ $title }}</h2>
                <p class="mt-2 text-on-surface-variant">{{ $description }}</p>
            </div>
            <div class="flex gap-3">
                <button class="rounded-xl border border-outline-variant/40 px-5 py-3 text-sm font-bold text-on-surface transition hover:bg-surface-container-high" type="button">Export</button>
                <button class="rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-soft transition hover:brightness-110" type="button">New Admin Action</button>
            </div>
        </div>

        <section class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
            @foreach ($stats as $stat)
                <article class="rounded-3xl border border-outline-variant/30 bg-white p-6 shadow-soft">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">{{ $stat['label'] }}</p>
                    <p class="mt-3 text-4xl font-extrabold text-primary">{{ $stat['value'] }}</p>
                </article>
            @endforeach
        </section>

        <section class="overflow-hidden rounded-3xl border border-outline-variant/30 bg-white shadow-soft">
            <div class="flex items-center justify-between border-b border-outline-variant/30 px-7 py-5">
                <div>
                    <h3 class="text-xl font-extrabold">{{ $title }} Management</h3>
                    <p class="mt-1 text-sm text-on-surface-variant">Latest records and admin review actions.</p>
                </div>
                <span class="rounded-full bg-surface-container-low px-4 py-2 text-sm font-bold text-primary">{{ count($rows) }} records</span>
            </div>

            <div class="divide-y divide-outline-variant/20">
                @foreach ($rows as $row)
                    <article class="grid grid-cols-1 gap-4 px-7 py-5 transition hover:bg-surface-container-lowest md:grid-cols-[1fr_180px_140px] md:items-center">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-surface-container-low text-primary">
                                <span class="material-symbols-outlined">{{ $row['icon'] }}</span>
                            </div>
                            <div>
                                <h4 class="font-extrabold text-on-surface">{{ $row['title'] }}</h4>
                                <p class="mt-1 text-sm text-on-surface-variant">{{ $row['subtitle'] }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-on-surface-variant">{{ $row['meta'] }}</p>
                        <div class="flex items-center justify-between gap-3 md:justify-end">
                            <span class="rounded-full bg-surface-container-low px-3 py-1 text-xs font-bold text-primary">{{ $row['status'] }}</span>
                            <button class="flex h-10 w-10 items-center justify-center rounded-full text-on-surface-variant transition hover:bg-surface-container-high hover:text-primary" type="button">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
</body>

</html>
