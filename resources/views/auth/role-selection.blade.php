@extends('layouts.auth', ['title' => __('social.role_selection_title') . ' | ' . __('common.app_name')])

@section('content')
    <div class="mb-8 text-center">
        @if ($user->avatarUrl())
            <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}" class="mx-auto mb-4 h-16 w-16 rounded-full border-2 border-white shadow-card object-cover">
        @endif
        <h1 class="text-2xl font-bold text-ink">{{ __('social.role_selection_title') }}</h1>
        <p class="mt-2 text-sm text-muted">{{ __('social.role_selection_subtitle') }}</p>
    </div>

    <form method="POST" action="{{ route('auth.role-selection.store') }}" class="space-y-4">
        @csrf

        <label class="block cursor-pointer">
            <input type="radio" name="role" value="client" class="peer sr-only" required>
            <div class="rounded-2xl border-2 border-line/60 p-5 transition peer-checked:border-primary peer-checked:bg-soft/60 hover:border-primary/40">
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-3xl text-primary">shopping_cart</span>
                    <div>
                        <p class="font-bold text-ink">{{ __('roles.client') }}</p>
                        <p class="mt-1 text-sm text-muted">{{ __('social.client_description') }}</p>
                    </div>
                </div>
            </div>
        </label>

        <label class="block cursor-pointer">
            <input type="radio" name="role" value="supplier" class="peer sr-only">
            <div class="rounded-2xl border-2 border-line/60 p-5 transition peer-checked:border-primary peer-checked:bg-soft/60 hover:border-primary/40">
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-3xl text-primary">storefront</span>
                    <div>
                        <p class="font-bold text-ink">{{ __('roles.supplier') }}</p>
                        <p class="mt-1 text-sm text-muted">{{ __('social.supplier_description') }}</p>
                    </div>
                </div>
            </div>
        </label>

        @error('role')<p class="saas-field-error">{{ $message }}</p>@enderror

        <button type="submit" class="saas-btn-primary saas-btn-lg w-full">{{ __('social.continue') }}</button>
    </form>
@endsection
