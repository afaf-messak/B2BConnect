<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    @include('partials.theme-init')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('common.app_name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc',
                            400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca',
                            800: '#3730a3', 900: '#312e81',
                        },
                    },
                    fontFamily: {
                        sans: ['Geist', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    @include('landing.styles')
    @include('partials.theme-styles')
    @include('partials.design-system')
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            background:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(99, 102, 241, 0.2), transparent),
                #fafafa;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        [x-cloak] { display: none !important; }
    </style>
    @stack('head')
</head>
<body class="flex min-h-screen flex-col text-zinc-900 antialiased dark:text-zinc-100">
    <header class="fixed inset-x-0 top-0 z-50 border-b border-zinc-200/60 bg-white/80 backdrop-blur-xl transition-colors duration-300 dark:border-zinc-700/30 dark:bg-zinc-900/75">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <x-b2b-logo />
            <div class="flex items-center gap-3">
                @include('landing.lang-switcher')
                <button type="button" data-theme-toggle class="flex h-9 w-9 items-center justify-center rounded-xl border border-zinc-200/80 text-zinc-600 dark:border-zinc-700 dark:text-zinc-400">
                    <span class="material-symbols-outlined text-lg theme-icon-light">dark_mode</span>
                    <span class="material-symbols-outlined hidden text-lg theme-icon-dark">light_mode</span>
                </button>
                @hasSection('header_action')
                    @yield('header_action')
                @endif
            </div>
        </div>
    </header>

    <main class="flex-1 pt-28 pb-16">
        @yield('content')
    </main>

    @include('partials.auth-footer')

    @include('partials.theme-script')
    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
