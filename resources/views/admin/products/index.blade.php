@extends('layouts.saas', ['navActive' => 'products'])

@section('content')
    <section class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest shadow-card">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('products.name') }}</th>
                        <th>{{ __('roles.supplier') }}</th>
                        <th>{{ __('products.price') }}</th>
                        <th>{{ __('products.stock') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="font-semibold">{{ $product->name }}</td>
                            <td>{{ $product->fournisseur?->company_name ?: $product->fournisseur?->name }}</td>
                            <td class="font-bold text-primary">{{ number_format($product->price, 2) }} {{ __('common.currency') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-end">
                                <a href="{{ route('products.show', $product) }}" class="text-sm font-medium text-primary hover:underline">{{ __('common.view') }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="border-t border-outline-variant/20 px-6 py-4">{{ $products->links() }}</div>
        @endif
    </section>
@endsection
