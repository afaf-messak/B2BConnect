<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Offres Recentes - SupplyLink</title>

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
                        'primary-fixed': '#dde1ff',
                        'secondary-fixed': '#d4e3ff',
                        'tertiary-fixed': '#ffdbce',
                        primary: '#00288e',
                        'primary-container': '#1e40af',
                        'on-primary': '#ffffff',
                        'on-primary-container': '#dbe6ff',
                        secondary: '#0060ac',
                        'secondary-container': '#64a8fe',
                        'on-secondary-container': '#003c70',
                        tertiary: '#611e00',
                        error: '#ba1a1a',
                        'error-container': '#ffdad6',
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
            border: 1px solid rgba(196, 197, 213, 0.45);
        }
    </style>
</head>

<body class="min-h-screen bg-background text-on-background antialiased">
    <div class="min-h-screen lg:flex">
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
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto">
                <a href="{{ route('supplier.dashboard') }}" class="mb-6 flex w-full items-center justify-center gap-2 rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-on-primary shadow-lg transition active:scale-[0.98]">
                    <span class="material-symbols-outlined">add</span>
                    New Request
                </a>
                <div class="space-y-1 border-t border-outline-variant/20 pt-6">
                    <a class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high" href="{{ route('profile.edit') }}">
                        <span class="material-symbols-outlined">settings</span>
                        <span>Settings</span>
                    </a>
                    <a class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition hover:bg-surface-container-high" href="mailto:support@supplylink.test">
                        <span class="material-symbols-outlined">help</span>
                        <span>Help</span>
                    </a>
                </div>
            </div>
        </aside>

        <div class="flex min-h-screen w-full flex-col lg:pl-[280px]">
            <header class="sticky top-0 z-40 border-b border-outline-variant/20 bg-surface/90 px-4 py-3 shadow-sm backdrop-blur-md sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-[1440px] items-center justify-between gap-4">
                    <div class="flex items-center gap-3 lg:hidden">
                        <button id="mobile-menu-button" class="grid h-10 w-10 place-items-center rounded-xl bg-surface-container-low text-on-surface" type="button" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div>
                            <p class="text-base font-bold text-primary">SupplyLink</p>
                            <p class="text-xs font-medium text-on-surface-variant">Offres</p>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('supplier.offers') }}" class="hidden min-w-0 flex-1 items-center rounded-full border border-outline-variant/20 bg-surface-container-low px-4 py-2 transition focus-within:ring-2 focus-within:ring-primary sm:flex lg:max-w-[460px]">
                        <span class="material-symbols-outlined text-outline">search</span>
                        <input name="q" value="{{ $filters['q'] }}" class="ml-2 w-full border-none bg-transparent p-0 text-sm text-on-surface outline-none placeholder:text-on-surface-variant focus:ring-0" placeholder="Search offers, routes, or suppliers..." type="search">
                        @if ($filters['status'])
                            <input type="hidden" name="status" value="{{ $filters['status'] }}">
                        @endif
                    </form>

                    <div class="flex items-center gap-1 sm:gap-2">
                        <a href="{{ route('supplier.dashboard') }}" class="grid h-10 w-10 place-items-center rounded-full transition hover:bg-surface-container-highest">
                            <span class="material-symbols-outlined text-on-surface-variant">notifications</span>
                        </a>
                        <a href="mailto:support@supplylink.test" class="hidden h-10 w-10 place-items-center rounded-full transition hover:bg-surface-container-highest sm:grid">
                            <span class="material-symbols-outlined text-on-surface-variant">chat_bubble</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="hidden h-10 w-10 place-items-center rounded-full transition hover:bg-surface-container-highest sm:grid">
                            <span class="material-symbols-outlined text-on-surface-variant">settings</span>
                        </a>
                        <div class="mx-2 hidden h-8 w-px bg-outline-variant/30 md:block"></div>
                        <div class="hidden text-right md:block">
                            <p class="text-sm font-bold text-on-surface">{{ $supplierName }}</p>
                            <p class="text-[10px] text-outline">{{ $supplierRole }}</p>
                        </div>
                        <a href="{{ route('supplier.profile') }}" class="grid h-10 w-10 place-items-center rounded-full border border-outline-variant/50 bg-primary text-sm font-bold text-on-primary">
                            {{ $supplierInitials }}
                        </a>
                    </div>
                </div>

                <form method="GET" action="{{ route('supplier.offers') }}" class="mt-3 flex items-center rounded-full border border-outline-variant/20 bg-surface-container-low px-4 py-2 transition focus-within:ring-2 focus-within:ring-primary sm:hidden">
                    <span class="material-symbols-outlined text-outline">search</span>
                    <input name="q" value="{{ $filters['q'] }}" class="ml-2 w-full border-none bg-transparent p-0 text-sm text-on-surface outline-none placeholder:text-on-surface-variant focus:ring-0" placeholder="Search offers..." type="search">
                    @if ($filters['status'])
                        <input type="hidden" name="status" value="{{ $filters['status'] }}">
                    @endif
                </form>

                <nav id="mobile-menu" class="mt-3 hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-2 shadow-card lg:hidden">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['href'] }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium {{ $item['active'] ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </header>

            <main class="flex-1 px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
                <div class="mx-auto max-w-[1440px]">
                    <section class="mb-8 flex flex-col gap-5 xl:flex-row xl:items-end xl:justify-between">
                        <div>
                            <h2 class="mb-3 text-2xl font-semibold text-primary">Offres Recentes</h2>
                            <p class="max-w-3xl text-base leading-7 text-on-surface-variant">Gerez vos propositions logistiques entrantes. Comparez les tarifs, les delais et la fiabilite des transporteurs en temps reel.</p>
                        </div>
                        <form method="GET" action="{{ route('supplier.offers') }}" class="flex flex-col gap-3 sm:flex-row">
                            <input type="hidden" name="q" value="{{ $filters['q'] }}">
                            <select name="status" class="rounded-xl border border-outline bg-white px-4 py-3 text-sm font-bold text-on-surface transition focus:border-primary focus:ring-primary">
                                <option value="">Tous les statuts</option>
                                <option value="pending" @selected($filters['status'] === 'pending')>En attente</option>
                                <option value="accepted" @selected($filters['status'] === 'accepted')>Acceptees</option>
                                <option value="rejected" @selected($filters['status'] === 'rejected')>Refusees</option>
                                <option value="expired" @selected($filters['status'] === 'expired')>Expirees</option>
                            </select>
                            <button class="rounded-xl border border-outline px-6 py-3 text-sm font-bold transition hover:bg-surface-container" type="submit">Filtrer</button>
                            <a href="{{ route('supplier.offers.export', request()->only(['q', 'status'])) }}" class="rounded-xl bg-primary px-6 py-3 text-center text-sm font-bold text-on-primary shadow-lg shadow-primary/20 transition hover:opacity-90">Exporter (CSV)</a>
                        </form>
                    </section>

                    @if (session('status'))
                        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <section class="grid grid-cols-1 gap-6 xl:grid-cols-12">
                        <div class="xl:col-span-8">
                            <article class="relative overflow-hidden rounded-[32px] border border-outline-variant/50 bg-white p-6 shadow-card transition duration-300 hover:shadow-soft sm:p-8">
                                @if ($featuredOffer['recommended'])
                                    <div class="mb-6 flex justify-start sm:absolute sm:right-6 sm:top-6">
                                        <span class="rounded-full bg-secondary-container px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-on-secondary-container">Recommande</span>
                                    </div>
                                @endif

                                <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-start">
                                    <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-surface-container text-primary">
                                        <span class="material-symbols-outlined text-4xl">{{ $featuredOffer['icon'] }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-xl font-semibold text-on-surface sm:text-2xl">{{ $featuredOffer['company'] }}</h3>
                                        <p class="mt-1 text-base text-outline">{{ $featuredOffer['subtitle'] }}</p>
                                    </div>
                                </div>

                                <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-3">
                                    <div class="rounded-2xl border border-outline-variant/20 bg-surface-container-low p-6">
                                        <p class="mb-2 text-sm text-outline">Prix Total</p>
                                        <p class="text-xl font-bold text-primary">{{ $featuredOffer['price'] }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-outline-variant/20 bg-surface-container-low p-6">
                                        <p class="mb-2 text-sm text-outline">Livraison Estimee</p>
                                        <p class="text-xl font-bold text-on-surface">{{ $featuredOffer['delivery'] }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-outline-variant/20 bg-surface-container-low p-6">
                                        <p class="mb-2 text-sm text-outline">Type de Cargo</p>
                                        <p class="text-xl font-bold text-on-surface">{{ $featuredOffer['cargo'] }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-6 border-t border-outline-variant/30 pt-6 lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="grid h-9 w-9 place-items-center rounded-full bg-green-500 text-[10px] font-bold text-white">{{ $featuredOffer['reliability'] }}</div>
                                        <p class="max-w-xs text-sm text-on-surface-variant">Taux de fiabilite du transporteur</p>
                                    </div>
                                    @if ($featuredOffer['can_update'])
                                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:min-w-[320px]">
                                            <form method="POST" action="{{ route('supplier.offers.reject', $featuredOffer['id']) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="w-full rounded-xl border-2 border-error/20 px-6 py-3 text-sm font-bold text-error transition hover:bg-error-container/20" type="submit">Refuser</button>
                                            </form>
                                            <form method="POST" action="{{ route('supplier.offers.accept', $featuredOffer['id']) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="w-full rounded-xl bg-primary px-6 py-3 text-sm font-bold text-on-primary shadow-lg shadow-primary/30 transition active:scale-95" type="submit">Accepter l'offre</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="rounded-xl bg-surface-container px-5 py-3 text-sm font-bold text-on-surface-variant">Statut: {{ $featuredOffer['status'] }}</span>
                                    @endif
                                </div>
                            </article>
                        </div>

                        <aside class="space-y-6 xl:col-span-4">
                            @foreach ($secondaryOffers as $offer)
                                <article class="rounded-3xl border border-outline-variant/50 bg-white p-6 shadow-card transition hover:shadow-soft">
                                    <div class="mb-5 flex items-start justify-between gap-4">
                                        <div class="flex min-w-0 items-center gap-3">
                                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl {{ $loop->first ? 'bg-tertiary-fixed text-tertiary' : 'bg-secondary-fixed text-secondary' }}">
                                                <span class="material-symbols-outlined">{{ $offer['icon'] }}</span>
                                            </div>
                                            <div class="min-w-0">
                                                <h4 class="truncate font-bold text-on-surface">{{ $offer['company'] }}</h4>
                                                <p class="text-sm text-outline">{{ $offer['subtitle'] }}</p>
                                            </div>
                                        </div>
                                        <p class="shrink-0 font-bold text-primary">{{ $offer['price'] }}</p>
                                    </div>

                                    <div class="mb-6 space-y-4">
                                        @foreach ($offer['features'] as $feature)
                                            <div class="flex justify-between gap-4 text-sm">
                                                <span class="text-outline">{{ $feature['label'] }}</span>
                                                <span class="font-bold {{ $feature['tone'] === 'success' ? 'text-green-600' : ($feature['tone'] === 'secondary' ? 'text-secondary' : 'text-on-surface-variant') }}">{{ $feature['value'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($offer['can_update'])
                                        <div class="grid grid-cols-2 gap-3">
                                            <form method="POST" action="{{ route('supplier.offers.reject', $offer['id']) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="w-full rounded-lg border border-outline-variant py-2 text-sm font-bold text-on-surface-variant transition hover:bg-surface-container" type="submit">Rejeter</button>
                                            </form>
                                            <form method="POST" action="{{ route('supplier.offers.accept', $offer['id']) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button class="w-full rounded-lg py-2 text-sm font-bold text-white transition hover:opacity-90 {{ $loop->first ? 'bg-primary-container' : 'bg-secondary' }}" type="submit">Choisir</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="block rounded-lg bg-surface-container px-4 py-2 text-center text-sm font-bold text-on-surface-variant">Statut: {{ $offer['status'] }}</span>
                                    @endif
                                </article>
                            @endforeach
                        </aside>

                        <div class="xl:col-span-12">
                            <article class="glass-card rounded-[32px] border border-primary/10 p-6 shadow-card sm:p-8 lg:p-10">
                                <div class="flex flex-col gap-8 lg:flex-row lg:items-center">
                                    <div class="flex-1">
                                        <h3 class="mb-4 text-xl font-semibold text-primary">Analyse de Performance</h3>
                                        <p class="mb-6 max-w-3xl text-base leading-7 text-on-surface-variant">Le cout moyen de vos offres actuelles est en baisse de 12% par rapport au mois dernier. SupplyLink vous recommande de finaliser l'offre de "{{ $performance['recommended_company'] }}" pour optimiser vos flux.</p>
                                        <div class="flex flex-wrap gap-8">
                                            <div>
                                                <p class="text-3xl font-bold text-on-surface">{{ $performance['pending'] }}</p>
                                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-outline">Offres en attente</p>
                                            </div>
                                            <div class="hidden h-16 w-px bg-outline-variant/50 sm:block"></div>
                                            <div>
                                                <p class="text-3xl font-bold text-on-surface">{{ $performance['average_price'] }}</p>
                                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-outline">Prix moyen</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="relative aspect-video w-full overflow-hidden rounded-2xl border border-outline-variant/20 bg-surface-container-high lg:w-1/3">
                                        <img class="h-full w-full object-cover opacity-85" src="{{ $performance['image_url'] }}" alt="Logistics distribution center">
                                        <div class="absolute inset-0 bg-gradient-to-t from-primary/35 to-transparent"></div>
                                        <div class="absolute bottom-4 left-4 flex items-center gap-2">
                                            <span class="h-3 w-3 rounded-full bg-green-500"></span>
                                            <span class="text-sm font-bold text-white shadow-sm">Flux de reseau optimise</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>
            </main>

            <footer class="border-t border-outline-variant/50 bg-surface-container-low px-4 py-10 sm:px-6 lg:px-8">
                <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-8 md:grid-cols-4">
                    <div>
                        <h4 class="mb-4 text-lg font-bold text-primary">SupplyLink</h4>
                        <p class="text-sm leading-6 text-on-surface-variant">La plateforme intelligente pour une logistique transparente et efficace a travers le monde.</p>
                    </div>
                    <div>
                        <h5 class="mb-4 font-bold text-on-surface">Plateforme</h5>
                        <div class="space-y-2 text-sm text-on-surface-variant">
                            <a class="block hover:text-primary hover:underline" href="{{ route('supplier.dashboard') }}">Solution</a>
                            <a class="block hover:text-primary hover:underline" href="{{ route('supplier.offers') }}">Tarification</a>
                            <a class="block hover:text-primary hover:underline" href="mailto:support@supplylink.test">API</a>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-4 font-bold text-on-surface">Entreprise</h5>
                        <div class="space-y-2 text-sm text-on-surface-variant">
                            <a class="block hover:text-primary hover:underline" href="{{ route('supplier.profile') }}">A Propos</a>
                            <a class="block hover:text-primary hover:underline" href="{{ route('supplier.dashboard') }}">Blog</a>
                            <a class="block hover:text-primary hover:underline" href="mailto:support@supplylink.test">Contact</a>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-4 font-bold text-on-surface">Legal</h5>
                        <div class="space-y-2 text-sm text-on-surface-variant">
                            <a class="block hover:text-primary hover:underline" href="{{ route('supplier.profile') }}">Privacy Policy</a>
                            <a class="block hover:text-primary hover:underline" href="{{ route('supplier.profile') }}">Terms of Service</a>
                            <a class="block hover:text-primary hover:underline" href="{{ route('profile.edit') }}">Security</a>
                        </div>
                    </div>
                    <div class="border-t border-outline-variant/30 pt-6 md:col-span-4">
                        <div class="flex flex-col gap-4 text-sm text-on-surface-variant sm:flex-row sm:items-center sm:justify-between">
                            <p>&copy; {{ date('Y') }} SupplyLink Logistics. All rights reserved.</p>
                            <div class="flex gap-5">
                                <a href="{{ route('supplier.profile') }}" class="material-symbols-outlined text-outline transition hover:text-primary">language</a>
                                <a href="mailto:support@supplylink.test" class="material-symbols-outlined text-outline transition hover:text-primary">help_outline</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton?.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden', isOpen);
            mobileMenuButton.setAttribute('aria-expanded', String(!isOpen));
        });
    </script>
</body>
</html>
