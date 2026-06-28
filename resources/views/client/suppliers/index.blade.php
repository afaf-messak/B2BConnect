@extends('layouts.saas', [
    'title' => __('nav.suppliers') . ' - ' . __('common.app_name'),
    'pageTitle' => __('nav.suppliers'),
    'pageSubtitle' => __('common.portal'),
    'navActive' => 'suppliers',
])

@section('content')
    <form method="GET" class="mb-8 flex gap-4 glass-card p-5">
        <input type="search" name="q" value="{{ $filters['q'] }}" placeholder="{{ __('common.search') }}" class="saas-input flex-1">
        <button type="submit" class="rounded-xl bg-secondary-container px-5 py-2.5 text-sm font-semibold text-on-secondary-container">{{ __('common.filter') }}</button>
    </form>

    @if ($suppliers->isEmpty())
        <div class="saas-card border-dashed text-center">
            <span class="material-symbols-outlined mb-4 text-5xl text-outline">storefront</span>
            <h3 class="text-lg font-semibold">{{ __('common.no_results') }}</h3>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($suppliers as $supplier)
                <article class="saas-card transition hover:-translate-y-0.5">
                    <div class="flex items-start gap-4">
                        <div class="grid h-14 w-14 place-items-center rounded-2xl bg-primary text-lg font-bold text-on-primary">
                            {{ strtoupper(substr($supplier->company_name ?: $supplier->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="truncate text-lg font-bold">{{ $supplier->company_name ?: $supplier->name }}</h3>
                            <p class="text-sm text-on-surface-variant">{{ $supplier->name }}</p>
                            <p class="mt-2 text-xs font-medium text-secondary">{{ $supplier->products_count }} {{ __('nav.products') }}</p>
                        </div>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('client.suppliers.show', $supplier) }}" class="saas-btn-primary flex-1 py-2.5">{{ __('common.view') }}</a>
                        <a href="{{ route('messages.show', $supplier) }}" class="saas-btn-secondary flex-1 py-2.5">{{ __('nav.messages') }}</a>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-8">{{ $suppliers->links() }}</div>
    @endif
@endsection
