@extends('layouts.saas', [
    'title' => __('nav.profile') . ' - ' . __('common.app_name'),
    'navActive' => 'settings',
])

@section('content')
    <a href="{{ $settingsRoute ?? route('client.settings') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="__('nav.profile')" :subtitle="__('roles.profile_subtitle')" />

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="saas-card">
            @include('profile.partials.update-profile-information-form')
        </section>

        <section class="saas-card">
            @include('profile.partials.update-password-form')
        </section>

        <section class="saas-card lg:col-span-2">
            @include('profile.partials.delete-user-form')
        </section>
    </div>
@endsection
