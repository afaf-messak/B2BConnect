<!DOCTYPE html>

<html class="light" lang="en">

<head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
                rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
                rel="stylesheet" />
        <style>
                .material-symbols-outlined {
                        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
                }

                body {
                        font-family: 'Geist', sans-serif;
                        background-color: #f8f9ff;
                }

                .glass-card {
                        background: rgba(255, 255, 255, 0.7);
                        backdrop-filter: blur(24px);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                }

                .map-gradient {
                        background: linear-gradient(135deg, #e5eeff 0%, #f8f9ff 100%);
                }
        </style>
        <script id="tailwind-config">
                tailwind.config = {
                        darkMode: "class",
                        theme: {
                                extend: {
                                        "colors": {
                                                "primary-fixed": "#dde1ff",
                                                "primary-container": "#1e40af",
                                                "on-secondary-container": "#003c70",
                                                "error": "#ba1a1a",
                                                "on-tertiary-fixed-variant": "#802a00",
                                                "tertiary-container": "#872d00",
                                                "surface-variant": "#d3e4fe",
                                                "primary": "#00288e",
                                                "on-error-container": "#93000a",
                                                "on-primary-fixed-variant": "#173bab",
                                                "surface-container-lowest": "#ffffff",
                                                "on-primary-fixed": "#001453",
                                                "on-tertiary-fixed": "#380d00",
                                                "secondary-container": "#64a8fe",
                                                "surface": "#f8f9ff",
                                                "surface-tint": "#3755c3",
                                                "on-secondary-fixed-variant": "#004883",
                                                "surface-container": "#e5eeff",
                                                "on-tertiary-container": "#ffa583",
                                                "on-tertiary": "#ffffff",
                                                "on-primary": "#ffffff",
                                                "secondary-fixed-dim": "#a4c9ff",
                                                "surface-container-low": "#eff4ff",
                                                "on-primary-container": "#a8b8ff",
                                                "tertiary": "#611e00",
                                                "on-error": "#ffffff",
                                                "on-secondary": "#ffffff",
                                                "secondary": "#0060ac",
                                                "tertiary-fixed-dim": "#ffb59a",
                                                "on-surface": "#0b1c30",
                                                "background": "#f8f9ff",
                                                "on-secondary-fixed": "#001c39",
                                                "inverse-surface": "#213145",
                                                "on-background": "#0b1c30",
                                                "surface-dim": "#cbdbf5",
                                                "error-container": "#ffdad6",
                                                "surface-container-high": "#dce9ff",
                                                "tertiary-fixed": "#ffdbce",
                                                "primary-fixed-dim": "#b8c4ff",
                                                "outline": "#757684",
                                                "inverse-primary": "#b8c4ff",
                                                "surface-container-highest": "#d3e4fe",
                                                "outline-variant": "#c4c5d5",
                                                "on-surface-variant": "#444653",
                                                "secondary-fixed": "#d4e3ff",
                                                "surface-bright": "#f8f9ff",
                                                "inverse-on-surface": "#eaf1ff"
                                        },
                                        "borderRadius": {
                                                "DEFAULT": "0.25rem",
                                                "lg": "0.5rem",
                                                "xl": "0.75rem",
                                                "full": "9999px"
                                        },
                                        "spacing": {
                                                "gutter": "24px",
                                                "container-max": "1440px",
                                                "unit": "8px",
                                                "margin-desktop": "40px",
                                                "margin-mobile": "16px"
                                        },
                                        "fontFamily": {
                                                "headline-lg-mobile": ["Geist"],
                                                "body-md": ["Geist"],
                                                "label-md": ["Geist"],
                                                "body-lg": ["Geist"],
                                                "headline-md": ["Geist"],
                                                "display-lg": ["Geist"],
                                                "label-sm": ["Geist"],
                                                "headline-lg": ["Geist"]
                                        },
                                        "fontSize": {
                                                "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                                                "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                                                "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                                                "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                                                "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                                                "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                                                "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                                                "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
                                        }
                                },
                        },
                }
        </script>
</head>

<body class="bg-background text-on-background">
        <!-- SideNavBar -->
        <aside
                class="fixed left-0 top-0 h-screen w-[280px] bg-surface border-r border-outline-variant/30 flex flex-col py-8 z-50">
                <div class="px-8 mb-10">
                        <h1 class="font-headline-sm text-headline-sm font-bold text-primary">SupplyLink</h1>
                        <p class="font-label-md text-label-md text-on-surface-variant">Logistics Portal</p>
                </div>
                <nav class="flex-grow">
                        <!-- Active: Dashboard -->
                        <a class="flex items-center gap-4 px-6 py-3 bg-secondary-container text-on-secondary-container rounded-xl mx-4 mb-2 hover:translate-x-1 duration-200 active:scale-[0.98] cursor-pointer"
                                href="{{ route('client.dashboard') }}">
                                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                                <span class="font-label-md text-label-md">Dashboard</span>
                        </a>
                        <!-- Inactive: My Requests (Mapped to Demandes) -->
                        <a class="flex items-center gap-4 px-6 py-3 text-on-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl hover:translate-x-1 duration-200 active:scale-[0.98] cursor-pointer"
                                href="{{ route('client.demandes.index') }}">
                                <span class="material-symbols-outlined" data-icon="assignment">assignment</span>
                                <span class="font-label-md text-label-md">My Requests</span>
                        </a>
                        <!-- Inactive: Offers Received (Mapped to Offres) -->
                        <a class="flex items-center gap-4 px-6 py-3 text-on-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl hover:translate-x-1 duration-200 active:scale-[0.98] cursor-pointer"
                                href="{{ route('client.offers.index') }}">
                                <span class="material-symbols-outlined" data-icon="local_offer">local_offer</span>
                                <span class="font-label-md text-label-md">Offers Received</span>
                        </a>
                        <!-- Inactive: Messages -->
                        <a class="flex items-center gap-4 px-6 py-3 text-on-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl hover:translate-x-1 duration-200 active:scale-[0.98] cursor-pointer"
                                href="#messages">
                                <span class="material-symbols-outlined" data-icon="mail">mail</span>
                                <span class="font-label-md text-label-md">Messages</span>
                        </a>
                        <!-- Inactive: Profile -->
                        <a class="flex items-center gap-4 px-6 py-3 text-on-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl hover:translate-x-1 duration-200 active:scale-[0.98] cursor-pointer"
                                href="{{ route('profile.edit') }}">
                                <span class="material-symbols-outlined" data-icon="person">person</span>
                                <span class="font-label-md text-label-md">Profile</span>
                        </a>
                </nav>
                <div class="mt-auto px-4 border-t border-outline-variant/20 pt-6">
                        <button onclick="window.location.href='{{ route('client.demandes.index') }}'"
                                class="w-full bg-primary text-on-primary py-3 rounded-xl font-label-md text-label-md flex justify-center items-center gap-2 hover:opacity-90 active:scale-95 transition-all mb-6 cursor-pointer">
                                <span class="material-symbols-outlined" data-icon="add">add</span>
                                New Request
                        </button>
                        <a class="flex items-center gap-4 px-6 py-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl mb-2 cursor-pointer"
                                href="{{ route('profile.edit') }}">
                                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                                <span class="font-label-md text-label-md">Settings</span>
                        </a>
                        <a class="flex items-center gap-4 px-6 py-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl cursor-pointer"
                                href="#">
                                <span class="material-symbols-outlined" data-icon="help">help</span>
                                <span class="font-label-md text-label-md">Help</span>
                        </a>
                </div>
        </aside>
        <!-- Main Content Area -->
        <main class="ml-[280px]">
                <!-- TopAppBar -->
                <header
                        class="fixed top-0 right-0 left-[280px] h-16 bg-surface/80 backdrop-blur-md border-b border-outline-variant/10 flex justify-between items-center px-8 z-40">
                        <div class="relative w-96">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-body-md"
                                        data-icon="search">search</span>
                                <input class="w-full pl-10 pr-4 py-2 bg-surface-container border-none rounded-full text-body-md focus:ring-2 focus:ring-primary outline-none"
                                        placeholder="Search orders, suppliers, or invoices..." type="text" />
                        </div>
                        <div class="flex items-center gap-4">
                                <button
                                        class="hover:bg-surface-container-highest rounded-full p-2 text-on-surface-variant active:scale-95 transition-all cursor-pointer">
                                        <span class="material-symbols-outlined"
                                                data-icon="notifications">notifications</span>
                                </button>
                                <button
                                        class="hover:bg-surface-container-highest rounded-full p-2 text-on-surface-variant active:scale-95 transition-all cursor-pointer">
                                        <span class="material-symbols-outlined"
                                                data-icon="chat_bubble">chat_bubble</span>
                                </button>
                                <div class="h-8 w-8 rounded-full overflow-hidden border border-outline-variant ml-2">
                                        <img alt="User Profile" class="w-full h-full object-cover"
                                                data-alt="A professional headshot of a corporate logistics manager in a bright, modern office setting. The lighting is soft and professional, emphasizing a clean and reliable brand image. The color palette is composed of soft whites and deep blues, aligning with the SupplyLink corporate aesthetic."
                                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDbgrkpu6yINAq4XBBfi7Kxld5XNhSYkMldQ4F9NpVt-tlzsZ0hb6KbqxRgw6y-X_HaCFr3Q1zkWbbec7_Bul8m-r2bmZxk0W_t0HqtZ-Zp-J8cyssBt4TGCBjowCCkrF-FCPDWSGt545OtUM2zC0cllxC_oY-emJGXD3v91qGR4PVSIY6iFzuoXsKQNWqXlfufzCfbi8qCD0tEtKgxF4kke84rCUjUEbOF9yMi5Bq1GJES9_dkCPkkIaDfyFrOIpMtRzgh8_ZyFVc" />
                                </div>
                        </div>
                </header>
                <div class="pt-24 pb-12 px-8 max-w-container-max mx-auto">
                        <!-- Hero Header -->
                        <div class="mb-10">
                                <h2 class="font-headline-lg text-headline-lg text-on-surface">Welcome back, Marcus</h2>
                                <p class="font-body-md text-body-md text-on-surface-variant">Here is your logistics
                                        overview for today.</p>
                        </div>
                        <!-- Stats Bento Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                                <!-- Active Requests -->
                                <div
                                        class="bg-surface-container-lowest p-8 rounded-[24px] shadow-[0_4px_20px_rgba(15,23,42,0.05)] border border-outline-variant/10 relative overflow-hidden group">
                                        <div
                                                class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                                <span class="material-symbols-outlined text-[80px]"
                                                        data-icon="local_shipping">local_shipping</span>
                                        </div>
                                        <p
                                                class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                                                Active Requests</p>
                                        <div class="flex items-end gap-3">
                                                <span class="font-display-lg text-display-lg text-primary">5</span>
                                                <span
                                                        class="font-label-md text-label-md text-primary-container bg-primary-fixed px-2 py-0.5 rounded-full mb-2">+2
                                                        today</span>
                                        </div>
                                </div>
                                <!-- Offers Received -->
                                <div
                                        class="bg-surface-container-lowest p-8 rounded-[24px] shadow-[0_4px_20px_rgba(15,23,42,0.05)] border border-outline-variant/10 relative overflow-hidden group">
                                        <div
                                                class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                                <span class="material-symbols-outlined text-[80px]"
                                                        data-icon="request_quote">request_quote</span>
                                        </div>
                                        <p
                                                class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                                                Offers Received</p>
                                        <div class="flex items-end gap-3">
                                                <span class="font-display-lg text-display-lg text-secondary">12</span>
                                                <span
                                                        class="font-label-md text-label-md text-on-secondary-container bg-secondary-fixed px-2 py-0.5 rounded-full mb-2">3
                                                        pending</span>
                                        </div>
                                </div>
                                <!-- Total Spent -->
                                <div
                                        class="bg-surface-container-lowest p-8 rounded-[24px] shadow-[0_4px_20px_rgba(15,23,42,0.05)] border border-outline-variant/10 relative overflow-hidden group">
                                        <div
                                                class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                                <span class="material-symbols-outlined text-[80px]"
                                                        data-icon="payments">payments</span>
                                        </div>
                                        <p
                                                class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                                                Total Spent (MTD)</p>
                                        <div class="flex items-end gap-3">
                                                <span
                                                        class="font-display-lg text-display-lg text-on-surface">$42,850</span>
                                                <span
                                                        class="font-label-md text-label-md text-on-tertiary-fixed-variant bg-tertiary-fixed px-2 py-0.5 rounded-full mb-2">Within
                                                        budget</span>
                                        </div>
                                </div>
                        </div>
                        <!-- Lower Layout: Map + Table -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
                                <!-- Nearby Suppliers Section (Map Component) -->
                                <div class="lg:col-span-1 flex flex-col gap-6">
                                        <div
                                                class="bg-surface-container-lowest p-6 rounded-[24px] shadow-[0_4px_20px_rgba(15,23,42,0.05)] border border-outline-variant/10 h-full">
                                                <div class="flex justify-between items-center mb-6">
                                                        <h3 class="font-headline-md text-headline-md text-on-surface">
                                                                Nearby Suppliers</h3>
                                                        <a href="{{ route('client.suppliers.index') }}"
                                                                class="text-primary font-label-md text-label-md hover:underline cursor-pointer">View
                                                                all</a>
                                                </div>
                                                <!-- Stylized Mock Map -->
                                                <div
                                                        class="relative w-full h-[400px] rounded-xl overflow-hidden map-gradient border border-outline-variant/20 mb-6">
                                                        <!-- Background Map Pattern - Simulated with Gradients/Icons -->
                                                        <div class="absolute inset-0 opacity-20 pointer-events-none"
                                                                style="background-image: radial-gradient(circle at 2px 2px, #00288e 1px, transparent 0); background-size: 24px 24px;">
                                                        </div>
                                                        <!-- Map Pins -->
                                                        <div class="absolute top-1/4 left-1/3">
                                                                <div
                                                                        class="relative flex flex-col items-center group cursor-pointer">
                                                                        <div
                                                                                class="bg-secondary p-2 rounded-full shadow-lg group-hover:scale-110 transition-transform">
                                                                                <div
                                                                                        class="w-2 h-2 bg-white rounded-full">
                                                                                </div>
                                                                        </div>
                                                                        <div
                                                                                class="absolute -top-10 bg-white px-3 py-1 rounded-lg shadow-md border border-outline-variant/20 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                                                                <p
                                                                                        class="text-label-sm text-on-surface">
                                                                                        Global Logistics Hub</p>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="absolute bottom-1/3 right-1/4">
                                                                <div
                                                                        class="relative flex flex-col items-center group cursor-pointer">
                                                                        <div
                                                                                class="bg-secondary p-2 rounded-full shadow-lg group-hover:scale-110 transition-transform">
                                                                                <div
                                                                                        class="w-2 h-2 bg-white rounded-full">
                                                                                </div>
                                                                        </div>
                                                                        <div
                                                                                class="absolute -top-10 bg-white px-3 py-1 rounded-lg shadow-md border border-outline-variant/20 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                                                                <p
                                                                                        class="text-label-sm text-on-surface">
                                                                                        Swift Freight Co.</p>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="absolute top-1/2 left-2/3">
                                                                <div
                                                                        class="relative flex flex-col items-center group cursor-pointer">
                                                                        <div
                                                                                class="bg-primary p-2 rounded-full shadow-lg animate-pulse">
                                                                                <div
                                                                                        class="w-2 h-2 bg-white rounded-full">
                                                                                </div>
                                                                        </div>
                                                                        <div
                                                                                class="absolute -top-10 bg-white px-3 py-1 rounded-lg shadow-md border border-outline-variant/20 whitespace-nowrap">
                                                                                <p
                                                                                        class="text-label-sm text-on-surface font-bold">
                                                                                        Your Location</p>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <!-- Map Actions -->
                                                        <div class="absolute bottom-4 right-4 flex flex-col gap-2">
                                                                <button
                                                                        class="bg-white p-2 rounded-lg shadow-md hover:bg-surface-container transition-colors cursor-pointer">
                                                                        <span class="material-symbols-outlined text-on-surface"
                                                                                data-icon="add">add</span>
                                                                </button>
                                                                <button
                                                                        class="bg-white p-2 rounded-lg shadow-md hover:bg-surface-container transition-colors cursor-pointer">
                                                                        <span class="material-symbols-outlined text-on-surface"
                                                                                data-icon="remove">remove</span>
                                                                </button>
                                                        </div>
                                                </div>
                                                <!-- Mini List of Map Entities -->
                                                <div class="space-y-4">
                                                        <div
                                                                class="flex items-center gap-4 p-3 hover:bg-surface-container rounded-xl transition-colors cursor-pointer border border-transparent hover:border-outline-variant/20">
                                                                <div
                                                                        class="h-10 w-10 bg-primary-fixed rounded-lg flex items-center justify-center text-primary">
                                                                        <span class="material-symbols-outlined"
                                                                                data-icon="warehouse">warehouse</span>
                                                                </div>
                                                                <div>
                                                                        <p
                                                                                class="font-label-md text-label-md text-on-surface">
                                                                                Global Logistics Hub</p>
                                                                        <p
                                                                                class="text-label-sm text-on-surface-variant">
                                                                                0.8 miles away • Highly Rated</p>
                                                                </div>
                                                        </div>
                                                        <div
                                                                class="flex items-center gap-4 p-3 hover:bg-surface-container rounded-xl transition-colors cursor-pointer border border-transparent hover:border-outline-variant/20">
                                                                <div
                                                                        class="h-10 w-10 bg-secondary-fixed rounded-lg flex items-center justify-center text-secondary">
                                                                        <span class="material-symbols-outlined"
                                                                                data-icon="local_shipping">local_shipping</span>
                                                                </div>
                                                                <div>
                                                                        <p
                                                                                class="font-label-md text-label-md text-on-surface">
                                                                                Swift Freight Co.</p>
                                                                        <p
                                                                                class="text-label-sm text-on-surface-variant">
                                                                                2.4 miles away • Active</p>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <!-- Recent Requests Table -->
                                <div class="lg:col-span-2">
                                        <div
                                                class="bg-surface-container-lowest p-8 rounded-[24px] shadow-[0_4px_20px_rgba(15,23,42,0.05)] border border-outline-variant/10 h-full">
                                                <div class="flex justify-between items-center mb-8">
                                                        <div>
                                                                <h3
                                                                        class="font-headline-md text-headline-md text-on-surface">
                                                                        Recent Requests</h3>
                                                                <p
                                                                        class="font-label-md text-label-md text-on-surface-variant">
                                                                        Track your latest logistics operations</p>
                                                        </div>
                                                        <div class="flex gap-2">
                                                                <button
                                                                        id="open-dashboard-filters"
                                                                        type="button"
                                                                        class="px-4 py-2 bg-surface-container text-on-surface-variant font-label-md text-label-md rounded-full hover:bg-surface-container-high transition-colors cursor-pointer">Filters</button>
                                                                <button
                                                                        id="export-dashboard-csv"
                                                                        type="button"
                                                                        class="px-4 py-2 bg-surface-container text-on-surface-variant font-label-md text-label-md rounded-full hover:bg-surface-container-high transition-colors cursor-pointer">Export</button>
                                                        </div>
                                                </div>
                                                <div class="overflow-x-auto">
                                                        <table id="recent-requests-table"
                                                                class="w-full text-left border-collapse">
                                                                <thead>
                                                                        <tr class="border-b border-outline-variant/20">
                                                                                <th
                                                                                        class="pb-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider px-2">
                                                                                        ID</th>
                                                                                <th
                                                                                        class="pb-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider px-2">
                                                                                        Request Title</th>
                                                                                <th
                                                                                        class="pb-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider px-2">
                                                                                        Created</th>
                                                                                <th
                                                                                        class="pb-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider px-2">
                                                                                        Offers</th>
                                                                                <th
                                                                                        class="pb-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider px-2">
                                                                                        Status</th>
                                                                                <th
                                                                                        class="pb-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider px-2">
                                                                                        Action</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody class="divide-y divide-outline-variant/10">
                                                                        <tr data-status="Reviewing" class="hover:bg-surface-container-low transition-colors group">
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface-variant">#RQ-8274</td>
                                                                                <td class="py-4 px-2">
                                                                                        <div class="flex items-center gap-3">
                                                                                                <span class="material-symbols-outlined text-secondary" data-icon="package_2">package_2</span>
                                                                                                <span class="font-label-md text-label-md text-on-surface">Electronics Wholesale Shpt</span>
                                                                                        </div>
                                                                                </td>
                                                                                <td class="py-4 px-2 font-body-md text-body-md text-on-surface-variant">Oct 24, 2023</td>
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface">4</td>
                                                                                <td class="py-4 px-2">
                                                                                        <span class="inline-flex items-center gap-1 bg-surface-container-high text-on-secondary-container px-3 py-1 rounded-full font-label-sm text-label-sm">
                                                                                                <span class="w-1.5 h-1.5 bg-secondary rounded-full"></span>Reviewing
                                                                                        </span>
                                                                                </td>
                                                                                <td class="py-4 px-2">
                                                                                        <button type="button" class="request-action-button p-2 hover:bg-surface-container-highest rounded-full transition-colors cursor-pointer" data-request-id="#RQ-8274" data-request-title="Electronics Wholesale Shpt" data-request-status="Reviewing" aria-label="Actions for Electronics Wholesale Shpt">
                                                                                                <span class="material-symbols-outlined text-on-surface-variant" data-icon="more_vert">more_vert</span>
                                                                                        </button>
                                                                                </td>
                                                                        </tr>
                                                                        <tr data-status="Active" class="hover:bg-surface-container-low transition-colors group">
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface-variant">#RQ-8269</td>
                                                                                <td class="py-4 px-2">
                                                                                        <div class="flex items-center gap-3">
                                                                                                <span class="material-symbols-outlined text-primary" data-icon="conveyor_belt">conveyor_belt</span>
                                                                                                <span class="font-label-md text-label-md text-on-surface">Raw Materials Import</span>
                                                                                        </div>
                                                                                </td>
                                                                                <td class="py-4 px-2 font-body-md text-body-md text-on-surface-variant">Oct 22, 2023</td>
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface">7</td>
                                                                                <td class="py-4 px-2">
                                                                                        <span class="inline-flex items-center gap-1 bg-primary-fixed text-primary px-3 py-1 rounded-full font-label-sm text-label-sm">
                                                                                                <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>Active
                                                                                        </span>
                                                                                </td>
                                                                                <td class="py-4 px-2">
                                                                                        <button type="button" class="request-action-button p-2 hover:bg-surface-container-highest rounded-full transition-colors cursor-pointer" data-request-id="#RQ-8269" data-request-title="Raw Materials Import" data-request-status="Active" aria-label="Actions for Raw Materials Import">
                                                                                                <span class="material-symbols-outlined text-on-surface-variant" data-icon="more_vert">more_vert</span>
                                                                                        </button>
                                                                                </td>
                                                                        </tr>
                                                                        <tr data-status="Expiring Soon" class="hover:bg-surface-container-low transition-colors group">
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface-variant">#RQ-8212</td>
                                                                                <td class="py-4 px-2">
                                                                                        <div class="flex items-center gap-3">
                                                                                                <span class="material-symbols-outlined text-error" data-icon="warning">warning</span>
                                                                                                <span class="font-label-md text-label-md text-on-surface">Urgent Parts Delivery</span>
                                                                                        </div>
                                                                                </td>
                                                                                <td class="py-4 px-2 font-body-md text-body-md text-on-surface-variant">Oct 18, 2023</td>
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface">1</td>
                                                                                <td class="py-4 px-2">
                                                                                        <span class="inline-flex items-center gap-1 bg-error-container text-on-error-container px-3 py-1 rounded-full font-label-sm text-label-sm">
                                                                                                <span class="w-1.5 h-1.5 bg-error rounded-full"></span>Expiring Soon
                                                                                        </span>
                                                                                </td>
                                                                                <td class="py-4 px-2">
                                                                                        <button type="button" class="request-action-button p-2 hover:bg-surface-container-highest rounded-full transition-colors cursor-pointer" data-request-id="#RQ-8212" data-request-title="Urgent Parts Delivery" data-request-status="Expiring Soon" aria-label="Actions for Urgent Parts Delivery">
                                                                                                <span class="material-symbols-outlined text-on-surface-variant" data-icon="more_vert">more_vert</span>
                                                                                        </button>
                                                                                </td>
                                                                        </tr>
                                                                        <tr data-status="Completed" class="hover:bg-surface-container-low transition-colors group">
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface-variant">#RQ-8199</td>
                                                                                <td class="py-4 px-2">
                                                                                        <div class="flex items-center gap-3">
                                                                                                <span class="material-symbols-outlined text-outline" data-icon="check_circle">check_circle</span>
                                                                                                <span class="font-label-md text-label-md text-on-surface">Standard Supply Chain</span>
                                                                                        </div>
                                                                                </td>
                                                                                <td class="py-4 px-2 font-body-md text-body-md text-on-surface-variant">Oct 15, 2023</td>
                                                                                <td class="py-4 px-2 font-label-md text-label-md text-on-surface">12</td>
                                                                                <td class="py-4 px-2">
                                                                                        <span class="inline-flex items-center gap-1 bg-surface-container text-on-surface-variant px-3 py-1 rounded-full font-label-sm text-label-sm">
                                                                                                <span class="w-1.5 h-1.5 bg-outline rounded-full"></span>Completed
                                                                                        </span>
                                                                                </td>
                                                                                <td class="py-4 px-2">
                                                                                        <button type="button" class="request-action-button p-2 hover:bg-surface-container-highest rounded-full transition-colors cursor-pointer" data-request-id="#RQ-8199" data-request-title="Standard Supply Chain" data-request-status="Completed" aria-label="Actions for Standard Supply Chain">
                                                                                                <span class="material-symbols-outlined text-on-surface-variant" data-icon="more_vert">more_vert</span>
                                                                                        </button>
                                                                                </td>
                                                                        </tr>
                                                                </tbody>
                                                        </table>
                                                </div>
                                                <div
                                                        class="mt-8 pt-6 border-t border-outline-variant/10 flex justify-between items-center">
                                                        <span id="requests-count-label"
                                                                class="font-label-sm text-label-sm text-on-surface-variant">Showing
                                                                4 of 24 requests</span>
                                                        <div class="flex gap-2">
                                                                <button
                                                                        class="h-10 w-10 border border-outline-variant/20 rounded-lg flex items-center justify-center hover:bg-surface-container-low transition-all cursor-pointer">
                                                                        <span class="material-symbols-outlined"
                                                                                data-icon="chevron_left">chevron_left</span>
                                                                </button>
                                                                <button
                                                                        class="h-10 w-10 bg-primary text-on-primary rounded-lg font-label-md text-label-md cursor-pointer">1</button>
                                                                <button
                                                                        class="h-10 w-10 border border-outline-variant/20 rounded-lg flex items-center justify-center hover:bg-surface-container-low transition-all cursor-pointer">
                                                                        <span class="material-symbols-outlined"
                                                                                data-icon="chevron_right">chevron_right</span>
                                                                </button>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <!-- Footer -->
                <footer class="relative w-full bg-surface-container-low border-t border-outline-variant/50 pt-12 pb-8">
                        <div
                                class="grid grid-cols-1 md:grid-cols-4 gap-8 px-margin-desktop max-w-container-max mx-auto mb-8">
                                <div class="col-span-1">
                                        <h3 class="font-headline-sm text-headline-sm text-primary mb-4">SupplyLink</h3>
                                        <p class="font-label-sm text-label-sm text-on-surface-variant">The future of B2B
                                                logistics and intelligent supplier management.</p>
                                </div>
                                <div class="col-span-1">
                                        <h4 class="font-label-md text-label-md text-on-surface font-bold mb-4">Product
                                        </h4>
                                        <ul class="space-y-2">
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer"
                                                                href="#">Analytics</a></li>
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer"
                                                                href="#">Integrations</a></li>
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer"
                                                                href="#">Enterprise</a></li>
                                        </ul>
                                </div>
                                <div class="col-span-1">
                                        <h4 class="font-label-md text-label-md text-on-surface font-bold mb-4">Company
                                        </h4>
                                        <ul class="space-y-2">
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer"
                                                                href="#">About Us</a></li>
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer"
                                                                href="#">Careers</a></li>
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer"
                                                                href="#">Contact</a></li>
                                        </ul>
                                </div>
                                <div class="col-span-1">
                                        <h4 class="font-label-md text-label-md text-on-surface font-bold mb-4">Legal
                                        </h4>
                                        <ul class="space-y-2">
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors underline underline-offset-4 cursor-pointer"
                                                                href="#">Privacy Policy</a></li>
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors underline underline-offset-4 cursor-pointer"
                                                                href="#">Terms of Service</a></li>
                                                <li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors underline underline-offset-4 cursor-pointer"
                                                                href="#">Security</a></li>
                                        </ul>
                                </div>
                        </div>
                        <div
                                class="px-margin-desktop max-w-container-max mx-auto pt-8 border-t border-outline-variant/20 flex justify-between items-center">
                                <p class="font-label-sm text-label-sm text-on-surface-variant">© 2024 SupplyLink
                                        Logistics. All rights reserved.</p>
                                <div class="flex gap-4">
                                        <span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-primary transition-colors"
                                                data-icon="public">public</span>
                                        <span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-primary transition-colors"
                                                data-icon="lan">lan</span>
                                </div>
                        </div>
                </footer>
        </main>
        <div id="dashboard-filter-panel"
                class="fixed inset-0 z-50 hidden items-center justify-center bg-scrim/40 px-4">
                <div class="w-full max-w-md rounded-[24px] bg-surface-container-lowest p-6 shadow-[0_20px_60px_rgba(15,23,42,0.18)] border border-outline-variant/20">
                        <div class="mb-5 flex items-center justify-between">
                                <div>
                                        <h3 class="font-headline-sm text-headline-sm text-on-surface">Filter requests</h3>
                                        <p class="font-label-sm text-label-sm text-on-surface-variant">Choose the statuses to show.</p>
                                </div>
                                <button type="button" id="close-dashboard-filters"
                                        class="h-10 w-10 rounded-full hover:bg-surface-container-high flex items-center justify-center">
                                        <span class="material-symbols-outlined" data-icon="close">close</span>
                                </button>
                        </div>
                        <div class="space-y-3">
                                <label class="flex items-center justify-between rounded-2xl border border-outline-variant/20 px-4 py-3">
                                        <span class="font-label-md text-label-md text-on-surface">Reviewing</span>
                                        <input type="checkbox" class="dashboard-status-filter h-5 w-5 accent-primary" value="Reviewing" checked>
                                </label>
                                <label class="flex items-center justify-between rounded-2xl border border-outline-variant/20 px-4 py-3">
                                        <span class="font-label-md text-label-md text-on-surface">Active</span>
                                        <input type="checkbox" class="dashboard-status-filter h-5 w-5 accent-primary" value="Active" checked>
                                </label>
                                <label class="flex items-center justify-between rounded-2xl border border-outline-variant/20 px-4 py-3">
                                        <span class="font-label-md text-label-md text-on-surface">Expiring Soon</span>
                                        <input type="checkbox" class="dashboard-status-filter h-5 w-5 accent-primary" value="Expiring Soon" checked>
                                </label>
                                <label class="flex items-center justify-between rounded-2xl border border-outline-variant/20 px-4 py-3">
                                        <span class="font-label-md text-label-md text-on-surface">Completed</span>
                                        <input type="checkbox" class="dashboard-status-filter h-5 w-5 accent-primary" value="Completed" checked>
                                </label>
                        </div>
                        <div class="mt-6 flex gap-3">
                                <button type="button" id="reset-dashboard-filters"
                                        class="flex-1 rounded-full border border-outline-variant/30 px-4 py-3 font-label-md text-label-md text-on-surface hover:bg-surface-container">
                                        Reset
                                </button>
                                <button type="button" id="apply-dashboard-filters"
                                        class="flex-1 rounded-full bg-primary px-4 py-3 font-label-md text-label-md text-on-primary shadow-elevation-2 hover:brightness-110">
                                        Apply
                                </button>
                        </div>
                </div>
        </div>
        <div id="request-action-menu"
                class="fixed z-50 hidden w-56 rounded-2xl border border-outline-variant/20 bg-surface-container-lowest p-2 shadow-[0_18px_45px_rgba(15,23,42,0.18)]">
                <p id="request-action-menu-title" class="px-3 py-2 font-label-sm text-label-sm text-on-surface-variant"></p>
                <button type="button" data-menu-action="open"
                        class="w-full rounded-xl px-3 py-2 text-left font-label-md text-label-md text-on-surface hover:bg-surface-container">Open details</button>
                <button type="button" data-menu-action="offers"
                        class="w-full rounded-xl px-3 py-2 text-left font-label-md text-label-md text-on-surface hover:bg-surface-container">View offers</button>
                <button type="button" data-menu-action="duplicate"
                        class="w-full rounded-xl px-3 py-2 text-left font-label-md text-label-md text-on-surface hover:bg-surface-container">Duplicate request</button>
                <button type="button" data-menu-action="archive"
                        class="w-full rounded-xl px-3 py-2 text-left font-label-md text-label-md text-error hover:bg-error-container">Archive</button>
        </div>
        <div id="dashboard-toast"
                class="fixed bottom-6 right-6 z-50 hidden max-w-sm rounded-2xl bg-on-surface px-5 py-3 font-label-md text-label-md text-surface shadow-[0_14px_40px_rgba(15,23,42,0.25)]">
        </div>
        <script>
                document.addEventListener('DOMContentLoaded', () => {
                        const table = document.getElementById('recent-requests-table');
                        const rows = table ? Array.from(table.querySelectorAll('tbody tr[data-status]')) : [];
                        const filterPanel = document.getElementById('dashboard-filter-panel');
                        const filterChecks = Array.from(document.querySelectorAll('.dashboard-status-filter'));
                        const countLabel = document.getElementById('requests-count-label');
                        const actionMenu = document.getElementById('request-action-menu');
                        const actionMenuTitle = document.getElementById('request-action-menu-title');
                        const toast = document.getElementById('dashboard-toast');
                        let activeRequest = null;
                        let toastTimer = null;

                        const showToast = (message) => {
                                if (!toast) return;
                                toast.textContent = message;
                                toast.classList.remove('hidden');
                                clearTimeout(toastTimer);
                                toastTimer = setTimeout(() => toast.classList.add('hidden'), 2600);
                        };

                        const setFilterPanel = (isOpen) => {
                                if (!filterPanel) return;
                                filterPanel.classList.toggle('hidden', !isOpen);
                                filterPanel.classList.toggle('flex', isOpen);
                        };

                        const updateCount = () => {
                                const visible = rows.filter((row) => !row.classList.contains('hidden')).length;
                                if (countLabel) {
                                        countLabel.textContent = `Showing ${visible} of 24 requests`;
                                }
                        };

                        const applyFilters = () => {
                                const selected = new Set(filterChecks.filter((check) => check.checked).map((check) => check.value));
                                rows.forEach((row) => {
                                        const shouldShow = selected.size === 0 || selected.has(row.dataset.status);
                                        row.classList.toggle('hidden', !shouldShow);
                                });
                                updateCount();
                                setFilterPanel(false);
                        };

                        const exportCsv = () => {
                                if (!table) return;
                                const headers = Array.from(table.querySelectorAll('thead th'))
                                        .slice(0, 5)
                                        .map((cell) => cell.textContent.trim());
                                const body = rows
                                        .filter((row) => !row.classList.contains('hidden'))
                                        .map((row) => Array.from(row.children).slice(0, 5).map((cell) => cell.textContent.replace(/\s+/g, ' ').trim()));
                                const csv = [headers, ...body]
                                        .map((line) => line.map((value) => `"${value.replace(/"/g, '""')}"`).join(','))
                                        .join('\n');
                                const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                                const link = document.createElement('a');
                                link.href = URL.createObjectURL(blob);
                                link.download = 'recent-requests.csv';
                                link.click();
                                URL.revokeObjectURL(link.href);
                                showToast('CSV exported');
                        };

                        const hideActionMenu = () => {
                                if (actionMenu) actionMenu.classList.add('hidden');
                        };

                        document.getElementById('open-dashboard-filters')?.addEventListener('click', () => setFilterPanel(true));
                        document.getElementById('close-dashboard-filters')?.addEventListener('click', () => setFilterPanel(false));
                        document.getElementById('apply-dashboard-filters')?.addEventListener('click', applyFilters);
                        document.getElementById('reset-dashboard-filters')?.addEventListener('click', () => {
                                filterChecks.forEach((check) => check.checked = true);
                                applyFilters();
                        });
                        filterPanel?.addEventListener('click', (event) => {
                                if (event.target === filterPanel) setFilterPanel(false);
                        });
                        document.getElementById('export-dashboard-csv')?.addEventListener('click', exportCsv);

                        document.querySelectorAll('.request-action-button').forEach((button) => {
                                button.addEventListener('click', (event) => {
                                        event.stopPropagation();
                                        activeRequest = {
                                                id: button.dataset.requestId,
                                                title: button.dataset.requestTitle,
                                                status: button.dataset.requestStatus
                                        };
                                        if (!actionMenu) return;
                                        const rect = button.getBoundingClientRect();
                                        actionMenuTitle.textContent = `${activeRequest.id} - ${activeRequest.status}`;
                                        actionMenu.style.top = `${Math.max(12, Math.min(rect.bottom + 8, window.innerHeight - 230))}px`;
                                        actionMenu.style.left = `${Math.max(12, Math.min(rect.left - 190, window.innerWidth - 240))}px`;
                                        actionMenu.classList.remove('hidden');
                                });
                        });

                        actionMenu?.addEventListener('click', (event) => {
                                const button = event.target.closest('[data-menu-action]');
                                if (!button || !activeRequest) return;
                                const action = button.dataset.menuAction;
                                hideActionMenu();
                                if (action === 'open') {
                                        window.location.href = "{{ route('client.demandes.index') }}";
                                        return;
                                }
                                if (action === 'offers') {
                                        window.location.href = "{{ route('client.offers.index') }}";
                                        return;
                                }
                                const labels = {
                                        duplicate: 'Request duplicated',
                                        archive: 'Request archived'
                                };
                                showToast(`${labels[action]}: ${activeRequest.title}`);
                        });

                        document.addEventListener('click', (event) => {
                                if (!actionMenu || actionMenu.contains(event.target)) return;
                                hideActionMenu();
                        });

                        updateCount();
                });
        </script>
</body>

</html>

