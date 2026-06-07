<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('common.login') }} | {{ __('common.app_name') }}</title>
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
                        panel: '#ffffff',
                        soft: '#e5eeff',
                        error: '#ba1a1a'
                    },
                    fontFamily: { sans: ['Geist', 'sans-serif'] }
                }
            }
        }
    </script>
    @include('partials.design-system')
    <style>
        body {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            background:
                radial-gradient(circle at 10% 10%, rgba(221, 225, 255, .68), transparent 28%),
                radial-gradient(circle at 92% 14%, rgba(164, 201, 255, .38), transparent 32%),
                radial-gradient(circle at 86% 82%, rgba(221, 225, 255, .66), transparent 34%),
                #f8f9ff;
        }
        html.dark body { background: #0b1c30; }
        .glass {
            background: rgba(255, 255, 255, .74);
            border: 1px solid rgba(255, 255, 255, .68);
            box-shadow: 0 24px 70px rgba(15, 23, 42, .08);
            backdrop-filter: blur(22px);
        }
        html.dark .glass {
            background: rgba(21, 37, 54, 0.92);
            border-color: rgba(117, 118, 132, 0.35);
        }
        .material-symbols-outlined { font-size: 22px; line-height: 1; }
    </style>
</head>
<body class="min-h-screen font-sans text-ink antialiased">
    <main class="relative flex min-h-[calc(100vh-92px)] items-center justify-center overflow-hidden px-4 py-10 sm:px-8">
        <section class="glass relative z-10 w-full max-w-[520px] rounded-[32px] px-7 py-9 sm:px-12 sm:py-12">
            <div class="mb-9 flex flex-col items-center text-center">
                <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-full bg-primary text-2xl font-bold text-white shadow-lg shadow-blue-900/20">
                    S
                </div>
                <h1 class="text-4xl font-bold tracking-normal text-ink">Welcome back</h1>
                <p class="mt-3 text-lg text-muted">Enter your credentials to access the logistics portal</p>
            </div>

            @if (session('status'))
                <div class="saas-alert saas-alert-info mb-5">{{ session('status') }}</div>
            @endif

            @if (session('error'))
                <div class="saas-alert saas-alert-error mb-5">{{ session('error') }}</div>
            @endif

            @include('partials.social-auth-buttons', ['alwaysShow' => true])

            <div class="my-8 flex items-center gap-4">
                <div class="h-px flex-1 bg-line/60"></div>
                <span class="text-sm font-medium text-muted">{{ __('social.or_email') }}</span>
                <div class="h-px flex-1 bg-line/60"></div>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="saas-form-group">
                    <label for="email" class="saas-label">{{ __('Email') }}</label>
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute start-4 top-1/2 -translate-y-1/2 text-ink">mail</span>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="name@company.com"
                            class="saas-input !ps-12 @error('email') saas-input-error @enderror"
                        >
                    </div>
                    @error('email')
                        <p class="saas-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="saas-form-group">
                    <div class="flex items-center justify-between gap-3">
                        <label for="password" class="saas-label !mb-0">{{ __('Password') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary hover:underline">{{ __('Forgot your password?') }}</a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute start-4 top-1/2 -translate-y-1/2 text-ink">lock</span>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="{{ __('Password') }}"
                            class="saas-input !ps-12 @error('password') saas-input-error @enderror"
                        >
                    </div>
                    @error('password')
                        <p class="saas-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <label for="remember_me" class="flex items-center gap-2 text-sm font-medium text-muted">
                    <input id="remember_me" name="remember" type="checkbox" class="saas-checkbox">
                    {{ __('Remember me') }}
                </label>

                <button type="submit" class="saas-btn-primary saas-btn-lg w-full">
                    {{ __('Log in') }}
                </button>
            </form>

            <p class="mt-10 text-center text-base text-muted">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-bold text-primary hover:underline">Create access</a>
            </p>
        </section>
    </main>

    <footer class="mx-auto flex w-full max-w-[1440px] flex-col items-center justify-between gap-4 px-8 pb-8 text-sm font-medium text-muted md:flex-row md:px-12">
        <p>&copy; 2024 SupplyLink Logistics. All rights reserved.</p>
        <div class="flex flex-wrap justify-center gap-6">
            <a href="#" class="hover:text-primary">Privacy Policy</a>
            <a href="#" class="hover:text-primary">Terms of Service</a>
            <a href="#" class="hover:text-primary">Contact Support</a>
        </div>
    </footer>
</body>
</html>
