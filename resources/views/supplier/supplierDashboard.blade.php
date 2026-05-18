<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supplier Dashboard - SupplyLink</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#f8f9ff',
                        surface: '#f8f9ff',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#eff4ff',
                        'surface-container': '#e5eeff',
                        'surface-container-high': '#dce9ff',
                        'surface-container-highest': '#d3e4fe',
                        primary: '#00288e',
                        'primary-container': '#1e40af',
                        'on-primary': '#ffffff',
                        'on-primary-container': '#dbe6ff',
                        secondary: '#0060ac',
                        'secondary-container': '#64a8fe',
                        'on-secondary-container': '#003c70',
                        tertiary: '#611e00',
                        'on-surface': '#0b1c30',
                        'on-background': '#0b1c30',
                        'on-surface-variant': '#444653',
                        outline: '#757684',
                        'outline-variant': '#c4c5d5',
                    },
                    fontFamily: {
                        sans: ['Geist', 'ui-sans-serif', 'system-ui'],
                    },
                    boxShadow: {
                        soft: '0 18px 50px rgba(15, 23, 42, 0.08)',
                        card: '0 4px 20px rgba(15, 23, 42, 0.05)',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Geist', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.74);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(196, 197, 213, 0.55);
        }
    </style>
</head>

<body class="min-h-screen bg-background text-on-background antialiased">
    <div class="min-h-screen lg:flex">
        <aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:flex lg:w-[280px] lg:flex-col lg:border-r lg:border-outline-variant/40 lg:bg-surface lg:px-5 lg:py-8">
            <div class="px-3">
                <h1 class="text-xl font-bold text-primary">SupplyLink</h1>
                <p class="mt-1 text-sm font-medium text-on-surface-variant/80">Logistics Portal</p>
            </div>

            <nav class="mt-12 flex-1 space-y-2">
                @foreach ($navItems as $item)
                    <a href="{{ $item['href'] }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 active:scale-[0.98] {{ $item['active'] ? 'bg-secondary-container text-on-secondary-container shadow-sm' : 'text-on-surface-variant hover:translate-x-1 hover:bg-surface-container-high' }}">
                        <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto">
                <a href="#" class="flex w-full items-center justify-center rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-on-primary transition-all hover:opacity-90 active:scale-95">
                    Nouvelle demande
                </a>

                <div class="mt-8 border-t border-outline-variant/30 pt-6">
                    <a href="#" class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high">
                        <span class="material-symbols-outlined">settings</span>
                        <span>Parametres</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high">
                        <span class="material-symbols-outlined">help</span>
                        <span>Aide</span>
                    </a>
                </div>
            </div>
        </aside>

        <div class="flex min-h-screen w-full flex-col lg:pl-[280px]">
            <header class="sticky top-0 z-40 border-b border-outline-variant/20 bg-surface/90 px-4 py-3 backdrop-blur-md sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-[1440px] items-center justify-between gap-4">
                    <div class="flex items-center gap-3 lg:hidden">
                        <button id="dashboard-mobile-menu-button" type="button" class="grid h-10 w-10 place-items-center rounded-xl bg-surface-container-low text-on-surface" aria-controls="dashboard-mobile-menu" aria-expanded="false">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div>
                            <p class="text-base font-bold text-primary">SupplyLink</p>
                            <p class="text-xs font-medium text-on-surface-variant">Supplier</p>
                        </div>
                    </div>

                    <label class="hidden min-w-0 flex-1 items-center rounded-full bg-surface-container-low px-4 py-2 transition focus-within:ring-2 focus-within:ring-primary sm:flex lg:max-w-[460px]">
                        <span class="material-symbols-outlined text-xl text-on-surface-variant">search</span>
                        <input class="w-full border-none bg-transparent px-2 text-sm text-on-surface outline-none placeholder:text-on-surface-variant focus:ring-0" placeholder="Rechercher commandes, fournisseurs ou documents..." type="search">
                    </label>

                    <div class="flex items-center gap-1 sm:gap-2">
                        <a href="{{ route('supplier.dashboard') }}" class="grid h-10 w-10 place-items-center rounded-full text-on-surface-variant transition hover:bg-surface-container-highest">
                            <span class="material-symbols-outlined">notifications</span>
                        </a>
                        <a href="mailto:support@supplylink.test" class="hidden h-10 w-10 place-items-center rounded-full text-on-surface-variant transition hover:bg-surface-container-highest sm:grid">
                            <span class="material-symbols-outlined">chat_bubble</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="hidden h-10 w-10 place-items-center rounded-full text-on-surface-variant transition hover:bg-surface-container-highest sm:grid">
                            <span class="material-symbols-outlined">settings</span>
                        </a>
                        <div class="mx-2 hidden h-8 w-px bg-outline-variant/40 sm:block"></div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-full p-1 pr-3 transition hover:bg-surface-container-high">
                            <span class="grid h-9 w-9 place-items-center rounded-full bg-primary text-sm font-bold text-on-primary">{{ $supplierInitials ?: 'S' }}</span>
                            <span class="hidden max-w-36 truncate text-sm font-medium text-on-surface sm:block">{{ $supplierName }}</span>
                        </a>
                    </div>
                </div>

                <label class="mt-3 flex items-center rounded-full bg-surface-container-low px-4 py-2 transition focus-within:ring-2 focus-within:ring-primary sm:hidden">
                    <span class="material-symbols-outlined text-xl text-on-surface-variant">search</span>
                    <input class="w-full border-none bg-transparent px-2 text-sm text-on-surface outline-none placeholder:text-on-surface-variant focus:ring-0" placeholder="Rechercher..." type="search">
                </label>

                <nav id="dashboard-mobile-menu" class="mt-3 hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-2 shadow-card lg:hidden">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['href'] }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium {{ $item['active'] ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </header>

            <main class="flex-1 px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
                <div class="mx-auto max-w-[1440px]">
                    <section class="mb-8">
                        <h2 class="text-3xl font-semibold tracking-normal text-on-surface sm:text-4xl">Supplier Overview</h2>
                        <p class="mt-2 max-w-3xl text-base text-on-surface-variant">Bienvenue, {{ $supplierName }}. Voici l'activite de vos demandes, offres et operations logistiques aujourd'hui.</p>
                    </section>

                    <section class="grid grid-cols-1 gap-6 xl:grid-cols-12">
                        <div class="xl:col-span-8">
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
                                @foreach ($stats as $stat)
                                    <article class="rounded-3xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-card transition hover:-translate-y-0.5 hover:shadow-soft">
                                        <div class="mb-5 flex items-start justify-between gap-3">
                                            <div class="grid h-12 w-12 place-items-center rounded-xl {{ $stat['tone'] === 'primary' ? 'bg-primary/10 text-primary' : ($stat['tone'] === 'secondary' ? 'bg-secondary/10 text-secondary' : 'bg-tertiary/10 text-tertiary') }}">
                                                <span class="material-symbols-outlined">{{ $stat['icon'] }}</span>
                                            </div>
                                            <span class="rounded-full px-2 py-1 text-xs font-bold uppercase {{ $stat['tone'] === 'primary' ? 'text-primary' : ($stat['tone'] === 'secondary' ? 'text-secondary' : 'text-tertiary') }}">{{ $stat['badge'] }}</span>
                                        </div>
                                        <p class="text-sm font-medium text-on-surface-variant">{{ $stat['label'] }}</p>
                                        <h3 class="mt-2 text-3xl font-semibold text-on-surface {{ $stat['tone'] === 'primary' ? 'text-primary' : '' }}">{{ $stat['value'] }}</h3>
                                    </article>
                                @endforeach
                            </div>

                            <article class="mt-6 overflow-hidden rounded-3xl border border-outline-variant/40 bg-surface-container-lowest shadow-card">
                                <div class="flex items-center justify-between gap-4 border-b border-outline-variant/20 px-5 py-5 sm:px-7">
                                    <h3 class="text-2xl font-semibold text-on-surface">Nouvelles demandes</h3>
                                    <a href="#" class="text-sm font-semibold text-primary hover:underline">Voir tout</a>
                                </div>

                                <div class="divide-y divide-outline-variant/10">
                                    @foreach ($requests as $request)
                                        <a href="#" class="group flex flex-col gap-4 p-5 transition hover:bg-surface-container sm:flex-row sm:items-center sm:justify-between sm:px-7">
                                            <div class="flex min-w-0 items-center gap-4">
                                                <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-surface-container-high text-primary transition group-hover:bg-primary-container group-hover:text-on-primary-container">
                                                    <span class="material-symbols-outlined">{{ $request['icon'] }}</span>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="truncate text-base font-semibold text-on-surface">{{ $request['title'] }}</p>
                                                    <p class="mt-1 truncate text-sm font-medium text-on-surface-variant">Demande par {{ $request['company'] }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between gap-4 pl-16 sm:block sm:pl-0 sm:text-right">
                                                <p class="font-semibold text-on-surface">{{ $request['amount'] }}</p>
                                                <p class="text-sm font-medium text-on-surface-variant">{{ $request['time'] }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </article>
                        </div>

                        <aside class="space-y-6 xl:col-span-4">
                            <article class="glass-card relative overflow-hidden rounded-3xl p-6 shadow-card">
                                <div class="relative z-10">
                                    <div class="mb-6 flex items-center justify-between gap-4">
                                        <h3 class="text-2xl font-semibold text-on-surface">Profile Completion</h3>
                                        <span class="rounded-full bg-primary/10 px-3 py-1 text-sm font-bold text-primary">{{ $profileCompletion }}%</span>
                                    </div>
                                    <div class="mb-6 h-2 overflow-hidden rounded-full bg-surface-container-highest">
                                        <div class="h-full rounded-full bg-primary" style="width: {{ $profileCompletion }}%"></div>
                                    </div>
                                    <p class="mb-7 text-base leading-7 text-on-surface-variant">Presque termine. Completez vos documents fiscaux pour debloquer les lots premium fournisseur.</p>
                                    <a href="{{ route('profile.edit') }}" class="flex w-full items-center justify-center rounded-xl bg-primary-container px-4 py-3 text-sm font-semibold text-on-primary-container transition hover:opacity-90 active:scale-95">
                                        Completer le profil
                                    </a>
                                </div>
                            </article>

                            <article class="relative h-[300px] overflow-hidden rounded-3xl border border-outline-variant/40 bg-slate-200 shadow-card">
                                <img class="h-full w-full object-cover grayscale" alt="Carte logistique" src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1000&q=80">
                                <div class="absolute inset-0 bg-gradient-to-t from-surface via-surface/45 to-transparent"></div>
                                <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-4 p-6">
                                    <div>
                                        <h4 class="text-sm font-semibold text-on-surface">Noeuds de livraison actifs</h4>
                                        <p class="mt-1 text-sm font-medium text-on-surface-variant">12 routes en cours sur Lyon/Paris</p>
                                    </div>
                                    <span class="material-symbols-outlined text-primary">location_on</span>
                                </div>
                            </article>

                            <article class="rounded-3xl border border-outline-variant/20 bg-surface-container-highest p-6">
                                <h3 class="mb-5 text-base font-semibold text-on-surface">Actions rapides</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <a href="{{ route('profile.edit') }}" class="flex min-h-28 flex-col items-center justify-center rounded-2xl border border-outline-variant/20 bg-surface p-4 text-center transition hover:border-primary">
                                        <span class="material-symbols-outlined mb-2 text-on-surface-variant">upload_file</span>
                                        <span class="text-sm font-semibold">Upload Invoice</span>
                                    </a>
                                    <a href="mailto:support@supplylink.test" class="flex min-h-28 flex-col items-center justify-center rounded-2xl border border-outline-variant/20 bg-surface p-4 text-center transition hover:border-primary">
                                        <span class="material-symbols-outlined mb-2 text-on-surface-variant">contact_support</span>
                                        <span class="text-sm font-semibold">Support Chat</span>
                                    </a>
                                </div>
                            </article>
                        </aside>
                    </section>
                </div>
            </main>

            <footer class="border-t border-outline-variant/40 bg-surface-container-low px-4 sm:px-6 lg:px-8">
                <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-8 py-10 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <h3 class="mb-4 text-lg font-bold text-primary">SupplyLink</h3>
                        <p class="max-w-xs text-sm font-medium text-on-surface-variant">Connecting the global supply chain with precision and ease.</p>
                    </div>
                    <div>
                        <h4 class="mb-4 text-sm font-semibold text-on-surface">Resources</h4>
                        <div class="space-y-3 text-sm font-medium text-on-surface-variant">
                            <a class="block hover:text-primary hover:underline" href="#">Documentation</a>
                            <a class="block hover:text-primary hover:underline" href="#">Pricing</a>
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-4 text-sm font-semibold text-on-surface">Support</h4>
                        <div class="space-y-3 text-sm font-medium text-on-surface-variant">
                            <a class="block hover:text-primary hover:underline" href="#">Help Center</a>
                            <a class="block hover:text-primary hover:underline" href="#">Contact</a>
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-4 text-sm font-semibold text-on-surface">Legal</h4>
                        <div class="space-y-3 text-sm font-medium text-on-surface-variant">
                            <a class="block hover:text-primary hover:underline" href="#">Privacy Policy</a>
                            <a class="block hover:text-primary hover:underline" href="#">Terms of Service</a>
                        </div>
                    </div>
                </div>

                <div class="mx-auto flex max-w-[1440px] flex-col gap-4 border-t border-outline-variant/20 py-6 text-sm font-medium text-on-surface-variant sm:flex-row sm:items-center sm:justify-between">
                    <p>&copy; {{ date('Y') }} SupplyLink Logistics. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a href="{{ route('profile.edit') }}" class="hover:text-primary">Security</a>
                        <a href="{{ route('supplier.dashboard') }}" class="hover:text-primary">Status</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<script>
    const dashboardMobileButton = document.getElementById('dashboard-mobile-menu-button');
    const dashboardMobileMenu = document.getElementById('dashboard-mobile-menu');

    dashboardMobileButton?.addEventListener('click', () => {
        const isOpen = !dashboardMobileMenu.classList.contains('hidden');
        dashboardMobileMenu.classList.toggle('hidden', isOpen);
        dashboardMobileButton.setAttribute('aria-expanded', String(!isOpen));
    });
</script>
</body>
</html>
