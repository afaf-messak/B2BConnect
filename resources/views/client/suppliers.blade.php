<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ __('common.app_name') }} - {{ __('dashboard.suppliers') ?? 'Supplier Listings' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#00288e',
                        'primary-container': '#1e40af',
                        'secondary-container': '#64a8fe',
                        'on-secondary-container': '#003c70',
                        surface: '#f8f9ff',
                        'surface-container': '#e5eeff',
                        'surface-container-low': '#eff4ff',
                        'surface-container-high': '#dce9ff',
                        'surface-container-highest': '#d3e4fe',
                        'surface-container-lowest': '#ffffff',
                        background: '#f8f9ff',
                        'on-background': '#0b1c30',
                        'on-surface': '#0b1c30',
                        'on-surface-variant': '#444653',
                        outline: '#757684',
                        'outline-variant': '#c4c5d5',
                        error: '#ba1a1a'
                    },
                    spacing: {
                        gutter: '24px',
                        'container-max': '1440px'
                    },
                    fontFamily: {
                        sans: ['Geist', 'sans-serif']
                    },
                    boxShadow: {
                        soft: '0 4px 20px rgba(15, 23, 42, 0.06)',
                        float: '0 18px 50px rgba(15, 23, 42, 0.14)'
                    }
                }
            }
        };
    </script>
    <style>
        body {
            font-family: 'Geist', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.42);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        .map-lines {
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.32) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.32) 1px, transparent 1px),
                linear-gradient(35deg, transparent 44%, rgba(255, 255, 255, 0.55) 45%, rgba(255, 255, 255, 0.55) 46%, transparent 47%),
                linear-gradient(145deg, transparent 42%, rgba(255, 255, 255, 0.36) 43%, rgba(255, 255, 255, 0.36) 44%, transparent 45%);
            background-size: 46px 46px, 46px 46px, 220px 220px, 260px 260px;
        }
    </style>
</head>

<body class="overflow-hidden bg-background text-on-background antialiased">
    @php
        $suppliers = [
            [
                'id' => 'globaltrans',
                'name' => 'GlobalTrans Logistics',
                'subtitle' => 'Tier 1 Freight Forwarding',
                'rating' => '4.9',
                'reviews' => '124',
                'location' => 'Rotterdam, NL',
                'category' => 'logistics',
                'icon' => 'public',
                'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=180&q=80',
                'tags' => ['Sea Freight', 'Customs Clear', '+2 more'],
                'response' => '18 min',
                'rate' => '$1,200 avg rate',
                'verified' => 'ISO 9001 verified',
            ],
            [
                'id' => 'siliconflow',
                'name' => 'SiliconFlow Systems',
                'subtitle' => 'Hardware Integration',
                'rating' => '4.7',
                'reviews' => '89',
                'location' => 'San Jose, US',
                'category' => 'hardware',
                'icon' => 'memory',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=180&q=80',
                'tags' => ['IoT Nodes', 'Cloud Link'],
                'response' => '32 min',
                'rate' => '$850 project rate',
                'verified' => 'Security audited',
            ],
            [
                'id' => 'ecopack',
                'name' => 'EcoPack Solutions',
                'subtitle' => 'Sustainable Materials',
                'rating' => '4.8',
                'reviews' => '215',
                'location' => 'Berlin, DE',
                'category' => 'packaging',
                'icon' => 'package_2',
                'image' => 'https://images.unsplash.com/photo-1605600659873-d808a13e4d2a?auto=format&fit=crop&w=180&q=80',
                'tags' => ['Recyclable', 'Biodegradable'],
                'response' => '11 min',
                'rate' => '$0.18 per unit',
                'verified' => 'Eco certified',
            ],
            [
                'id' => 'swiftlink',
                'name' => 'SwiftLink Air',
                'subtitle' => 'Priority Air Cargo',
                'rating' => '5.0',
                'reviews' => '56',
                'location' => 'Dubai, AE',
                'category' => 'logistics',
                'icon' => 'flight_takeoff',
                'image' => 'https://images.unsplash.com/photo-1569154941061-e231b4725ef1?auto=format&fit=crop&w=180&q=80',
                'tags' => ['Next Day', 'Temp Control'],
                'response' => '7 min',
                'rate' => '$2,400 avg rate',
                'verified' => 'Air cargo certified',
            ],
        ];

        $filters = [
            ['label' => 'All Suppliers', 'icon' => 'filter_list', 'value' => 'all'],
            ['label' => 'Logistics', 'icon' => 'local_shipping', 'value' => 'logistics'],
            ['label' => 'Tech Hardware', 'icon' => 'memory', 'value' => 'hardware'],
            ['label' => 'Packaging', 'icon' => 'package_2', 'value' => 'packaging'],
            ['label' => 'Chemicals', 'icon' => 'science', 'value' => 'chemicals'],
        ];
    @endphp

    <aside class="fixed left-0 top-0 z-50 flex h-screen w-[280px] flex-col border-r border-outline-variant/40 bg-surface py-8">
        <div class="mb-12 flex items-center gap-3 px-8">
            <x-b2b-logo size="sm" href="{{ route('client.dashboard') }}" />
        </div>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('client.dashboard') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant transition-all hover:translate-x-1 hover:bg-surface-container-high">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-[15px] font-medium">Dashboard</span>
            </a>
            <a href="{{ route('client.offers.index') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant transition-all hover:translate-x-1 hover:bg-surface-container-high">
                <span class="material-symbols-outlined">request_quote</span>
                <span class="text-[15px] font-medium">Offers Received</span>
            </a>
            <a href="{{ route('client.suppliers.index') }}" class="mx-4 flex h-14 items-center gap-4 rounded-xl bg-secondary-container px-5 text-on-secondary-container transition-all hover:translate-x-1">
                <span class="material-symbols-outlined">hub</span>
                <span class="text-[15px] font-medium">Suppliers</span>
            </a>
            <a href="{{ route('client.demandes.index') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant transition-all hover:translate-x-1 hover:bg-surface-container-high">
                <span class="material-symbols-outlined">assignment</span>
                <span class="text-[15px] font-medium">Demandes</span>
            </a>
            <a href="#messages" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant transition-all hover:translate-x-1 hover:bg-surface-container-high">
                <span class="material-symbols-outlined">mail</span>
                <span class="text-[15px] font-medium">Messages</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant transition-all hover:translate-x-1 hover:bg-surface-container-high">
                <span class="material-symbols-outlined">person</span>
                <span class="text-[15px] font-medium">Profile</span>
            </a>
        </nav>

        <div class="px-8 pb-8">
            <a href="{{ route('client.demandes.index') }}" class="flex h-16 w-full items-center justify-center rounded-xl bg-primary text-base font-bold text-white shadow-lg shadow-primary/20 transition-all hover:brightness-110 active:scale-95">
                New Request
            </a>
        </div>

        <div class="border-t border-outline-variant/30 px-4 pt-6">
            <a href="{{ route('profile.edit') }}" class="flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant transition-all hover:bg-surface-container-high">
                <span class="material-symbols-outlined">settings</span>
                <span class="text-[15px] font-medium">Settings</span>
            </a>
            <a href="#" class="flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant transition-all hover:bg-surface-container-high">
                <span class="material-symbols-outlined">help</span>
                <span class="text-[15px] font-medium">Help</span>
            </a>
        </div>
    </aside>

    <header class="fixed left-[280px] right-0 top-0 z-40 flex h-20 items-center justify-between border-b border-outline-variant/20 bg-surface/90 px-10 backdrop-blur-md">
        <div class="relative w-full max-w-[720px]">
            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <input id="supplier-search" type="search" class="h-14 w-full rounded-full border-none bg-surface-container-low pl-14 pr-5 text-lg text-on-surface placeholder:text-on-surface-variant focus:ring-2 focus:ring-primary" placeholder="Search suppliers, routes, or cargo types...">
        </div>

        <div class="flex items-center gap-5">
            <button class="relative rounded-full p-2 transition hover:bg-surface-container-highest" type="button" aria-label="Notifications">
                <span class="material-symbols-outlined text-[28px] text-on-surface">notifications</span>
                <span class="absolute right-2 top-2 h-2.5 w-2.5 rounded-full bg-error ring-2 ring-surface"></span>
            </button>
            <button class="rounded-full p-2 transition hover:bg-surface-container-highest" type="button" aria-label="Messages">
                <span class="material-symbols-outlined text-[28px] text-on-surface">chat_bubble</span>
            </button>
            <button class="rounded-full p-2 transition hover:bg-surface-container-highest" type="button" aria-label="Settings">
                <span class="material-symbols-outlined text-[28px] text-on-surface">settings</span>
            </button>
            <div class="h-10 w-px bg-outline-variant/40"></div>
            <img alt="User profile" class="h-12 w-12 rounded-full border border-outline-variant object-cover" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80">
        </div>
    </header>

    <main class="ml-[280px] flex h-screen flex-col pt-20">
        <section class="flex flex-wrap items-center gap-5 border-b border-outline-variant/20 bg-surface px-10 py-8">
            @foreach ($filters as $filter)
                <button type="button" data-filter="{{ $filter['value'] }}" class="supplier-filter flex h-12 items-center gap-3 rounded-full border border-outline-variant/30 px-6 text-base font-medium transition-all active:scale-95 {{ $loop->first ? 'bg-primary-container text-white shadow-soft' : 'bg-surface-container-high text-on-surface hover:bg-surface-container-highest' }}">
                    <span class="material-symbols-outlined text-[22px]">{{ $filter['icon'] }}</span>
                    {{ $filter['label'] }}
                </button>
            @endforeach

            <div class="ml-auto flex items-center gap-3">
                <span class="text-sm font-bold text-on-surface">View:</span>
                <div class="flex rounded-xl bg-surface-container-low p-1">
                    <button id="grid-view-btn" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg bg-white text-primary shadow-sm" aria-label="Grid view">
                        <span class="material-symbols-outlined">grid_view</span>
                    </button>
                    <button id="map-view-btn" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-on-surface-variant transition hover:text-primary" aria-label="Map view">
                        <span class="material-symbols-outlined">map</span>
                    </button>
                </div>
            </div>
        </section>

        <section class="flex min-h-0 flex-1 overflow-hidden">
            <div id="list-panel" class="custom-scrollbar flex-1 overflow-y-auto p-10">
                <div id="supplier-grid" class="grid grid-cols-1 gap-8 xl:grid-cols-2">
                    @foreach ($suppliers as $supplier)
                        <article data-supplier="{{ $supplier['id'] }}" data-category="{{ $supplier['category'] }}" data-name="{{ strtolower($supplier['name'] . ' ' . $supplier['subtitle'] . ' ' . implode(' ', $supplier['tags']) . ' ' . $supplier['location']) }}" class="supplier-card rounded-[28px] border border-outline-variant/50 bg-white p-8 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-float">
                            <div class="mb-6 flex items-start justify-between gap-5">
                                <div class="flex min-w-0 items-center gap-5">
                                    <div class="flex h-[70px] w-[70px] shrink-0 items-center justify-center overflow-hidden rounded-3xl bg-surface-container-high">
                                        <img alt="{{ $supplier['name'] }} logo" class="h-full w-full object-cover" src="{{ $supplier['image'] }}">
                                    </div>
                                    <div class="min-w-0">
                                        <h2 class="text-[24px] font-extrabold leading-8 text-on-surface">{{ $supplier['name'] }}</h2>
                                        <p class="text-lg leading-7 text-on-surface">{{ $supplier['subtitle'] }}</p>
                                    </div>
                                </div>
                                <div class="shrink-0 text-right">
                                    <div class="flex items-center justify-end gap-1 text-primary">
                                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="text-lg font-extrabold">{{ $supplier['rating'] }}</span>
                                    </div>
                                    <p class="text-[11px] font-extrabold uppercase leading-4 text-outline">{{ $supplier['reviews'] }}<br>Reviews</p>
                                </div>
                            </div>

                            <div class="mb-8 flex flex-wrap gap-3">
                                @foreach ($supplier['tags'] as $tag)
                                    <span class="rounded-full border border-outline-variant/40 bg-white px-4 py-2 text-sm font-medium text-primary">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="flex items-center justify-between gap-4 border-t border-outline-variant/30 pt-6">
                                <div class="flex items-center gap-3 text-on-surface">
                                    <span class="material-symbols-outlined">location_on</span>
                                    <span class="text-lg">{{ $supplier['location'] }}</span>
                                </div>
                                <button type="button" data-open-supplier="{{ $supplier['id'] }}" class="text-lg font-extrabold text-primary underline-offset-4 hover:underline">View Detail</button>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div id="empty-suppliers" class="hidden rounded-[28px] border border-dashed border-outline-variant bg-white p-10 text-center shadow-soft">
                    <span class="material-symbols-outlined mb-3 text-4xl text-primary">search_off</span>
                    <h2 class="text-xl font-bold text-on-surface">No suppliers found</h2>
                    <p class="mt-2 text-on-surface-variant">Try another keyword or category filter.</p>
                </div>
            </div>

            <aside id="map-panel" class="relative hidden w-[450px] shrink-0 overflow-hidden border-l border-outline-variant/30 bg-slate-400 lg:block">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_35%_25%,rgba(255,255,255,0.5),transparent_32%),linear-gradient(145deg,#cbd5e1,#64748b)]"></div>
                <div class="map-lines absolute inset-0 rotate-[-12deg] scale-125 opacity-70"></div>
                <div class="absolute inset-0 bg-slate-900/10"></div>

                <div class="absolute left-8 right-8 top-8">
                    <div class="glass flex items-center justify-between rounded-3xl p-5 shadow-float">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-3xl text-primary">near_me</span>
                            <span class="text-lg font-medium text-on-surface">Searching Near Rotterdam...</span>
                        </div>
                        <button type="button" class="flex h-14 w-14 items-center justify-center rounded-xl bg-white text-primary shadow-soft transition hover:bg-surface-container-high" aria-label="Recenter">
                            <span class="material-symbols-outlined">my_location</span>
                        </button>
                    </div>
                </div>

                <button type="button" data-open-supplier="globaltrans" class="absolute left-[45%] top-[38%] flex h-14 w-14 items-center justify-center rounded-full border-4 border-white bg-secondary-container text-on-secondary-container shadow-float transition hover:scale-110" aria-label="GlobalTrans supplier pin">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
                </button>
                <button type="button" data-open-supplier="ecopack" class="absolute left-[62%] top-[62%] flex h-14 w-14 items-center justify-center rounded-full border-4 border-white bg-primary-container text-white shadow-float transition hover:scale-110" aria-label="EcoPack supplier pin">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">package_2</span>
                </button>
                <button type="button" data-open-supplier="siliconflow" class="absolute left-[28%] top-[58%] flex h-14 w-14 items-center justify-center rounded-full border-4 border-white bg-white text-primary shadow-float transition hover:scale-110" aria-label="SiliconFlow supplier pin">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">memory</span>
                </button>
                <button type="button" data-open-supplier="swiftlink" class="absolute left-[70%] top-[28%] flex h-14 w-14 items-center justify-center rounded-full border-4 border-white bg-primary text-white shadow-float transition hover:scale-110" aria-label="SwiftLink supplier pin">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">flight_takeoff</span>
                </button>

                <div class="absolute bottom-8 right-8 flex flex-col gap-3">
                    <button type="button" class="flex h-12 w-12 items-center justify-center rounded-xl border border-outline-variant/20 bg-white text-on-surface shadow-soft transition hover:bg-surface-container-high" aria-label="Zoom in">
                        <span class="material-symbols-outlined">add</span>
                    </button>
                    <button type="button" class="flex h-12 w-12 items-center justify-center rounded-xl border border-outline-variant/20 bg-white text-on-surface shadow-soft transition hover:bg-surface-container-high" aria-label="Zoom out">
                        <span class="material-symbols-outlined">remove</span>
                    </button>
                </div>
            </aside>
        </section>
    </main>

    <div class="fixed bottom-8 right-8 z-50 max-w-[520px] rounded-full border border-primary/15 bg-white/82 px-8 py-5 shadow-float backdrop-blur-xl">
        <div class="flex items-center gap-5">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified</span>
            </div>
            <p class="text-base font-medium text-on-surface">14 new suppliers added this week</p>
            <a href="#" class="ml-4 whitespace-nowrap text-base font-extrabold text-primary underline underline-offset-4">View Report</a>
        </div>
    </div>

    <div id="supplier-detail-modal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-slate-950/45 px-6 backdrop-blur-sm">
        <div class="w-full max-w-2xl rounded-[28px] border border-outline-variant/30 bg-white p-7 shadow-float">
            <div class="mb-6 flex items-start justify-between gap-5">
                <div class="flex items-center gap-5">
                    <img id="detail-image" alt="" class="h-20 w-20 rounded-3xl object-cover">
                    <div>
                        <h2 id="detail-name" class="text-2xl font-extrabold text-on-surface"></h2>
                        <p id="detail-subtitle" class="mt-1 text-base text-on-surface-variant"></p>
                    </div>
                </div>
                <button id="close-supplier-detail" type="button" class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-surface-container-low text-on-surface transition hover:bg-surface-container-high" aria-label="Close supplier details">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl bg-surface-container-low p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-outline">Rating</p>
                    <p id="detail-rating" class="mt-2 text-xl font-extrabold text-primary"></p>
                </div>
                <div class="rounded-2xl bg-surface-container-low p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-outline">Response</p>
                    <p id="detail-response" class="mt-2 text-xl font-extrabold text-on-surface"></p>
                </div>
                <div class="rounded-2xl bg-surface-container-low p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-outline">Rate</p>
                    <p id="detail-rate" class="mt-2 text-xl font-extrabold text-on-surface"></p>
                </div>
            </div>

            <div class="my-6 flex flex-wrap gap-3" id="detail-tags"></div>

            <div class="rounded-2xl border border-outline-variant/30 p-5">
                <div class="mb-4 flex items-center gap-3 text-on-surface">
                    <span class="material-symbols-outlined text-primary">location_on</span>
                    <span id="detail-location" class="text-lg font-semibold"></span>
                </div>
                <div class="flex items-center gap-3 text-on-surface">
                    <span class="material-symbols-outlined text-primary">verified</span>
                    <span id="detail-verified" class="text-lg font-semibold"></span>
                </div>
            </div>

            <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('client.demandes.index') }}" class="rounded-xl border border-outline-variant/40 px-6 py-3 text-center font-bold text-on-surface transition hover:bg-surface-container-low">Create Request</a>
                <button type="button" id="contact-supplier" class="rounded-xl bg-primary px-6 py-3 font-bold text-white shadow-lg shadow-primary/20 transition hover:brightness-110">Contact Supplier</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const supplierData = @json(collect($suppliers)->keyBy('id'));
            const filters = Array.from(document.querySelectorAll('.supplier-filter'));
            const cards = Array.from(document.querySelectorAll('.supplier-card'));
            const search = document.getElementById('supplier-search');
            const emptyState = document.getElementById('empty-suppliers');
            const listPanel = document.getElementById('list-panel');
            const mapPanel = document.getElementById('map-panel');
            const gridViewBtn = document.getElementById('grid-view-btn');
            const mapViewBtn = document.getElementById('map-view-btn');
            const detailModal = document.getElementById('supplier-detail-modal');
            const detailTags = document.getElementById('detail-tags');
            let activeFilter = 'all';

            const setView = (view) => {
                const isMap = view === 'map';
                listPanel?.classList.toggle('hidden', isMap);
                mapPanel?.classList.toggle('hidden', !isMap);
                mapPanel?.classList.toggle('lg:block', !isMap);
                mapPanel?.classList.toggle('block', isMap);
                mapPanel?.classList.toggle('w-[450px]', !isMap);
                mapPanel?.classList.toggle('w-full', isMap);
                gridViewBtn?.classList.toggle('bg-white', !isMap);
                gridViewBtn?.classList.toggle('text-primary', !isMap);
                gridViewBtn?.classList.toggle('shadow-sm', !isMap);
                mapViewBtn?.classList.toggle('bg-white', isMap);
                mapViewBtn?.classList.toggle('text-primary', isMap);
                mapViewBtn?.classList.toggle('shadow-sm', isMap);
            };

            const openSupplierDetail = (supplierId) => {
                const supplier = supplierData[supplierId];
                if (!supplier || !detailModal) return;

                document.getElementById('detail-image').src = supplier.image;
                document.getElementById('detail-image').alt = `${supplier.name} logo`;
                document.getElementById('detail-name').textContent = supplier.name;
                document.getElementById('detail-subtitle').textContent = supplier.subtitle;
                document.getElementById('detail-rating').textContent = `${supplier.rating} / 5`;
                document.getElementById('detail-response').textContent = supplier.response;
                document.getElementById('detail-rate').textContent = supplier.rate;
                document.getElementById('detail-location').textContent = supplier.location;
                document.getElementById('detail-verified').textContent = supplier.verified;
                detailTags.innerHTML = supplier.tags.map((tag) => `<span class="rounded-full border border-outline-variant/40 px-4 py-2 text-sm font-bold text-primary">${tag}</span>`).join('');
                detailModal.classList.remove('hidden');
                detailModal.classList.add('flex');
            };

            const closeSupplierDetail = () => {
                detailModal?.classList.add('hidden');
                detailModal?.classList.remove('flex');
            };

            const setActiveFilter = (button) => {
                filters.forEach((filter) => {
                    const isActive = filter === button;
                    filter.classList.toggle('bg-primary-container', isActive);
                    filter.classList.toggle('text-white', isActive);
                    filter.classList.toggle('shadow-soft', isActive);
                    filter.classList.toggle('bg-surface-container-high', !isActive);
                    filter.classList.toggle('text-on-surface', !isActive);
                    filter.classList.toggle('hover:bg-surface-container-highest', !isActive);
                });
            };

            const applyFilters = () => {
                const query = (search?.value || '').trim().toLowerCase();
                let visibleCount = 0;

                cards.forEach((card) => {
                    const matchesCategory = activeFilter === 'all' || card.dataset.category === activeFilter;
                    const matchesSearch = !query || card.dataset.name.includes(query);
                    const isVisible = matchesCategory && matchesSearch;
                    card.classList.toggle('hidden', !isVisible);
                    if (isVisible) visibleCount += 1;
                });

                emptyState?.classList.toggle('hidden', visibleCount !== 0);
            };

            filters.forEach((filter) => {
                filter.addEventListener('click', () => {
                    activeFilter = filter.dataset.filter;
                    setActiveFilter(filter);
                    applyFilters();
                });
            });

            document.querySelectorAll('[data-open-supplier]').forEach((button) => {
                button.addEventListener('click', () => openSupplierDetail(button.dataset.openSupplier));
            });

            gridViewBtn?.addEventListener('click', () => setView('grid'));
            mapViewBtn?.addEventListener('click', () => setView('map'));
            document.getElementById('close-supplier-detail')?.addEventListener('click', closeSupplierDetail);
            detailModal?.addEventListener('click', (event) => {
                if (event.target === detailModal) closeSupplierDetail();
            });
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') closeSupplierDetail();
            });
            document.getElementById('contact-supplier')?.addEventListener('click', closeSupplierDetail);
            search?.addEventListener('input', applyFilters);
            applyFilters();
        });
    </script>
</body>

</html>

