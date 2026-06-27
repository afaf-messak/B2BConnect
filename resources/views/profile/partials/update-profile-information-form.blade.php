<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-on-surface">{{ __('Profile Information') }}</h2>
        <p class="mt-1 text-sm text-on-surface-variant">{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div class="saas-form-group">
            <label for="name" class="saas-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="saas-input">
            @error('name')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label for="email" class="saas-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="saas-input">
            @error('email')<p class="saas-field-error">{{ $message }}</p>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="mt-2 text-sm text-on-surface-variant">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" type="submit" class="font-semibold text-primary underline">{{ __('Click here to re-send the verification email.') }}</button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600">{{ __('A new verification link has been sent to your email address.') }}</p>
                @endif
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <button type="submit" class="saas-btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm font-medium text-green-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
