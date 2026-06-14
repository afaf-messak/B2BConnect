@extends('layouts.auth-marketing', ['title' => __('common.login') . ' | ' . __('common.app_name')])

@section('header_action')
    <span class="hidden text-sm text-zinc-500 sm:inline">{{ __('auth.no_account') }}</span>
    <a href="{{ route('register') }}" class="btn-primary rounded-xl px-5 py-2.5 text-sm font-semibold text-white">{{ __('auth.create_access') }}</a>
@endsection

@section('content')
<div class="mx-auto max-w-lg px-4 sm:px-6 lg:px-8">
    <div class="glass-card rounded-3xl p-8 md:p-10" data-aos="fade-up">
        <div class="mb-8 text-center">
            <x-b2b-logo size="lg" class="mx-auto mb-6 justify-center" href="/" />
            <h1 class="text-3xl font-bold tracking-tight">{{ __('auth.login_title') }}</h1>
            <p class="mt-3 text-zinc-600 dark:text-zinc-400">
                {{ str_replace(':company', __('common.app_name'), __('auth.login_subtitle')) }}
            </p>
        </div>

        @if (session('status'))
            <div class="mb-5 rounded-xl border border-brand-200 bg-brand-50 px-4 py-3 text-sm text-brand-800 dark:border-brand-900 dark:bg-brand-950/40 dark:text-brand-200">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-950/40 dark:text-red-300">
                {{ session('error') }}
            </div>
        @endif

        @include('partials.social-auth-buttons', ['compact' => true, 'alwaysShow' => true])
        <p class="my-6 text-center text-sm text-zinc-500">{{ __('social.or_email') }}</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('auth.email') }}</label>
                <div class="relative">
                    <span class="material-symbols-outlined pointer-events-none absolute start-4 top-1/2 -translate-y-1/2 text-zinc-400">mail</span>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        placeholder="name@company.com"
                        class="w-full rounded-xl border border-zinc-200 bg-white py-3.5 ps-12 pe-4 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-900 @error('email') border-red-500 @enderror">
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="mb-2 flex items-center justify-between gap-3">
                    <label for="password" class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('auth.password') }}</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-semibold text-brand-600 hover:underline dark:text-brand-400">{{ __('auth.forgot_password') }}</a>
                    @endif
                </div>
                <div class="relative">
                    <span class="material-symbols-outlined pointer-events-none absolute start-4 top-1/2 -translate-y-1/2 text-zinc-400">lock</span>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-xl border border-zinc-200 bg-white py-3.5 ps-12 pe-4 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-900 @error('password') border-red-500 @enderror">
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                <input id="remember_me" name="remember" type="checkbox" class="rounded border-zinc-300 text-brand-600 focus:ring-brand-500">
                {{ __('auth.remember_me') }}
            </label>

            <button type="submit" class="btn-primary w-full rounded-2xl py-4 text-base font-semibold text-white">
                {{ __('auth.login') }}
            </button>
        </form>
    </div>
</div>
@endsection

@push('head')
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ duration: 700, once: true, offset: 40 });</script>
@endpush
