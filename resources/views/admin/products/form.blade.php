@extends('layouts.saas', ['navActive' => 'products'])

@section('content')
    <a href="{{ route('admin.products.index') }}" class="mb-6 inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        {{ __('common.back') }}
    </a>

    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="saas-card mx-auto max-w-3xl space-y-6">
        @csrf
        @if ($product->exists) @method('PUT') @endif

        <div class="saas-form-group">
            <label class="saas-label">{{ __('roles.supplier') }} *</label>
            <select name="fournisseur_id" required class="saas-input">
                <option value="">{{ __('admin.select_supplier') }}</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected(old('fournisseur_id', $product->fournisseur_id) == $supplier->id)>
                        {{ $supplier->company_name ?: $supplier->name }}
                    </option>
                @endforeach
            </select>
            @error('fournisseur_id')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label class="saas-label">{{ __('products.name') }} *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="saas-input @error('name') saas-input-error @enderror">
            @error('name')<p class="saas-field-error">{{ $message }}</p>@enderror
        </div>

        <div class="saas-form-group">
            <label class="saas-label">{{ __('products.description') }}</label>
            <textarea name="description" rows="4" class="saas-input">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid gap-6 sm:grid-cols-3">
            <div class="saas-form-group">
                <label class="saas-label">{{ __('products.category') ?? 'Category' }}</label>
                <input type="text" name="category" value="{{ old('category', $product->category) }}" class="saas-input">
            </div>
            <div class="saas-form-group">
                <label class="saas-label">{{ __('products.price') }} *</label>
                <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" required class="saas-input">
            </div>
            <div class="saas-form-group">
                <label class="saas-label">{{ __('products.stock') }} *</label>
                <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required class="saas-input">
            </div>
        </div>

        <div class="saas-form-group">
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true)) class="saas-checkbox">
                {{ __('admin.product_active') }}
            </label>
        </div>

        <div class="saas-form-group">
            <label class="saas-label">{{ __('products.image') }}</label>
            @if ($product->imageUrl())
                <div class="mb-4 flex items-center gap-4">
                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-24 w-24 rounded-xl object-cover">
                    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="remove_image" value="1" class="saas-checkbox">{{ __('products.remove_image') }}</label>
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="saas-input file:me-4 file:rounded-lg file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-semibold file:text-on-primary">
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="saas-btn-primary">{{ __('common.save') }}</button>
            <a href="{{ route('admin.products.index') }}" class="saas-btn-secondary">{{ __('common.cancel') }}</a>
        </div>
    </form>
@endsection
