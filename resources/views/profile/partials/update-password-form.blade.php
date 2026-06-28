<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-on-surface">{{ __('Update Password') }}</h2>
        <p class="mt-1 text-sm text-on-surface-variant">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div class="saas-form-group">
            <label for="update_password_current_password" class="saas-label">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" class="saas-input">
            @error('current_password', 'updatePassword')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label for="update_password_password" class="saas-label">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" class="saas-input">
            @error('password', 'updatePassword')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label for="update_password_password_confirmation" class="saas-label">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="saas-input">
            @error('password_confirmation', 'updatePassword')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <button type="submit" class="saas-btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'password-updated')
                <p class="text-sm font-medium text-green-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
