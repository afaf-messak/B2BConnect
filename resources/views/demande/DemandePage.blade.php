<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
        body {
            background-color: #f8f9ff;
            color: #0b1c30;
            font-family: 'Geist', sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body id="top" class="bg-surface font-body-md text-body-md overflow-x-hidden">
<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-screen w-[280px] bg-surface dark:bg-surface-dim border-r border-outline-variant/30 dark:border-outline/30 flex flex-col h-full py-8 z-50">
<div class="px-8 mb-10 flex items-center gap-3">
<div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center">
<span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
</div>
<div>
<h1 class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed">SupplyLink</h1>
<p class="text-[10px] uppercase tracking-widest text-on-surface-variant opacity-60">Logistics Portal</p>
</div>
</div>
<nav class="flex-grow">
<a class="flex items-center px-4 py-3 text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all duration-200 hover:translate-x-1 active:scale-[0.98]" href="{{ route('dashboard') }}">
<span class="material-symbols-outlined mr-4">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<!-- Active State: Demandes -->
<a class="flex items-center px-4 py-3 bg-secondary-container dark:bg-primary-container text-on-secondary-container dark:text-on-primary-container rounded-xl mx-4 mb-2 transition-all duration-200 hover:translate-x-1 active:scale-[0.98]" href="{{ route('demande.index') }}">
<span class="material-symbols-outlined mr-4" style="font-variation-settings: 'FILL' 1;">assignment</span>
<span class="font-label-md text-label-md">Demandes</span>
</a>
<a class="flex items-center px-4 py-3 text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all duration-200 hover:translate-x-1 active:scale-[0.98]" href="{{ route('offres.index') }}">
<span class="material-symbols-outlined mr-4">local_offer</span>
<span class="font-label-md text-label-md">Offres</span>
</a>
<a class="flex items-center px-4 py-3 text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all duration-200 hover:translate-x-1 active:scale-[0.98]" href="#messages">
<span class="material-symbols-outlined mr-4">mail</span>
<span class="font-label-md text-label-md">Messages</span>
</a>
<a class="flex items-center px-4 py-3 text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all duration-200 hover:translate-x-1 active:scale-[0.98]" href="{{ route('profile.edit') }}">
<span class="material-symbols-outlined mr-4">person</span>
<span class="font-label-md text-label-md">Profile</span>
</a>
</nav>
<div class="px-8 mt-auto space-y-2 pt-6 border-t border-outline-variant/20">
<a class="flex items-center py-2 text-on-surface-variant hover:text-primary transition-colors" href="{{ route('profile.edit') }}">
<span class="material-symbols-outlined mr-4 text-[20px]">settings</span>
<span class="font-label-sm text-label-sm">Settings</span>
</a>
<a class="flex items-center py-2 text-on-surface-variant hover:text-primary transition-colors" href="mailto:support@supplylink.test?subject=SupplyLink%20Help">
<span class="material-symbols-outlined mr-4 text-[20px]">help</span>
<span class="font-label-sm text-label-sm">Help</span>
</a>
</div>
</aside>
<!-- TopAppBar -->
<header class="fixed top-0 right-0 left-[280px] h-16 bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-md border-b border-outline-variant/10 flex justify-between items-center px-8 z-40">
<div class="flex items-center flex-1 max-w-xl">
<div class="relative w-full group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="w-full bg-surface-container-low border-none rounded-full pl-11 pr-4 py-2 focus:ring-2 focus:ring-primary font-body-md text-on-surface-variant placeholder:text-outline" placeholder="Search requests, cargo, or destinations..." type="text"/>
</div>
</div>
<div class="flex items-center gap-2">
<a href="#notifications" aria-label="Notifications" class="hover:bg-surface-container-highest rounded-full p-2 transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">notifications</span>
</a>
<a href="#messages" aria-label="Messages" class="hover:bg-surface-container-highest rounded-full p-2 transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">chat_bubble</span>
</a>
<a href="{{ route('profile.edit') }}" aria-label="Settings" class="hover:bg-surface-container-highest rounded-full p-2 transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">settings</span>
</a>
<div class="h-8 w-[1px] bg-outline-variant/30 mx-2"></div>
<a href="{{ route('profile.edit') }}" class="flex items-center gap-3 pl-2 cursor-pointer group">
<img class="w-10 h-10 rounded-full border-2 border-primary-fixed group-hover:border-primary transition-all shadow-sm" data-alt="A professional headshot of a logistics manager in a modern office. The lighting is bright and natural, reflecting a clean corporate minimalism style. The background features subtle glass elements and a soft blue color palette, emphasizing reliability and professional expertise." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCVgc_N6N1kfWpa-NgDyk1oTXxG_UpwLCD9b59cwFXmMrX36puRJAB709gdZhbbV_B7sHncbiWMIZcHwFLfWWzaHfIy_fWKEc-6p7MReJnuC2uIDFIepGq92Os7CgbE7s-X9MJ6DBxWd9omaYffzcOYi34eV8HKF0aJoih4PVXmEUiuuHO-X4KOUvFZZZd066WTigafQOYXG8EKqLLF_wgKZ968RuX_ERxgZWFtH1Gjd3zWMUFJzBtChsAkHv0bommBP7zHa3LkKLw"/>
<div class="hidden lg:block text-left">
<p class="font-label-md text-label-md text-on-surface leading-none">Marc Dupont</p>
<p class="text-[10px] text-on-surface-variant">Admin Account</p>
</div>
</a>
</header>
<!-- Main Content Canvas -->
<main class="ml-[280px] pt-16 min-h-screen">
<div class="max-w-container-max mx-auto px-margin-desktop py-10">
<span id="notifications" class="sr-only">Notifications</span>
<span id="messages" class="sr-only">Messages</span>
<!-- Page Header Area -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
<div>
<nav class="flex gap-2 text-on-surface-variant mb-2">
<span class="font-label-sm text-label-sm opacity-50">Dashboard</span>
<span class="material-symbols-outlined text-[16px] opacity-30">chevron_right</span>
<span class="font-label-sm text-label-sm text-primary">Demandes</span>
</nav>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Logistics Requests</h2>
<p class="text-on-surface-variant mt-1">Manage your active freight inquiries and review historical shipments.</p>
</div>
<button type="button" id="open-create-request" class="flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-label-md text-label-md shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
<span class="material-symbols-outlined">add_circle</span>
                    Create New Request
                </button>
</div>
<!-- Dashboard Analytics & Filters Bento -->
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-10">
<!-- Status Stats -->
<div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
<div class="bg-white p-6 rounded-[24px] border border-outline-variant/50 shadow-sm flex flex-col justify-between h-32">
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-on-surface-variant">Active Requests</span>
<span class="material-symbols-outlined text-secondary">trending_up</span>
</div>
<p class="font-display-lg text-[32px] font-bold text-on-surface">14</p>
</div>
<div class="bg-white p-6 rounded-[24px] border border-outline-variant/50 shadow-sm flex flex-col justify-between h-32">
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-on-surface-variant">Pending Offers</span>
<span class="material-symbols-outlined text-tertiary-container">hourglass_empty</span>
</div>
<p class="font-display-lg text-[32px] font-bold text-on-surface">42</p>
</div>
<div class="bg-white p-6 rounded-[24px] border border-outline-variant/50 shadow-sm flex flex-col justify-between h-32">
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-on-surface-variant">Completed (30d)</span>
<span class="material-symbols-outlined text-primary">check_circle</span>
</div>
<p class="font-display-lg text-[32px] font-bold text-on-surface">128</p>
</div>
</div>
<!-- Mini Map / Network Visual -->
<button type="button" id="network-card" class="relative bg-primary-container rounded-[24px] overflow-hidden group text-left focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
<img class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" data-alt="A stylized, clean map rendering of a global supply chain network. Glowing lines connect major city hubs across continents, rendered in deep blue and neon sky blue against a dark, minimalist background. The aesthetic is visionary and high-tech, highlighting the precision of global logistics." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9iEPDUqIDCUg77qjW_Oe9Ubs70FTXQjmS4mrg73jFh8Fz9V-urB_1q-FYK6hqXV1rBndnQqICpC15oj7uJ61oZipJ_6__5Gc5mm9xElNrOiLF5-5TsX02RtwwIpbm03-bjUu2RlTEhAIlmcfLQ8-WBIDW8Fpo8MUE_gjs6IAuTgkUF2vpJ4Jnnzrym9LnLkADFjF71NdanFrED65Jszos_q67aabC0G4nWKDJWinESxsDKCn-i6YtmioQVwND3yVyPpgriYMENmA"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary-container/90 to-transparent p-6 flex flex-col justify-end">
<p class="text-white font-label-md">Global Network</p>
<p class="text-primary-fixed text-[10px] uppercase tracking-tighter">Live Traffic View</p>
</div>
</button>
</div>
<!-- Filters Bar -->
<div class="glass-card rounded-[24px] p-4 mb-8 flex flex-wrap items-center gap-4">
<div class="flex items-center gap-2 px-3 py-2 bg-white rounded-lg border border-outline-variant/30">
<span class="material-symbols-outlined text-on-surface-variant text-[18px]">filter_list</span>
<select class="border-none bg-transparent font-label-md text-label-md text-on-surface-variant focus:ring-0 p-0">
<option>Status: All</option>
<option>Active</option>
<option>Pending</option>
<option>Completed</option>
<option>Cancelled</option>
</select>
</div>
<div class="flex items-center gap-2 px-3 py-2 bg-white rounded-lg border border-outline-variant/30">
<span class="material-symbols-outlined text-on-surface-variant text-[18px]">calendar_today</span>
<select class="border-none bg-transparent font-label-md text-label-md text-on-surface-variant focus:ring-0 p-0">
<option>Date: Last 30 Days</option>
<option>Last Quarter</option>
<option>Custom Range</option>
</select>
</div>
<div class="flex items-center gap-2 px-3 py-2 bg-white rounded-lg border border-outline-variant/30">
<span class="material-symbols-outlined text-on-surface-variant text-[18px]">category</span>
<select class="border-none bg-transparent font-label-md text-label-md text-on-surface-variant focus:ring-0 p-0">
<option>Category: All</option>
<option>Air Freight</option>
<option>Ocean Freight</option>
<option>Land Transport</option>
<option>Warehousing</option>
</select>
</div>
<div class="flex-grow"></div>
<p id="pagination-summary" class="font-label-sm text-label-sm text-on-surface-variant pr-2">Showing 1-10 of 142</p>
</div>
<!-- Requests List - Professional Card Pattern -->
<div id="requests" class="space-y-4">
<!-- Request Item 1 (Active) -->
<div onclick="location.href='{{ route('demande.show', 1) }}'" role="link" tabindex="0" onkeydown="if(event.key === 'Enter') location.href='{{ route('demande.show', 1) }}'" class="bg-white hover:bg-surface-container-low transition-all duration-300 p-6 rounded-[24px] border border-outline-variant/50 flex flex-col md:flex-row items-center justify-between gap-6 group cursor-pointer shadow-sm hover:shadow-md">
<div class="flex items-center gap-6 w-full md:w-auto">
<div class="w-14 h-14 bg-secondary-container rounded-2xl flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-on-secondary-container" style="font-variation-settings: 'FILL' 1;">flight_takeoff</span>
</div>
<div>
<div class="flex items-center gap-2 mb-1">
<h3 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">Electronics Batch - PVG to CDG</h3>
<span class="bg-secondary-container/30 text-on-secondary-container px-2 py-0.5 rounded-full text-[10px] font-bold uppercase">Active</span>
</div>
<div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-on-surface-variant font-label-sm text-label-sm">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">event</span>
                                    Expires Oct 24, 2024
                                </div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">location_on</span>
                                    Shanghai (China) ➔ Paris (France)
                                </div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">inventory_2</span>
                                    1.2 Tons, Fragile
                                </div>
</div>
</div>
</div>
<div class="flex items-center justify-between md:justify-end gap-12 w-full md:w-auto">
<div class="text-right">
<p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Budget Range</p>
<p class="font-headline-md text-headline-md font-bold text-on-surface">$12,400 - $14,000</p>
</div>
<div class="text-right">
<p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Offers Received</p>
<div class="flex items-center justify-end gap-2">
<div class="flex -space-x-2">
<img class="w-7 h-7 rounded-full border-2 border-white" data-alt="Close up avatar portrait of a diverse logistics provider in a clean, brightly lit environment. Professional lighting and minimalist tech aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAFu583eqQRa_5FPSY1SqBSicsXvDOLullecfdrfzLtBEkEUmD0vLcuV_LlEKFIpR13YWDDuJkO8pkXUwdAukH40THMcWa3vvQ3XcF9Gr4yRGDG-D1iXGJwLzUhSA6y9wX1rm6I5at-Ix2dAhL-p0QMrBmu1lqUfC0kPLkfCm4raeffpZcR8zRJLSMg4oTwPsFOEIap0popwd8BmNOlsiCrkw05kgftbO42K0E9AerHRsx13Iv2q7qQn_UPV8J6x0UI3J2DxCIyjyA"/>
<img class="w-7 h-7 rounded-full border-2 border-white" data-alt="Close up avatar portrait of a business executive in a high-key office setting. Modern corporate minimalism with soft blue accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEkMSDcrU2Wm8ALmzoJ5nouxggJW2zsOLmmsFGG5n0fAKrvSql71O2XjciZ2QYWto9afCRJ0ytY8VpVr2uM28C9zZc4kDDDkkFpCaa9JA3nw0_IXKXz74yIX0BFuLtrPH8AG5opBF4-i3NFpH_QdTUDYy9G9kTRbd6uXezTmW0VNOaIT_0ZqjTOia4UHMiddCMn7fS2hgpCPiWx6kT6QxXKVIY8dcPMYZ4JT4i4J6yE2pmFa9hj2wzfHxgD7Fi7ELY2RtIuMf3KPw"/>
<div class="w-7 h-7 rounded-full border-2 border-white bg-primary-fixed flex items-center justify-center text-[10px] font-bold text-primary">+5</div>
</div>
<span class="font-headline-md text-headline-md font-bold text-primary">07</span>
</div>
</div>
<span class="material-symbols-outlined text-outline group-hover:translate-x-1 transition-transform">arrow_forward_ios</span>
</div>
</div>
<!-- Request Item 2 (Pending Review) -->
<div onclick="location.href='{{ route('demande.show', 2) }}'" role="link" tabindex="0" onkeydown="if(event.key === 'Enter') location.href='{{ route('demande.show', 2) }}'" class="bg-white hover:bg-surface-container-low transition-all duration-300 p-6 rounded-[24px] border border-outline-variant/50 flex flex-col md:flex-row items-center justify-between gap-6 group cursor-pointer shadow-sm hover:shadow-md">
<div class="flex items-center gap-6 w-full md:w-auto">
<div class="w-14 h-14 bg-surface-container-highest rounded-2xl flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-on-surface-variant">directions_boat</span>
</div>
<div>
<div class="flex items-center gap-2 mb-1">
<h3 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">Automotive Components - HAM to NYC</h3>
<span class="bg-surface-container-high text-on-surface-variant px-2 py-0.5 rounded-full text-[10px] font-bold uppercase">Pending Review</span>
</div>
<div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-on-surface-variant font-label-sm text-label-sm">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">event</span>
                                    Expires Oct 28, 2024
                                </div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">location_on</span>
                                    Hamburg (Germany) ➔ New York (USA)
                                </div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">inventory_2</span>
                                    40ft Container
                                </div>
</div>
</div>
</div>
<div class="flex items-center justify-between md:justify-end gap-12 w-full md:w-auto">
<div class="text-right">
<p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Budget Range</p>
<p class="font-headline-md text-headline-md font-bold text-on-surface">$5,200 - $6,100</p>
</div>
<div class="text-right">
<p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Offers Received</p>
<div class="flex items-center justify-end gap-2">
<div class="flex -space-x-2">
<img class="w-7 h-7 rounded-full border-2 border-white" data-alt="A professional portrait of a woman in a bright, modern corporate setting. Soft ambient light and a minimalist, focused aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAS85CmXw7HWhAj7SMlcfzJPIhGur-blN9hzq72Ek8AAoeSClcThe3CwRiOZFn8D70rwoYqHo3CfF-8VikPh3MnYySRonlTarPpBmEkRyZ9oHqKOzhu67VBg6yCJhAAfxmX7hsOsofDaAa97Bo8jZyj1WyDRKa2vFAW57I7hpOhQs21p5Eyud1qQFoO1en5HNqGxdegBCXCjstK5Qq5lxyRpn-iM2nQbjj19WwHB3YN_Cvp3saUjcC1SF3NyVwNRNJCtqU-pbywak0"/>
<div class="w-7 h-7 rounded-full border-2 border-white bg-primary-fixed flex items-center justify-center text-[10px] font-bold text-primary">+1</div>
</div>
<span class="font-headline-md text-headline-md font-bold text-primary">02</span>
</div>
</div>
<span class="material-symbols-outlined text-outline group-hover:translate-x-1 transition-transform">arrow_forward_ios</span>
</div>
</div>
<!-- Request Item 3 (Draft) -->
<div id="create-request" class="bg-surface-container-low/50 hover:bg-surface-container-low transition-all duration-300 p-6 rounded-[24px] border border-dashed border-outline-variant flex flex-col md:flex-row items-center justify-between gap-6 group cursor-pointer">
<div class="flex items-center gap-6 w-full md:w-auto opacity-70">
<div class="w-14 h-14 bg-outline-variant/20 rounded-2xl flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-on-surface-variant">local_shipping</span>
</div>
<div>
<div class="flex items-center gap-2 mb-1">
<h3 class="font-headline-md text-headline-md text-on-surface">Warehouse Distribution - London Region</h3>
<span class="bg-outline-variant/30 text-on-surface-variant px-2 py-0.5 rounded-full text-[10px] font-bold uppercase">Draft</span>
</div>
<p class="text-on-surface-variant font-label-sm text-label-sm">Last edited 2 hours ago</p>
</div>
</div>
<a href="{{ route('demande.show', 3) }}" class="text-primary font-label-md text-label-md hover:underline">Complete Draft</a>
</div>
</div>
<!-- Pagination Mockup -->
<div class="mt-12 flex justify-center items-center gap-4">
<button type="button" data-page-action="prev" class="w-10 h-10 rounded-full border border-outline-variant/30 flex items-center justify-center text-on-surface-variant hover:bg-white hover:shadow-sm">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button type="button" data-page="1" class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-label-md">1</button>
<button type="button" data-page="2" class="w-10 h-10 rounded-full flex items-center justify-center font-label-md text-on-surface-variant hover:bg-white">2</button>
<button type="button" data-page="3" class="w-10 h-10 rounded-full flex items-center justify-center font-label-md text-on-surface-variant hover:bg-white">3</button>
<button type="button" data-page-action="next" class="w-10 h-10 rounded-full border border-outline-variant/30 flex items-center justify-center text-on-surface-variant hover:bg-white hover:shadow-sm">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
</main>
<div id="create-request-modal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-on-surface/40 p-6">
<div class="w-full max-w-2xl rounded-[28px] bg-white p-8 shadow-2xl">
<div class="mb-6 flex items-start justify-between gap-4">
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">Create New Request</h3>
<p class="mt-1 text-on-surface-variant">Add the shipment details and publish the request.</p>
</div>
<button type="button" id="close-create-request" class="rounded-full p-2 hover:bg-surface-container">
<span class="material-symbols-outlined">close</span>
</button>
</div>
<form id="create-request-form" class="grid grid-cols-1 gap-4 md:grid-cols-2">
<div class="md:col-span-2">
<label class="mb-1 block font-label-sm text-label-sm text-on-surface-variant" for="request-title">Title</label>
<input id="request-title" name="title" required class="w-full rounded-xl border-outline-variant focus:border-primary focus:ring-primary" placeholder="Electronics Batch - PVG to CDG" type="text">
</div>
<div>
<label class="mb-1 block font-label-sm text-label-sm text-on-surface-variant" for="request-category">Category</label>
<select id="request-category" name="category" class="w-full rounded-xl border-outline-variant focus:border-primary focus:ring-primary">
<option>Air Freight</option>
<option>Ocean Freight</option>
<option>Land Transport</option>
<option>Warehousing</option>
</select>
</div>
<div>
<label class="mb-1 block font-label-sm text-label-sm text-on-surface-variant" for="request-needed-at">Needed At</label>
<input id="request-needed-at" name="needed_at" class="w-full rounded-xl border-outline-variant focus:border-primary focus:ring-primary" type="date">
</div>
<div>
<label class="mb-1 block font-label-sm text-label-sm text-on-surface-variant" for="request-quantity">Quantity</label>
<input id="request-quantity" name="quantity" required min="1" value="1" class="w-full rounded-xl border-outline-variant focus:border-primary focus:ring-primary" type="number">
</div>
<div>
<label class="mb-1 block font-label-sm text-label-sm text-on-surface-variant" for="request-budget">Budget</label>
<input id="request-budget" name="budget" min="0" step="0.01" class="w-full rounded-xl border-outline-variant focus:border-primary focus:ring-primary" placeholder="12000" type="number">
</div>
<div class="md:col-span-2">
<label class="mb-1 block font-label-sm text-label-sm text-on-surface-variant" for="request-description">Description</label>
<textarea id="request-description" name="description" required rows="4" class="w-full rounded-xl border-outline-variant focus:border-primary focus:ring-primary" placeholder="Describe origin, destination, cargo type, dimensions, and special requirements."></textarea>
</div>
<p id="create-request-feedback" class="hidden rounded-xl px-4 py-3 text-sm md:col-span-2"></p>
<div class="flex justify-end gap-3 md:col-span-2">
<button type="button" id="cancel-create-request" class="rounded-xl border border-outline-variant px-5 py-3 font-label-md text-label-md text-on-surface-variant hover:bg-surface-container">Cancel</button>
<button type="submit" class="rounded-xl bg-primary px-5 py-3 font-label-md text-label-md text-white shadow-lg shadow-primary/20">Save Request</button>
</div>
</form>
</div>
</div>
<!-- Footer -->
<footer id="legal" class="relative w-full bg-surface-container-low dark:bg-inverse-surface border-t border-outline-variant/50 ml-[280px] w-[calc(100%-280px)]">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 py-12 px-margin-desktop max-w-container-max mx-auto">
<div class="col-span-1 md:col-span-1">
<h4 class="font-headline-sm text-headline-sm text-primary mb-4 font-bold">SupplyLink</h4>
<p class="font-label-sm text-label-sm text-on-surface-variant">Empowering global supply chains through precision and reliable technology.</p>
</div>
<div class="flex flex-col gap-3">
<h5 class="font-label-md text-label-md text-on-surface font-bold">Resources</h5>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="{{ route('demande.index') }}">Solutions Guide</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="{{ route('offres.index') }}">Carrier Network</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="{{ route('profile.edit') }}">Security</a>
</div>
<div class="flex flex-col gap-3">
<h5 class="font-label-md text-label-md text-on-surface font-bold">Company</h5>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="{{ url('/') }}#about">About Us</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="mailto:careers@supplylink.test?subject=SupplyLink%20Careers">Careers</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="mailto:support@supplylink.test?subject=SupplyLink%20Contact">Contact</a>
</div>
<div class="flex flex-col gap-3">
<h5 class="font-label-md text-label-md text-on-surface font-bold">Legal</h5>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="#legal">Privacy Policy</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="#legal">Terms of Service</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors hover:underline underline-offset-4" href="#legal">Cookie Policy</a>
</div>
</div>
<div class="border-t border-outline-variant/10 py-6 px-margin-desktop text-center">
<p class="font-label-sm text-label-sm text-on-surface-variant opacity-60">© 2024 SupplyLink Logistics. All rights reserved.</p>
</div>
</footer>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('create-request-modal');
    const form = document.getElementById('create-request-form');
    const feedback = document.getElementById('create-request-feedback');
    const summary = document.getElementById('pagination-summary');
    let currentPage = 1;

    const openModal = () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.getElementById('request-title').focus();
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        feedback.className = 'hidden rounded-xl px-4 py-3 text-sm md:col-span-2';
        feedback.textContent = '';
    };

    document.getElementById('open-create-request').addEventListener('click', openModal);
    document.getElementById('close-create-request').addEventListener('click', closeModal);
    document.getElementById('cancel-create-request').addEventListener('click', closeModal);
    modal.addEventListener('click', (event) => {
        if (event.target === modal) closeModal();
    });

    document.getElementById('network-card').addEventListener('click', () => {
        document.getElementById('requests').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    const updatePage = (page) => {
        currentPage = Math.max(1, Math.min(3, page));
        document.querySelectorAll('[data-page]').forEach((button) => {
            const active = Number(button.dataset.page) === currentPage;
            button.className = active
                ? 'w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-label-md'
                : 'w-10 h-10 rounded-full flex items-center justify-center font-label-md text-on-surface-variant hover:bg-white';
        });
        const start = (currentPage - 1) * 10 + 1;
        const end = Math.min(currentPage * 10, 142);
        summary.textContent = `Showing ${start}-${end} of 142`;
        document.getElementById('requests').scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    document.querySelectorAll('[data-page]').forEach((button) => {
        button.addEventListener('click', () => updatePage(Number(button.dataset.page)));
    });
    document.querySelector('[data-page-action="prev"]').addEventListener('click', () => updatePage(currentPage - 1));
    document.querySelector('[data-page-action="next"]').addEventListener('click', () => updatePage(currentPage + 1));

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        feedback.className = 'rounded-xl bg-secondary-fixed px-4 py-3 text-sm text-on-secondary-fixed md:col-span-2';
        feedback.textContent = 'Saving request...';

        const payload = Object.fromEntries(new FormData(form).entries());
        if (!payload.budget) delete payload.budget;
        if (!payload.needed_at) delete payload.needed_at;

        try {
            const response = await fetch('{{ route('demande.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Request could not be saved.');
            }

            feedback.className = 'rounded-xl bg-secondary-container px-4 py-3 text-sm text-on-secondary-container md:col-span-2';
            feedback.textContent = 'Request saved. Opening details...';
            window.location.href = `/demande/${data.id}`;
        } catch (error) {
            feedback.className = 'rounded-xl bg-error-container px-4 py-3 text-sm text-on-error-container md:col-span-2';
            feedback.textContent = error.message;
        }
    });
});
</script>
</body></html>
