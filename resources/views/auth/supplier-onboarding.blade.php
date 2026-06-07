@extends('layouts.auth', ['title' => __('social.supplier_onboarding_title') . ' | ' . __('common.app_name')])

@section('content')
    <div class="mb-8 text-center">
        <span class="material-symbols-outlined mb-3 text-5xl text-primary">verified_user</span>
        <h1 class="text-2xl font-bold text-ink">{{ __('social.supplier_onboarding_title') }}</h1>
        <p class="mt-2 text-sm text-muted">{{ __('social.supplier_onboarding_subtitle') }}</p>
    </div>

    <form method="POST" action="{{ route('auth.supplier-onboarding.store') }}" class="space-y-5">
        @csrf

        <div class="saas-form-group">
            <label for="company_name" class="saas-label">{{ __('social.company_name') }} *</label>
            <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $user->company_name) }}" required class="saas-input @error('company_name') saas-input-error @enderror">
            @error('company_name')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label for="ice" class="saas-label">{{ __('social.ice') }} *</label>
            <input type="text" id="ice" name="ice" value="{{ old('ice', $user->ice) }}" required inputmode="numeric" pattern="[0-9]+" placeholder="000000000000000" class="saas-input @error('ice') saas-input-error @enderror">
            <p class="mt-1 text-xs text-muted">{{ __('social.ice_hint') }}</p>
            @error('ice')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-alert saas-alert-info">{{ __('social.supplier_pending_notice') }}</div>

        <button type="submit" class="saas-btn-primary saas-btn-lg w-full">{{ __('social.submit_verification') }}</button>
    </form>
@endsection
