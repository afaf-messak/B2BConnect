@php
    $locale = app()->getLocale();
    $showSidebar = $showSidebar ?? true;
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    @include('partials.saas-head', ['title' => $title ?? null])
    @stack('head')
</head>
<body class="min-h-screen bg-background text-on-background antialiased transition-colors duration-300">
    @include('partials.saas-sidebar')

    <div id="saas-main" class="saas-main flex min-h-screen flex-col">
        @include('partials.saas-navbar')

        <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-[1440px]">
                @if (session('error'))
                    <div class="saas-alert saas-alert-error">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="saas-alert saas-alert-success">{{ session('success') }}</div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @include('partials.saas-scripts')
    @stack('scripts')
</body>
</html>
