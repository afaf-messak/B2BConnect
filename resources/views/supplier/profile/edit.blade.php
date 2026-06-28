@extends('layouts.saas', ['navActive' => 'company'])

@section('content')
    <a href="{{ route('supplier.profile') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <form method="POST" action="{{ route('supplier.profile.update') }}" class="saas-card max-w-3xl space-y-6">
        @csrf @method('PUT')

        <div>
            <label class="saas-label">{{ __('common.company') }}</label>
            <input type="text" name="company_name" value="{{ old('company_name', $supplier->company_name) }}" class="saas-input mt-1">
        </div>

        <div>
            <label class="saas-label">{{ __('marketplace.tagline') }}</label>
            <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" class="saas-input mt-1">
        </div>

        <div>
            <label class="saas-label">{{ __('marketplace.bio') }}</label>
            <textarea name="bio" rows="6" class="saas-input mt-1">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="saas-label">{{ __('marketplace.industry') }}</label>
                <input type="text" name="industry" value="{{ old('industry', $profile->industry) }}" class="saas-input mt-1">
            </div>
            <div>
                <label class="saas-label">{{ __('marketplace.city') }}</label>
                <input type="text" name="city" value="{{ old('city', $profile->city) }}" class="saas-input mt-1">
            </div>
            <div>
                <label class="saas-label">{{ __('marketplace.location') }} (region)</label>
                <input type="text" name="region" value="{{ old('region', $profile->region) }}" class="saas-input mt-1">
            </div>
            <div>
                <label class="saas-label">{{ __('marketplace.location') }} (country)</label>
                <input type="text" name="country" value="{{ old('country', $profile->country) }}" class="saas-input mt-1">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="saas-label">{{ __('marketplace.website') }}</label>
                <input type="url" name="website" value="{{ old('website', $profile->website) }}" class="saas-input mt-1">
            </div>
            <div>
                <label class="saas-label">{{ __('common.phone') }}</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="saas-input mt-1">
            </div>
        </div>

        <div>
            <label class="saas-label">{{ __('marketplace.response_time') }}</label>
            <input type="number" name="response_time_hours" min="1" max="168" value="{{ old('response_time_hours', $profile->response_time_hours) }}" class="saas-input mt-1 w-32">
        </div>

        <label class="flex items-center gap-3">
            <input type="checkbox" name="is_public" value="1" @checked(old('is_public', $profile->is_public)) class="rounded border-outline-variant">
            <span class="text-sm font-medium">{{ __('marketplace.is_public') }}</span>
        </label>

        <button type="submit" class="saas-btn-primary">{{ __('common.save') }}</button>
    </form>
@endsection
