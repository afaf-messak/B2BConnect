@extends('layouts.saas', ['navActive' => 'products'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle">
        <x-slot:actions>
            <a href="{{ route('admin.products.create') }}" class="saas-btn-primary">{{ __('admin.add_product') }}</a>
        </x-slot:actions>
    </x-saas.page-header>
    <x-admin.stats-row :stats="$stats" />

    <x-admin.filter-bar :action="route('admin.products.index')">
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('common.search') }}" class="saas-input min-w-[200px] flex-1">
        <select name="active" class="saas-input w-auto">
            <option value="">{{ __('common.status') }}</option>
            <option value="1" @selected(($filters['active'] ?? '') === '1')>{{ __('common.active') }}</option>
            <option value="0" @selected(($filters['active'] ?? '') === '0')>{{ __('common.inactive') ?? 'Inactive' }}</option>
        </select>
    </x-admin.filter-bar>

    <section class="saas-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('products.name') }}</th>
                        <th>{{ __('roles.supplier') }}</th>
                        <th>{{ __('products.category') ?? 'Category' }}</th>
                        <th>{{ __('products.price') }}</th>
                        <th>{{ __('products.stock') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="font-semibold">{{ $product->name }}</td>
                            <td>{{ $product->fournisseur?->company_name ?: $product->fournisseur?->name }}</td>
                            <td>{{ $product->category ?: '—' }}</td>
                            <td class="font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td><span class="saas-badge {{ $product->is_active ? 'saas-badge-success' : 'saas-badge-warning' }}">{{ $product->is_active ? __('common.active') : __('common.inactive') ?? 'Inactive' }}</span></td>
                            <td class="text-end">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="saas-btn-secondary saas-btn-sm">{{ __('common.edit') }}</a>
                                    <a href="{{ route('products.show', $product) }}" class="saas-btn-ghost saas-btn-sm">{{ __('common.view') }}</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">@csrf @method('DELETE')<button type="submit" class="saas-btn-danger saas-btn-sm">{{ __('common.delete') }}</button></form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())<div class="border-t px-6 py-4">{{ $products->links() }}</div>@endif
    </section>
@endsection
