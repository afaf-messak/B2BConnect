<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-error">{{ __('Delete Account') }}</h2>
        <p class="mt-1 text-sm text-on-surface-variant">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-5 rounded-xl border border-error/30 bg-error/5 p-5" onsubmit="return confirm(@json(__('Are you sure you want to delete your account?')))">
        @csrf
        @method('delete')

        <div class="saas-form-group">
            <label for="password" class="saas-label">{{ __('Password') }}</label>
            <input id="password" name="password" type="password" placeholder="{{ __('Password') }}" class="saas-input max-w-md">
            @error('password', 'userDeletion')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="saas-btn-danger">{{ __('Delete Account') }}</button>
    </form>
</section>
