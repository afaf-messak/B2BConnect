@extends('layouts.saas', ['navActive' => 'demandes'])

@section('content')
    <a href="{{ route('supplier.demandes.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <div class="mb-8 saas-card">
        <h1 class="text-xl font-bold">{{ $demande->title }}</h1>
        <p class="mt-2 text-sm text-on-surface-variant">{{ __('roles.client') }}: {{ $demande->user?->company_name ?: $demande->user?->name }}</p>
        <p class="mt-4 whitespace-pre-line text-sm">{{ $demande->description }}</p>
    </div>

    <form method="POST" action="{{ route('supplier.demandes.quote.store', $demande) }}" class="saas-card max-w-2xl space-y-5">
        @csrf
        <h2 class="text-lg font-bold">{{ $existingOffer ? __('marketplace.update_quotation') : __('marketplace.submit_quotation') }}</h2>

        <div>
            <label class="saas-label">{{ __('marketplace.quotation_title') }}</label>
            <input type="text" name="title" required value="{{ old('title', $existingOffer?->title) }}" class="saas-input mt-1">
        </div>
        <div>
            <label class="saas-label">{{ __('marketplace.quotation_description') }}</label>
            <textarea name="description" rows="5" required class="saas-input mt-1">{{ old('description', $existingOffer?->description) }}</textarea>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="saas-label">{{ __('marketplace.price') }}</label>
                <input type="number" step="0.01" min="0" name="price" required value="{{ old('price', $existingOffer?->price) }}" class="saas-input mt-1">
            </div>
            <div>
                <label class="saas-label">{{ __('marketplace.delivery_days') }}</label>
                <input type="number" min="1" name="delivery_time_days" required value="{{ old('delivery_time_days', $existingOffer?->delivery_time_days ?? 7) }}" class="saas-input mt-1">
            </div>
        </div>
        <button type="submit" class="saas-btn-primary">{{ $existingOffer ? __('marketplace.update_quotation') : __('marketplace.submit_quotation') }}</button>
    </form>
@endsection
