@extends('layouts.saas', [
    'title' => ($product->exists ? __('products.edit') : __('products.new')) . ' - ' . __('common.app_name'),
    'pageTitle' => $product->exists ? __('products.edit') : __('products.new'),
    'navActive' => 'products',
])

@section('content')
    <a href="{{ route('supplier.products.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <form method="POST" action="{{ $product->exists ? route('supplier.products.update', $product) : route('supplier.products.store') }}" enctype="multipart/form-data" class="saas-card mx-auto max-w-3xl space-y-6">
        @csrf
        @if ($product->exists) @method('PUT') @endif

        <div class="saas-form-group">
            <label for="name" class="saas-label">{{ __('products.name') }} *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="saas-input @error('name') saas-input-error @enderror">
            @error('name')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label for="description" class="saas-label">{{ __('products.description') }}</label>
            <textarea id="description" name="description" rows="4" class="saas-input @error('description') saas-input-error @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div class="saas-form-group">
                <label for="price" class="saas-label">{{ __('products.price') }} ({{ __('common.currency') }}) *</label>
                <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $product->price) }}" required class="saas-input @error('price') saas-input-error @enderror">
                @error('price')<p class="saas-field-error">{{ $message }}</p>@enderror
            </div>
            <div class="saas-form-group">
                <label for="stock" class="saas-label">{{ __('products.stock') }} *</label>
                <input type="number" min="0" id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required class="saas-input @error('stock') saas-input-error @enderror">
                @error('stock')<p class="saas-field-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="saas-form-group">
            <label for="image" class="saas-label">{{ __('products.image') }}</label>
            @if ($product->imageUrl())
                <div class="mb-4 flex items-center gap-4">
                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-24 w-24 rounded-xl object-cover">
                    <label class="flex items-center gap-2 text-sm text-on-surface-variant">
                        <input type="checkbox" name="remove_image" value="1" class="saas-checkbox">
                        {{ __('products.remove_image') }}
                    </label>
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*" class="saas-input file:me-4 file:rounded-lg file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-semibold file:text-on-primary">
            @error('image')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="flex flex-wrap gap-3 pt-2">
            <button type="submit" class="saas-btn-primary">{{ __('common.save') }}</button>
            <a href="{{ route('supplier.products.index') }}" class="saas-btn-secondary">{{ __('common.cancel') }}</a>
        </div>
    </form>
@endsection
