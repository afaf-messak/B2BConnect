@extends('layouts.saas', ['navActive' => 'users'])

@section('content')
    <a href="{{ route('admin.users.show', $user) }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="saas-card max-w-2xl space-y-5">
        @csrf
        @method('PUT')
        @include('admin.users._form', ['user' => $user, 'creating' => false])
        <button type="submit" class="saas-btn-primary">{{ __('common.save') }}</button>
    </form>
@endsection
