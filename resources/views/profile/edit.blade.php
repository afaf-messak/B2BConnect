@extends('layouts.saas', [
    'title' => __('nav.profile') . ' - ' . __('common.app_name'),
    'navActive' => 'profile',
])

@section('content')
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
