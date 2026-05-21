<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>SupplyLink Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
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
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
        }
    </style>
</head>
<body class="text-on-background bg-background">
<!-- SideNavBar Anchor -->
<aside class="fixed left-0 top-0 h-screen w-[280px] bg-surface border-r border-outline-variant/30 flex flex-col h-full py-8 z-50">
<div class="px-8 mb-10 flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center">
<span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">hub</span>
</div>
<div>
<h1 class="font-headline-sm text-headline-sm font-bold text-primary">SupplyLink</h1>
<p class="font-label-md text-label-md text-on-surface-variant opacity-70">Logistics Portal</p>
</div>
</div>
<nav class="flex-1 space-y-1">
<a class="flex items-center gap-4 py-3 px-4 mx-4 mb-2 bg-secondary-container text-on-secondary-container rounded-xl transition-all duration-200 active:scale-[0.98]" href="{{ route('admin.dashboard') }}">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 mx-4 mb-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl hover:translate-x-1 duration-200 transition-all active:scale-[0.98]" href="{{ route('admin.users') }}">
<span class="material-symbols-outlined">group</span>
<span class="font-label-md text-label-md">Users</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 mx-4 mb-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl hover:translate-x-1 duration-200 transition-all active:scale-[0.98]" href="{{ route('admin.demandes') }}">
<span class="material-symbols-outlined">assignment</span>
<span class="font-label-md text-label-md">Demandes</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 mx-4 mb-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl hover:translate-x-1 duration-200 transition-all active:scale-[0.98]" href="{{ route('admin.offers') }}">
<span class="material-symbols-outlined">request_quote</span>
<span class="font-label-md text-label-md">Offers</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 mx-4 mb-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl hover:translate-x-1 duration-200 transition-all active:scale-[0.98]" href="{{ route('admin.moderation') }}">
<span class="material-symbols-outlined">gavel</span>
<span class="font-label-md text-label-md">Moderation</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 mx-4 mb-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl hover:translate-x-1 duration-200 transition-all active:scale-[0.98]" href="{{ route('admin.logs') }}">
<span class="material-symbols-outlined">list_alt</span>
<span class="font-label-md text-label-md">System Logs</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 mx-4 mb-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl hover:translate-x-1 duration-200 transition-all active:scale-[0.98]" href="{{ route('admin.messages') }}">
<span class="material-symbols-outlined">mail</span>
<span class="font-label-md text-label-md">Messages</span>
</a>
</nav>
<div class="px-4 mt-auto border-t border-outline-variant/10 pt-6 space-y-1">
<a class="flex items-center gap-4 py-3 px-4 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all hover:translate-x-1" href="{{ route('admin.settings') }}">
<span class="material-symbols-outlined">settings</span>
<span class="font-label-md text-label-md">Settings</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all hover:translate-x-1" href="#">
<span class="material-symbols-outlined">help</span>
<span class="font-label-md text-label-md">Help</span>
</a>
</div>
</aside>
<!-- TopAppBar Anchor -->
<header class="fixed top-0 right-0 left-[280px] z-40 bg-surface/80 backdrop-blur-md border-b border-outline-variant/10 flex justify-between items-center h-16 px-8">
<div class="flex items-center flex-1 max-w-xl">
<div class="relative w-full group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant opacity-60">search</span>
<input class="w-full bg-surface-container-low border-none rounded-full py-2 pl-10 pr-4 focus:ring-2 focus:ring-primary font-body-md text-body-md transition-all duration-200" placeholder="Search resources, users or logs..." type="text"/>
</div>
</div>
<div class="flex items-center gap-2">
<button class="hover:bg-surface-container-highest rounded-full p-2 transition-all duration-200">
<span class="material-symbols-outlined text-on-surface-variant">notifications</span>
</button>
<button class="hover:bg-surface-container-highest rounded-full p-2 transition-all duration-200">
<span class="material-symbols-outlined text-on-surface-variant">chat_bubble</span>
</button>
<button class="hover:bg-surface-container-highest rounded-full p-2 transition-all duration-200 mr-4">
<span class="material-symbols-outlined text-on-surface-variant">settings</span>
</button>
<div class="h-8 w-px bg-outline-variant/30 mr-4"></div>
<div class="flex items-center gap-3">
<div class="text-right hidden xl:block">
<p class="font-label-md text-label-md text-on-surface font-bold">Admin User</p>
<p class="font-label-sm text-label-sm text-on-surface-variant opacity-70">Super Admin</p>
</div>
<img alt="User Profile" class="w-10 h-10 rounded-full border border-primary-fixed" data-alt="A professional headshot of a middle-aged man with a clean-cut beard and confident expression. He is wearing a minimalist navy blue blazer against a soft, out-of-focus modern office background. The lighting is bright and airy, consistent with a premium corporate light-mode dashboard aesthetic, highlighting subtle blue and white tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBem56LUs15Mzt9waln5vWyGH2-IRptUokFDISw0sX5adAnpBfjK3pDBQphU5Pd_yto3DrODcw9dUvPnkah0fi_eQxAbSQtxcAm91U18Q2kakUE06as7itfnqk0Prk6k463k6nGom61geqBG5v7rZqwMtYiGKQ5-q1Yyo_qSkpOYGIYr5w3-LhdIvAEjZKZ3z0gShfuBF3FUTO4axXRojBjv74tBhFdAyPTkmcHbfZqfpVufBRsBWqMqTsl8YPPWEqZLYaZTrEG_r8"/>
</div>
</div>
</header>
<!-- Main Content -->
<main class="ml-[280px] pt-24 px-8 pb-12 min-h-screen">
<!-- Dashboard Header -->
<div class="mb-8 flex justify-between items-end">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Administrative Overview</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Real-time logistics ecosystem monitoring and control.</p>
</div>
<div class="flex gap-4">
<button class="px-6 py-2.5 bg-surface-container border border-outline-variant/30 rounded-xl font-label-md text-label-md text-on-surface hover:bg-surface-container-high transition-all">
                    Generate Report
                </button>
<button class="px-6 py-2.5 bg-primary text-white rounded-xl font-label-md text-label-md hover:opacity-90 transition-all flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]">add</span>
                    New Request
                </button>
</div>
</div>
<!-- Bento Grid Stats Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-gutter">
<!-- Stat Card 1 -->
<div class="bg-white rounded-[24px] p-8 border border-outline-variant/30 shadow-sm relative overflow-hidden group">
<div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
<div class="flex justify-between items-start relative z-10">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total Users</p>
<h3 class="font-display-lg text-display-lg text-on-surface mt-2">1.2k</h3>
<p class="font-label-sm text-label-sm text-primary mt-2 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">trending_up</span>
                            +12% this month
                        </p>
</div>
<div class="w-12 h-12 rounded-2xl bg-primary-fixed flex items-center justify-center text-primary">
<span class="material-symbols-outlined">group</span>
</div>
</div>
</div>
<!-- Stat Card 2 -->
<div class="bg-white rounded-[24px] p-8 border border-outline-variant/30 shadow-sm relative overflow-hidden group">
<div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
<div class="flex justify-between items-start relative z-10">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Active Requests</p>
<h3 class="font-display-lg text-display-lg text-on-surface mt-2">450</h3>
<p class="font-label-sm text-label-sm text-on-secondary-fixed-variant mt-2 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">schedule</span>
                            98.2% on schedule
                        </p>
</div>
<div class="w-12 h-12 rounded-2xl bg-secondary-fixed flex items-center justify-center text-secondary">
<span class="material-symbols-outlined">local_shipping</span>
</div>
</div>
</div>
<!-- Stat Card 3 -->
<div class="bg-white rounded-[24px] p-8 border border-outline-variant/30 shadow-sm relative overflow-hidden group">
<div class="absolute top-0 right-0 w-32 h-32 bg-tertiary/5 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
<div class="flex justify-between items-start relative z-10">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Revenue Share</p>
<h3 class="font-display-lg text-display-lg text-on-surface mt-2">14.8%</h3>
<div class="w-32 h-2 bg-surface-container mt-4 rounded-full overflow-hidden">
<div class="w-[14.8%] h-full bg-primary transition-all duration-500"></div>
</div>
</div>
<div class="w-12 h-12 rounded-2xl bg-tertiary-fixed flex items-center justify-center text-tertiary">
<span class="material-symbols-outlined">payments</span>
</div>
</div>
</div>
</div>
<!-- Main Dashboard Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Moderation Panel -->
<section class="lg:col-span-8">
<div class="bg-white rounded-[24px] border border-outline-variant/30 shadow-sm overflow-hidden flex flex-col h-full">
<div class="px-8 py-6 border-b border-outline-variant/20 flex justify-between items-center">
<div>
<h4 class="font-headline-md text-headline-md text-on-surface">Moderation Queue</h4>
<p class="font-label-md text-label-md text-on-surface-variant opacity-70">Review flagged shipments and user escalations</p>
</div>
<span class="px-3 py-1 bg-error-container text-on-error-container rounded-full text-[12px] font-bold">12 Urgent</span>
</div>
<div class="divide-y divide-outline-variant/10">
<!-- Flagged Item 1 -->
<div class="px-8 py-6 hover:bg-surface-container-lowest transition-all group">
<div class="flex items-start gap-6">
<div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
<img alt="Flagged User" class="w-full h-full object-cover" data-alt="A portrait of a young professional woman with a serious but calm expression. She is wearing a modern grey blazer in a brightly lit, clean studio setting. The photograph uses a shallow depth of field, with a cool-toned, high-end commercial aesthetic featuring subtle blue highlights and clean white backgrounds." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMsFuSUe1Rdd1KMhJGzsWuPryHhppaf8Ss2ZWYbrHs98Omh961PwUpwccEOtEhLC_gWzNM0Qj9Jzf9nigxXoHoLYQiVQUJUCF1eEPuTu9YOBF2C0JDvMpaLoP39BLt-ewC66E91OnHpv2IJ6Lz0Hx0MqXXYIkwwjxeq97D40STjl0WtJlpv-BuCGU6e9giRg_OjA-_Kg8E4YMPDFttGksjRTnYE7iDS7zMKGQogJtILHkXi6Zp5SYmp39CiEY3pcfOw7nrvKjDU_k"/>
</div>
<div class="flex-1">
<div class="flex justify-between items-start">
<div>
<h5 class="font-body-lg text-body-lg font-bold text-on-surface">Elena Rodriguez</h5>
<p class="font-label-sm text-label-sm text-on-surface-variant opacity-60">ID: SL-992384 • Priority: High</p>
</div>
<div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all">
<button class="w-9 h-9 rounded-full bg-surface-container text-on-surface hover:bg-surface-container-highest flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">check</span>
</button>
<button class="w-9 h-9 rounded-full bg-error-container text-on-error-container hover:opacity-80 flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">block</span>
</button>
</div>
</div>
<p class="font-body-md text-body-md text-on-surface mt-2 bg-surface-container-low p-4 rounded-xl border-l-4 border-error">
                                        "Duplicate shipping labels detected for cross-border route MX-449. Potential system abuse or API error reported by customs automated gate."
                                    </p>
<div class="mt-4 flex gap-4 text-on-surface-variant font-label-sm text-label-sm">
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 14 mins ago</span>
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">category</span> Fraud Detection</span>
</div>
</div>
</div>
</div>
<!-- Flagged Item 2 -->
<div class="px-8 py-6 hover:bg-surface-container-lowest transition-all group">
<div class="flex items-start gap-6">
<div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container flex-shrink-0">
<span class="material-symbols-outlined">package_2</span>
</div>
<div class="flex-1">
<div class="flex justify-between items-start">
<div>
<h5 class="font-body-lg text-body-lg font-bold text-on-surface">Route Discrepancy: #RT-0021</h5>
<p class="font-label-sm text-label-sm text-on-surface-variant opacity-60">Sender: Global Logistics Inc. • Priority: Medium</p>
</div>
<div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all">
<button class="w-9 h-9 rounded-full bg-surface-container text-on-surface hover:bg-surface-container-highest flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">check</span>
</button>
<button class="w-9 h-9 rounded-full bg-error-container text-on-error-container hover:opacity-80 flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">visibility_off</span>
</button>
</div>
</div>
<p class="font-body-md text-body-md text-on-surface mt-2">
                                        Carrier reported route deviation exceeding 40km from planned logistics corridor without prior traffic notification.
                                    </p>
<div class="mt-4 flex gap-4 text-on-surface-variant font-label-sm text-label-sm">
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 2 hours ago</span>
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">map</span> Deviation Alert</span>
</div>
</div>
</div>
</div>
</div>
<div class="mt-auto p-6 bg-surface-container-low text-center">
<button class="font-label-md text-label-md text-primary font-bold hover:underline">View All Flagged Requests (42)</button>
</div>
</div>
</section>
<!-- New Registrations Sidebar -->
<section class="lg:col-span-4">
<div class="glass-card rounded-[24px] p-8 h-full">
<h4 class="font-headline-md text-headline-md text-on-surface mb-6">New User Registrations</h4>
<div class="space-y-6">
<!-- User Registration 1 -->
<div class="flex items-center gap-4">
<div class="relative">
<img alt="New User" class="w-12 h-12 rounded-xl object-cover" data-alt="A portrait of a smiling young man wearing a light blue polo shirt, suggesting a friendly and approachable corporate professional. He is in a brightly lit modern environment with high-key lighting. The aesthetic is clean and minimal, emphasizing a welcoming user experience with soft blue and white color palette." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHyBEJF5lOZ887O60YD1CRlz-g9ZGVqIW8IJ34rWPL3KkY46GfuFaYHHRjV01MHMkJCXxzaBjDX_TXm1-WEzKELb8EEXC4EMDIwB-jKIXZCVVSaCVPtLkuDbRGE35mySobbJ0vIIcPyZOwwi4-SH6wtkS_p8Vs0wBCts-r9_6QofQ2vZxat3oMt5x56ZUFkuCqHKvFNm4wsI-aYauKs1cX-pMvYpOoIyK4GbGaAit4dhJgd4gK0l2d82jvzQv5bXPwhK3qvndYpmk"/>
<div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
</div>
<div class="flex-1">
<h5 class="font-label-md text-label-md font-bold text-on-surface">Marcus T.</h5>
<p class="font-label-sm text-label-sm text-on-surface-variant">Independent Contractor</p>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant opacity-60">Just now</span>
</div>
<!-- User Registration 2 -->
<div class="flex items-center gap-4">
<div class="relative">
<img alt="New User" class="w-12 h-12 rounded-xl object-cover" data-alt="A vibrant and professional portrait of a woman with a bright smile, wearing a professional white top. The background is a clean, minimal gradient of soft blues. The lighting is flattering and high-key, creating a visionary and reliable corporate feel suitable for a high-end logistics dashboard platform." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCt70XZjNzdee4U2s9tzTRngSHBYEXOW7coERR0khTF_7mGYDnjbIVh44qKRAfPxHZWFi5TYVJOwdUwUGJT441QU2cjn_ekLWYPtBHvFc3bBsZ89NNC2GRixglR7OMzavR20SUwSMLUy-7Do6mP7Mf58aBRnnk2ry6n8PVa6WXOflBK_hE_1s04rylHys17omRMMUgDtjxq5dmlSOjextJhsnprq8ku0QTQDduFeeYeGvRNuMGtRnmCd2mpygnvZoLjqOU63sE8h-c"/>
<div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
</div>
<div class="flex-1">
<h5 class="font-label-md text-label-md font-bold text-on-surface">Sarah J.</h5>
<p class="font-label-sm text-label-sm text-on-surface-variant">Fleet Manager</p>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant opacity-60">12m ago</span>
</div>
<!-- User Registration 3 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center">
<span class="material-symbols-outlined">business</span>
</div>
<div class="flex-1">
<h5 class="font-label-md text-label-md font-bold text-on-surface">SwiftTrans Ltd.</h5>
<p class="font-label-sm text-label-sm text-on-surface-variant">B2B Supplier</p>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant opacity-60">45m ago</span>
</div>
</div>
<div class="mt-10 p-6 bg-primary/5 rounded-2xl border border-primary/10">
<div class="flex items-center gap-3 mb-4">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">insights</span>
<h6 class="font-label-md text-label-md font-bold text-primary">Conversion Insight</h6>
</div>
<p class="font-label-sm text-label-sm text-on-surface-variant leading-relaxed">
                            Registration conversion is up <span class="text-primary font-bold">18.4%</span> since the new onboarding flow launched.
                        </p>
</div>
<button class="w-full mt-6 py-3 border border-outline-variant/30 rounded-xl font-label-md text-label-md text-on-surface hover:bg-surface-container-high transition-all">
                        Approve All Pending
                    </button>
</div>
</section>
</div>
<!-- System Logs Activity Asymmetric Section -->
<div class="mt-gutter">
<div class="bg-inverse-surface rounded-[24px] p-10 text-inverse-on-surface relative overflow-hidden">
<div class="absolute top-0 right-0 p-12 opacity-10">
<span class="material-symbols-outlined text-[160px]">terminal</span>
</div>
<div class="relative z-10">
<div class="flex items-center gap-4 mb-8">
<div class="w-2 h-2 rounded-full bg-primary-fixed-dim animate-pulse"></div>
<h4 class="font-headline-md text-headline-md">Live System Logs</h4>
</div>
<div class="space-y-4 max-w-4xl font-mono text-[13px] opacity-80">
<div class="flex gap-4">
<span class="text-primary-fixed-dim shrink-0">[14:22:01]</span>
<span class="text-surface-variant">INFO: Webhook received from Carrier-API-12. Processing payload...</span>
</div>
<div class="flex gap-4">
<span class="text-primary-fixed-dim shrink-0">[14:22:05]</span>
<span class="text-surface-variant">SUCCESS: DB transaction committed for Shipment #RT-4412.</span>
</div>
<div class="flex gap-4">
<span class="text-primary-fixed-dim shrink-0">[14:24:12]</span>
<span class="text-error-container">WARN: Latency spike detected in US-EAST region (240ms). Auto-scaling initiated.</span>
</div>
<div class="flex gap-4">
<span class="text-primary-fixed-dim shrink-0">[14:25:00]</span>
<span class="text-surface-variant">INFO: User authentication successful for ID-8829 (Moderator).</span>
</div>
</div>
<button class="mt-8 flex items-center gap-2 text-primary-fixed-dim font-label-md text-label-md hover:underline">
                        Open Full Console
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
</button>
</div>
</div>
</div>
</main>
<!-- Footer Anchor -->
<footer class="ml-[280px] bg-surface-container-low border-t border-outline-variant/50 relative w-full">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 py-12 px-8 max-w-container-max mx-auto">
<div>
<h2 class="font-headline-sm text-headline-sm text-primary font-bold">SupplyLink</h2>
<p class="font-label-sm text-label-sm text-on-surface-variant mt-4 leading-relaxed">
                    © 2024 SupplyLink Logistics. All rights reserved. Precision in every connection.
                </p>
</div>
<div>
<h5 class="font-label-md text-label-md font-bold text-on-surface mb-4">Platform</h5>
<ul class="space-y-2">
<li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors duration-300" href="#">Privacy Policy</a></li>
<li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors duration-300" href="#">Terms of Service</a></li>
</ul>
</div>
<div>
<h5 class="font-label-md text-label-md font-bold text-on-surface mb-4">Support</h5>
<ul class="space-y-2">
<li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors duration-300" href="#">Security</a></li>
<li><a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors duration-300" href="#">Contact</a></li>
</ul>
</div>
<div>
<h5 class="font-label-md text-label-md font-bold text-on-surface mb-4">Quick Actions</h5>
<button class="w-full py-2 bg-primary text-white rounded-lg font-label-sm text-label-sm hover:opacity-90 transition-all">
                    Emergency Protocol
                </button>
</div>
</div>
</footer>
</body></html>
