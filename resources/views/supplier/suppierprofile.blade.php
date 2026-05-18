<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supplier Profile - SupplyLink</title>

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
    </style>
</head>

<body class="min-h-screen bg-background text-on-background antialiased selection:bg-primary-fixed">
    <div class="min-h-screen lg:flex">
        <aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:flex lg:w-[280px] lg:flex-col lg:border-r lg:border-outline-variant/40 lg:bg-surface lg:px-5 lg:py-8">
            <div class="flex items-center gap-3 px-3">
                <div class="grid h-10 w-10 place-items-center rounded-xl bg-primary text-white">
                    <span class="material-symbols-outlined">hub</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-primary">SupplyLink</h1>
                    <p class="text-sm font-medium text-on-surface-variant">Logistics Portal</p>
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

            <div class="mt-auto space-y-1">
                <a class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition-all hover:translate-x-1 hover:bg-surface-container-high" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span>Settings</span>
                </a>
                <a class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium text-on-surface-variant transition-all hover:translate-x-1 hover:bg-surface-container-high" href="#">
                    <span class="material-symbols-outlined">help</span>
                    <span>Help</span>
                </a>
            </div>
        </aside>

        <div class="flex min-h-screen w-full flex-col lg:pl-[280px]">
            <header class="sticky top-0 z-40 border-b border-outline-variant/20 bg-surface/90 px-4 py-3 backdrop-blur-md sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4">
                    <div class="flex items-center gap-3 lg:hidden">
                        <button id="profile-mobile-menu-button" type="button" class="grid h-10 w-10 place-items-center rounded-xl bg-surface-container-low text-on-surface" aria-controls="profile-mobile-menu" aria-expanded="false">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div>
                            <p class="text-base font-bold text-primary">SupplyLink</p>
                            <p class="text-xs font-medium text-on-surface-variant">Profile</p>
                        </div>
                    </div>

                    <label class="hidden min-w-0 flex-1 items-center rounded-full bg-surface-container px-4 py-2 transition focus-within:ring-2 focus-within:ring-primary sm:flex lg:max-w-[420px]">
                        <span class="material-symbols-outlined mr-2 text-base text-on-surface-variant">search</span>
                        <input class="w-full border-none bg-transparent p-0 text-sm text-on-surface outline-none placeholder:text-on-surface-variant focus:ring-0" placeholder="Search suppliers, routes, or cargo..." type="search">
                    </label>

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
                        <a href="{{ route('supplier.profile') }}" class="ml-2 grid h-9 w-9 place-items-center rounded-full bg-primary text-sm font-bold text-on-primary ring-2 ring-surface">
                            {{ $supplierInitials }}
                        </a>
                    </div>
                </div>

                <label class="mt-3 flex items-center rounded-full bg-surface-container px-4 py-2 transition focus-within:ring-2 focus-within:ring-primary sm:hidden">
                    <span class="material-symbols-outlined mr-2 text-base text-on-surface-variant">search</span>
                    <input class="w-full border-none bg-transparent p-0 text-sm text-on-surface outline-none placeholder:text-on-surface-variant focus:ring-0" placeholder="Search suppliers..." type="search">
                </label>

                <nav id="profile-mobile-menu" class="mt-3 hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-2 shadow-card lg:hidden">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['href'] }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium {{ $item['active'] ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </header>

            <main class="flex-1 px-4 py-8 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <section class="relative mb-8 overflow-hidden rounded-3xl border border-outline-variant/30 bg-surface-container-lowest p-6 shadow-card sm:p-8">
                        <div class="relative z-10 flex flex-col gap-6 md:flex-row md:items-center">
                            <div class="grid h-28 w-28 shrink-0 place-items-center overflow-hidden rounded-2xl bg-white p-4 shadow-soft ring-1 ring-outline-variant/20 sm:h-32 sm:w-32">
                                <img class="h-full w-full rounded-xl object-cover" src="{{ $company['logo_url'] }}" alt="Company logo">
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="mb-3 flex flex-wrap items-center gap-3">
                                    <h2 class="text-2xl font-semibold text-primary sm:text-3xl">{{ $company['name'] }}</h2>
                                    <span class="rounded-full bg-secondary-container px-3 py-1 text-sm font-semibold text-on-secondary-container">{{ $company['status'] }}</span>
                                </div>

                                <div class="mb-6 flex flex-wrap items-center gap-3 text-sm text-on-surface-variant">
                                    <div class="flex items-center text-tertiary">
                                        @for ($i = 0; $i < 5; $i++)
                                            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">{{ $i < 4 ? 'star' : 'star_half' }}</span>
                                        @endfor
                                        <span class="ml-2 font-bold text-on-surface">{{ $company['rating'] }}</span>
                                    </div>
                                    <span class="text-outline">|</span>
                                    <span>{{ $company['reviews_count'] }}</span>
                                    <span class="text-outline">|</span>
                                    <span>{{ $company['location'] }}</span>
                                </div>

                                <div class="flex flex-col gap-3 sm:flex-row">
                                    <a href="mailto:support@supplylink.test" class="inline-flex items-center justify-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition active:scale-95">
                                        <span class="material-symbols-outlined">send</span>
                                        Message Supplier
                                    </a>
                                    <a href="{{ route('supplier.offers.export') }}" class="inline-flex items-center justify-center rounded-full border border-outline-variant px-6 py-3 text-sm font-semibold text-primary transition hover:bg-surface-container active:scale-95">
                                        Download Catalog
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-primary/5 blur-3xl"></div>
                    </section>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                        <div class="space-y-6 lg:col-span-8">
                            <section class="rounded-3xl border border-outline-variant/30 bg-surface-container-lowest p-6 shadow-card sm:p-8">
                                <h3 class="mb-6 text-lg font-semibold text-primary">About Us</h3>
                                <p class="mb-6 text-base leading-8 text-on-surface-variant">
                                    Global Logistics Dynamics has been at the forefront of European supply chain innovation for over 15 years. We specialize in end-to-end multimodal transport solutions, leveraging advanced AI routing to reduce lead times and improve visibility across strategic hubs.
                                </p>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                    @foreach ($stats as $stat)
                                        <div class="rounded-2xl bg-surface-container p-4 text-center">
                                            <p class="text-lg font-bold text-primary">{{ $stat['value'] }}</p>
                                            <p class="mt-1 text-sm text-on-surface-variant">{{ $stat['label'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <section class="rounded-3xl border border-outline-variant/30 bg-surface-container-lowest p-6 shadow-card sm:p-8">
                                <h3 class="mb-6 text-lg font-semibold text-primary">Services Offered</h3>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    @foreach ($services as $service)
                                        <div class="flex items-start gap-4 rounded-2xl p-4 transition hover:bg-surface-container">
                                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-primary-fixed text-primary">
                                                <span class="material-symbols-outlined">{{ $service['icon'] }}</span>
                                            </div>
                                            <div>
                                                <h4 class="mb-1 font-bold text-on-surface">{{ $service['title'] }}</h4>
                                                <p class="text-sm leading-6 text-on-surface-variant">{{ $service['description'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <section class="rounded-3xl border border-outline-variant/30 bg-surface-container-lowest p-6 shadow-card sm:p-8">
                                <div class="mb-6 flex items-center justify-between gap-4">
                                    <h3 class="text-lg font-semibold text-primary">Recent Reviews</h3>
                                    <a class="text-sm font-semibold text-primary underline underline-offset-4" href="#">View All</a>
                                </div>

                                <div class="space-y-6">
                                    @foreach ($reviews as $review)
                                        <article class="border-b border-outline-variant/10 pb-6 last:border-none last:pb-0">
                                            <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div class="grid h-10 w-10 place-items-center rounded-full bg-surface-container font-bold text-primary">{{ $review['initials'] }}</div>
                                                    <div>
                                                        <p class="font-bold text-on-surface">{{ $review['name'] }}</p>
                                                        <p class="text-sm text-on-surface-variant">{{ $review['date'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex text-tertiary">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">{{ $i < $review['rating'] ? 'star' : 'star_border' }}</span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-sm leading-6 text-on-surface-variant">{{ $review['body'] }}</p>
                                        </article>
                                    @endforeach
                                </div>
                            </section>
                        </div>

                        <aside class="space-y-6 lg:col-span-4">
                            <section class="overflow-hidden rounded-3xl border border-outline-variant/30 bg-surface-container-lowest shadow-card">
                                <div class="relative h-48">
                                    <img class="h-full w-full object-cover" src="{{ $company['map_url'] }}" alt="Supplier map">
                                    <div class="absolute inset-0 bg-primary/20"></div>
                                    <div class="absolute inset-0 grid place-items-center">
                                        <span class="material-symbols-outlined text-5xl text-primary" style="font-variation-settings: 'FILL' 1;">location_on</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="mb-3 font-bold text-on-surface">Primary Headquarters</h3>
                                    <p class="flex items-start gap-2 text-sm leading-6 text-on-surface-variant">
                                        <span class="material-symbols-outlined mt-1 text-sm">place</span>
                                        {{ $company['address'] }}
                                    </p>
                                    <a class="mt-4 flex w-full items-center justify-center rounded-xl border border-primary/20 py-3 text-sm font-semibold text-primary transition hover:bg-primary-fixed" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($company['address']) }}">Get Directions</a>
                                </div>
                            </section>

                            <section class="rounded-3xl bg-primary-container p-6 text-white shadow-soft sm:p-8">
                                <h3 class="mb-6 text-lg font-semibold">Partner with us</h3>
                                <div class="space-y-4 text-sm font-medium">
                                    <p class="flex items-center gap-4"><span class="material-symbols-outlined opacity-70">call</span>{{ $company['phone'] }}</p>
                                    <p class="flex items-center gap-4"><span class="material-symbols-outlined opacity-70">language</span>{{ $company['website'] }}</p>
                                    <p class="flex items-center gap-4"><span class="material-symbols-outlined opacity-70">verified_user</span>{{ $company['certification'] }}</p>
                                </div>
                                <hr class="my-6 border-white/20">
                                <p class="mb-6 text-sm opacity-80">Avg. response time: {{ $company['response_time'] }}</p>
                                <a class="flex w-full items-center justify-center rounded-xl bg-white py-4 text-sm font-bold text-primary transition active:scale-95" href="{{ route('supplier.offers') }}">Request Quote</a>
                            </section>

                            <section class="rounded-3xl border border-outline-variant/30 bg-surface-container-lowest p-6 shadow-card sm:p-8">
                                <h3 class="mb-4 font-bold text-on-surface">Accreditations</h3>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($accreditations as $accreditation)
                                        <span class="rounded-full bg-surface-container px-3 py-1 text-sm text-on-surface-variant">{{ $accreditation }}</span>
                                    @endforeach
                                </div>
                            </section>
                        </aside>
                    </div>

                    <footer class="mt-16 border-t border-outline-variant/50 py-10">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <h4 class="mb-4 text-base font-semibold text-primary">SupplyLink</h4>
                                <p class="text-sm leading-6 text-on-surface-variant">Efficiency and precision in every global shipment.</p>
                            </div>
                            <div>
                                <h5 class="mb-4 text-sm font-bold">Resources</h5>
                                <div class="space-y-2 text-sm text-on-surface-variant">
                                    <a class="block hover:text-primary" href="{{ route('supplier.dashboard') }}">Documentation</a>
                                    <a class="block hover:text-primary" href="mailto:support@supplylink.test">Support</a>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-4 text-sm font-bold">Company</h5>
                                <div class="space-y-2 text-sm text-on-surface-variant">
                                    <a class="block hover:text-primary" href="{{ route('supplier.profile') }}">About</a>
                                    <a class="block hover:text-primary" href="{{ route('profile.edit') }}">Privacy</a>
                                </div>
                            </div>
                            <div class="text-sm leading-6 text-on-surface-variant lg:text-right">
                                <p>&copy; {{ date('Y') }} SupplyLink Logistics.</p>
                                <p>All rights reserved.</p>
                            </div>
                        </div>
                    </footer>
                </div>
            </main>
        </div>
    </div>
<script>
    const profileMobileButton = document.getElementById('profile-mobile-menu-button');
    const profileMobileMenu = document.getElementById('profile-mobile-menu');

    profileMobileButton?.addEventListener('click', () => {
        const isOpen = !profileMobileMenu.classList.contains('hidden');
        profileMobileMenu.classList.toggle('hidden', isOpen);
        profileMobileButton.setAttribute('aria-expanded', String(!isOpen));
    });
</script>
</body>
</html>
