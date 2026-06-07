<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    @include('partials.theme-init')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('landing.meta.description') }}">
    <title>{{ __('landing.meta.title') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @if (app()->getLocale() === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        },
                        surface: {
                            light: '#fafafa',
                            dark: '#09090b',
                        },
                    },
                    fontFamily: {
                        sans: ['Geist', {{ app()->getLocale() === 'ar' ? "'Noto Sans Arabic'," : '' }} 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 2s infinite',
                        'pulse-glow': 'pulse-glow 4s ease-in-out infinite',
                        'gradient': 'gradient 8s ease infinite',
                        'shimmer': 'shimmer 2.5s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        'pulse-glow': {
                            '0%, 100%': { opacity: '0.4' },
                            '50%': { opacity: '0.8' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                    },
                },
            },
        };
    </script>

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    @include('landing.styles')
</head>
<body
    class="bg-[#fafafa] text-zinc-900 antialiased dark:bg-[#09090b] dark:text-zinc-100"
    x-data="landingPage()"
    x-init="init()"
>
    @include('landing.nav')

    <main>
        @yield('content')
    </main>

    @include('landing.footer')

    @include('landing.scripts')
    @include('partials.theme-script')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60,
            disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        });
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>
</body>
</html>
