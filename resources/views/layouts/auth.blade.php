<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('common.app_name'))</title>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#00288e',
                        ink: '#0b1c30',
                        muted: '#444653',
                        line: '#c4c5d5',
                        surface: '#f8f9ff',
                        error: '#ba1a1a',
                    },
                    fontFamily: { sans: ['Geist', 'sans-serif'] },
                },
            },
        };
    </script>
    @include('partials.design-system')
    <style>
        body {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            background:
                radial-gradient(circle at 10% 10%, rgba(221, 225, 255, .68), transparent 28%),
                radial-gradient(circle at 92% 14%, rgba(164, 201, 255, .38), transparent 32%),
                #f8f9ff;
        }
        html.dark body { background: #0b1c30; color: #eaf1ff; }
        .auth-glass {
            background: rgba(255, 255, 255, .78);
            border: 1px solid rgba(196, 197, 213, 0.35);
            box-shadow: 0 24px 70px rgba(15, 23, 42, .08);
            backdrop-filter: blur(22px);
        }
        html.dark .auth-glass {
            background: rgba(21, 37, 54, 0.92);
            border-color: rgba(117, 118, 132, 0.35);
        }
    </style>
    @stack('head')
</head>
<body class="min-h-screen text-ink antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-8">
        <div class="auth-glass w-full max-w-lg rounded-[28px] p-7 sm:p-10">
            @if (session('error'))
                <div class="saas-alert saas-alert-error mb-6">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="saas-alert saas-alert-success mb-6">{{ session('success') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
    @include('partials.theme-script')
    @stack('scripts')
</body>
</html>
