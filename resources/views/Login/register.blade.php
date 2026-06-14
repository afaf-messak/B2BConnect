@extends('layouts.auth-marketing', ['title' => __('auth.register_title') . ' | ' . __('common.app_name')])

@section('header_action')
    <span class="hidden text-sm text-zinc-500 sm:inline">{{ __('auth.already_account') }}</span>
    <a href="{{ route('login') }}" class="btn-primary rounded-xl px-5 py-2.5 text-sm font-semibold text-white">{{ __('auth.login') }}</a>
@endsection

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
    <div class="mb-12 text-center" data-aos="fade-up">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">{{ __('auth.register_title') }}</h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-zinc-600 dark:text-zinc-400">{{ __('auth.register_subtitle') }}</p>
    </div>

    <div class="mb-12 grid gap-5 md:grid-cols-2" data-aos="fade-up" data-aos-delay="80">
        <button type="button" data-role="client"
            class="role-card premium-card glass-card group rounded-3xl p-8 text-left {{ old('role', 'client') === 'client' ? 'ring-2 ring-brand-500' : '' }}">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-500/10 text-brand-600 dark:text-brand-400">
                <span class="material-symbols-outlined text-3xl">shopping_cart</span>
            </div>
            <h3 class="text-xl font-semibold">{{ __('auth.client_card_title') }}</h3>
            <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('auth.client_card_desc') }}</p>
            <div class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-brand-600 dark:text-brand-400">
                {{ __('auth.select_role') }}
                <span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-1">arrow_forward</span>
            </div>
        </button>

        <button type="button" data-role="supplier"
            class="role-card premium-card glass-card group rounded-3xl p-8 text-left {{ old('role') === 'supplier' ? 'ring-2 ring-brand-500' : '' }}">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-500/10 text-violet-600 dark:text-violet-400">
                <span class="material-symbols-outlined text-3xl">storefront</span>
            </div>
            <h3 class="text-xl font-semibold">{{ __('auth.supplier_card_title') }}</h3>
            <p class="mt-2 text-zinc-600 dark:text-zinc-400">{{ __('auth.supplier_card_desc') }}</p>
            <div class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-brand-600 dark:text-brand-400">
                {{ __('auth.select_role') }}
                <span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-1">arrow_forward</span>
            </div>
        </button>
    </div>

    <div class="glass-card rounded-3xl p-8 md:p-10" data-aos="fade-up" data-aos-delay="150">
        <div class="mb-8">
            <h2 class="text-2xl font-bold">{{ __('auth.form_title') }}</h2>
            <p class="mt-2 text-zinc-600 dark:text-zinc-400">
                {{ str_replace(':company', __('common.app_name'), __('auth.form_subtitle')) }}
            </p>
        </div>

        @include('partials.social-auth-buttons', ['compact' => true, 'alwaysShow' => true])
        <p class="my-6 text-center text-sm text-zinc-500">{{ __('social.or_email') }}</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="role" id="account_role" value="{{ old('role', 'client') }}">

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-950/40 dark:text-red-300">
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('auth.full_name') }}</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name"
                        class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-900">
                </div>
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('auth.email') }}</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-900">
                </div>
            </div>

            <div>
                <label for="company" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('auth.company') }}</label>
                <input id="company" name="company_name" type="text" value="{{ old('company_name') }}" required autocomplete="organization"
                    placeholder="{{ __('auth.company_placeholder') }}"
                    class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-900">
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('auth.password') }}</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-900">
                </div>
                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('auth.password_confirm') }}</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                        class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-900">
                </div>
            </div>

            <label class="flex items-start gap-3">
                <input type="checkbox" name="terms" value="1" required {{ old('terms') ? 'checked' : '' }}
                    class="mt-1 rounded border-zinc-300 text-brand-600 focus:ring-brand-500">
                <span class="text-sm text-zinc-600 dark:text-zinc-400">
                    {!! __('auth.terms', [
                        'terms' => '<a href="#" class="font-semibold text-brand-600 hover:underline dark:text-brand-400">' . e(__('auth.terms_link')) . '</a>',
                        'privacy' => '<a href="#" class="font-semibold text-brand-600 hover:underline dark:text-brand-400">' . e(__('auth.privacy_link')) . '</a>',
                    ]) !!}
                </span>
            </label>

            <button type="submit" class="btn-primary rounded-2xl px-8 py-4 text-base font-semibold text-white">
                {{ __('auth.submit') }}
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
<script>
    AOS.init({ duration: 700, once: true, offset: 40 });
    document.querySelectorAll('.role-card').forEach((card) => {
        card.addEventListener('click', () => {
            document.getElementById('account_role').value = card.dataset.role;
            document.querySelectorAll('.role-card').forEach((item) => item.classList.remove('ring-2', 'ring-brand-500'));
            card.classList.add('ring-2', 'ring-brand-500');
        });
    });
</script>
@endpush
