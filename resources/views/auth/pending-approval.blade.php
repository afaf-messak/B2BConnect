@extends('layouts.auth', ['title' => __('social.pending_title') . ' | ' . __('common.app_name')])

@section('content')
    <div class="text-center">
        <div class="mx-auto mb-6 grid h-20 w-20 place-items-center rounded-full bg-soft">
            <span class="material-symbols-outlined text-4xl text-primary">hourglass_top</span>
        </div>
        <h1 class="text-2xl font-bold text-ink">{{ __('social.pending_title') }}</h1>
        <p class="mt-3 text-sm text-muted">{{ __('social.pending_subtitle') }}</p>

        <div class="saas-card mt-8 text-start">
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between gap-4">
                    <dt class="text-muted">{{ __('social.company_name') }}</dt>
                    <dd class="font-semibold text-ink">{{ $user->company_name }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-muted">{{ __('social.ice') }}</dt>
                    <dd class="font-semibold text-ink">{{ $user->ice }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-muted">{{ __('common.status') }}</dt>
                    <dd><span class="saas-badge saas-badge-warning">{{ __('common.pending') }}</span></dd>
                </div>
            </dl>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="saas-btn-secondary w-full">{{ __('nav.logout') }}</button>
        </form>
    </div>
@endsection
