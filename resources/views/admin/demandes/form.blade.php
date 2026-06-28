@extends('layouts.saas', ['navActive' => 'demandes'])

@section('content')
    <a href="{{ $demande->exists ? route('admin.demandes.show', $demande) : route('admin.demandes.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <form method="POST" action="{{ $demande->exists ? route('admin.demandes.update', $demande) : route('admin.demandes.store') }}" class="saas-card mx-auto max-w-3xl space-y-6">
        @csrf
        @if ($demande->exists) @method('PUT') @endif

        <div class="saas-form-group">
            <label class="saas-label">{{ __('roles.client') }} *</label>
            <select name="user_id" required class="saas-input">
                <option value="">{{ __('admin.select_client') }}</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" @selected(old('user_id', $demande->user_id) == $client->id)>{{ $client->name }} ({{ $client->email }})</option>
                @endforeach
            </select>
            @error('user_id')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label class="saas-label">{{ __('demandes.title') }} *</label>
            <input type="text" name="title" value="{{ old('title', $demande->title) }}" required class="saas-input">
        </div>

        <div class="saas-form-group">
            <label class="saas-label">{{ __('demandes.description') ?? 'Description' }} *</label>
            <textarea name="description" rows="5" required class="saas-input">{{ old('description', $demande->description) }}</textarea>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div class="saas-form-group">
                <label class="saas-label">{{ __('demandes.category') }}</label>
                <input type="text" name="category" value="{{ old('category', $demande->category) }}" class="saas-input">
            </div>
            <div class="saas-form-group">
                <label class="saas-label">{{ __('demandes.quantity') ?? 'Quantity' }} *</label>
                <input type="number" min="1" name="quantity" value="{{ old('quantity', $demande->quantity ?? 1) }}" required class="saas-input">
            </div>
            <div class="saas-form-group">
                <label class="saas-label">{{ __('demandes.budget') }}</label>
                <input type="number" step="0.01" min="0" name="budget" value="{{ old('budget', $demande->budget) }}" class="saas-input">
            </div>
            <div class="saas-form-group">
                <label class="saas-label">{{ __('demandes.needed_at') ?? 'Needed at' }}</label>
                <input type="date" name="needed_at" value="{{ old('needed_at', $demande->needed_at?->format('Y-m-d')) }}" class="saas-input">
            </div>
            <div class="saas-form-group">
                <label class="saas-label">{{ __('common.status') }}</label>
                <select name="status" class="saas-input">
                    @foreach (['pending', 'approved', 'rejected', 'completed'] as $s)
                        <option value="{{ $s }}" @selected(old('status', $demande->status ?? 'pending') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="saas-btn-primary">{{ __('common.save') }}</button>
            <a href="{{ route('admin.demandes.index') }}" class="saas-btn-secondary">{{ __('common.cancel') }}</a>
        </div>
    </form>
@endsection
