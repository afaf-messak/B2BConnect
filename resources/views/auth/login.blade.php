<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SupplyLink</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
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
                    fontFamily: {
                        sans: ['Geist', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background:
                radial-gradient(circle at 10% 10%, rgba(221, 225, 255, .68), transparent 28%),
                radial-gradient(circle at 92% 14%, rgba(164, 201, 255, .38), transparent 32%),
                radial-gradient(circle at 86% 82%, rgba(221, 225, 255, .66), transparent 34%),
                #f8f9ff;
        }

        .glass {
            background: rgba(255, 255, 255, .74);
            border: 1px solid rgba(255, 255, 255, .68);
            box-shadow: 0 24px 70px rgba(15, 23, 42, .08);
            backdrop-filter: blur(22px);
        }

        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            font-size: 22px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body class="min-h-screen font-sans text-ink">
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
                <div class="mb-5 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-medium text-primary">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="ml-1 block text-base font-medium text-muted">Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-ink">mail</span>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="name@company.com"
                            class="h-14 w-full rounded-xl border bg-panel py-3 pl-12 pr-4 text-base text-ink outline-none transition placeholder:text-gray-400 focus:border-primary focus:ring-4 focus:ring-blue-900/10 @error('email') border-error focus:border-error focus:ring-red-900/10 @else border-line @enderror"
                        >
                    </div>
                    @error('email')
                        <p class="ml-1 text-sm font-medium text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between px-1">
                        <label for="password" class="block text-base font-medium text-muted">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-base font-medium text-primary hover:underline">Forgot?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-ink">lock</span>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="Password"
                            class="h-14 w-full rounded-xl border bg-panel py-3 pl-12 pr-4 text-base text-ink outline-none transition placeholder:text-gray-400 focus:border-primary focus:ring-4 focus:ring-blue-900/10 @error('password') border-error focus:border-error focus:ring-red-900/10 @else border-line @enderror"
                        >
                    </div>
                    @error('password')
                        <p class="ml-1 text-sm font-medium text-error">{{ $message }}</p>
                    @enderror
                </div>

                <label for="remember_me" class="flex items-center gap-2 px-1 text-sm font-medium text-muted">
                    <input id="remember_me" name="remember" type="checkbox" class="rounded border-line text-primary focus:ring-primary">
                    Remember me
                </label>

                <button type="submit" class="h-14 w-full rounded-xl bg-primary text-lg font-medium text-white shadow-xl shadow-blue-950/15 transition hover:bg-blue-950 active:scale-[.99]">
                    Sign In
                </button>
            </form>

            <div class="my-8 flex items-center gap-4">
                <div class="h-px flex-1 bg-line/60"></div>
                <span class="text-sm font-medium text-muted">Or continue with</span>
                <div class="h-px flex-1 bg-line/60"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button type="button" class="flex h-14 items-center justify-center gap-3 rounded-xl border border-line bg-panel text-base font-medium text-muted transition hover:bg-soft">
                    <span class="text-xl font-bold text-[#4285f4]">G</span>
                    Google
                </button>
                <button type="button" class="flex h-14 items-center justify-center gap-3 rounded-xl border border-line bg-panel text-base font-medium text-muted transition hover:bg-soft">
                    <span class="flex h-6 w-6 items-center justify-center rounded bg-[#0077b5] text-sm font-bold text-white">in</span>
                    LinkedIn
                </button>
            </div>

            <p class="mt-10 text-center text-base text-muted">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-bold text-primary hover:underline">Create access</a>
            </p>
        </section>

        <aside class="glass absolute right-[8%] top-1/2 hidden w-[320px] translate-y-[-35%] rotate-3 rounded-3xl p-6 lg:block">
            <div class="mb-4 flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-primary">
                    <span class="material-symbols-outlined">local_shipping</span>
                </div>
                <div>
                    <p class="text-lg font-semibold text-ink">Global Transit</p>
                    <p class="text-xs font-medium text-muted">Real-time Node Status</p>
                </div>
            </div>
            <div class="h-2 overflow-hidden rounded-full bg-soft">
                <div class="h-full w-3/4 rounded-full bg-primary"></div>
            </div>
            <div class="mt-3 flex justify-between text-xs font-semibold text-muted">
                <span>Active Shipments: 1,240</span>
                <span class="text-primary">94% Efficiency</span>
            </div>
        </aside>
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
