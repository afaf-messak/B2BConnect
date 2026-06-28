@props(['user', 'creating' => false])

<div class="saas-form-group">
    <label class="saas-label">{{ __('admin.full_name') }}</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="saas-input @error('name') saas-input-error @enderror">
    @error('name')<p class="saas-field-error">{{ $message }}</p>@enderror
</div>

<div class="saas-form-group">
    <label class="saas-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="saas-input @error('email') saas-input-error @enderror">
    @error('email')<p class="saas-field-error">{{ $message }}</p>@enderror
</div>

<div class="saas-form-group">
    <label class="saas-label">{{ $creating ? __('admin.password') : __('admin.new_password') }}</label>
    <input type="password" name="password" {{ $creating ? 'required' : '' }} class="saas-input @error('password') saas-input-error @enderror" autocomplete="new-password">
    @if (! $creating)
        <p class="mt-1 text-xs text-on-surface-variant">{{ __('admin.password_optional') }}</p>
    @endif
    @error('password')<p class="saas-field-error">{{ $message }}</p>@enderror
</div>

<div class="saas-form-group">
    <label class="saas-label">{{ __('admin.password_confirm') }}</label>
    <input type="password" name="password_confirmation" {{ $creating ? 'required' : '' }} class="saas-input" autocomplete="new-password">
</div>

<div class="saas-form-group">
    <label class="saas-label">{{ __('admin.company') }}</label>
    <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" class="saas-input">
</div>

<div class="saas-form-group">
    <label class="saas-label">{{ __('admin.ice_number') }}</label>
    <input type="text" name="ice" value="{{ old('ice', $user->ice) }}" class="saas-input">
</div>

<div class="grid gap-4 sm:grid-cols-2">
    <div class="saas-form-group">
        <label class="saas-label">{{ __('roles.role') }}</label>
        <select name="role" class="saas-input">
            @foreach ([\App\Models\User::ROLE_CLIENT, \App\Models\User::ROLE_SUPPLIER, \App\Models\User::ROLE_ADMIN] as $roleOption)
                <option value="{{ $roleOption }}" @selected(old('role', $user->role) === $roleOption)>{{ ucfirst($roleOption) }}</option>
            @endforeach
        </select>
    </div>
    <div class="saas-form-group">
        <label class="saas-label">{{ __('admin.account_status') }}</label>
        <select name="account_status" class="saas-input">
            @foreach ([\App\Models\User::STATUS_ACTIVE, \App\Models\User::STATUS_PENDING, \App\Models\User::STATUS_SUSPENDED, \App\Models\User::STATUS_REJECTED] as $statusOption)
                <option value="{{ $statusOption }}" @selected(old('account_status', $user->account_status ?? \App\Models\User::STATUS_ACTIVE) === $statusOption)>{{ ucfirst($statusOption) }}</option>
            @endforeach
        </select>
    </div>
</div>
