@extends('layouts.saas', ['navActive' => 'demandes'])

@section('content')
    <section class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest shadow-card">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('demandes.title') }}</th>
                        <th>{{ __('roles.client') }}</th>
                        <th>{{ __('demandes.budget') }}</th>
                        <th>{{ __('demandes.category') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($demandes as $demande)
                        <tr>
                            <td class="font-semibold">{{ $demande->title }}</td>
                            <td>{{ $demande->user?->company_name ?: $demande->user?->name }}</td>
                            <td>{{ $demande->budget ? number_format($demande->budget, 2).' '.__('common.currency') : '—' }}</td>
                            <td>{{ $demande->category ?: '—' }}</td>
                            <td><span class="rounded-full bg-secondary-container/30 px-2 py-0.5 text-xs font-semibold text-primary">{{ ucfirst($demande->status) }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('supplier.demandes.quote', $demande) }}" class="saas-btn-primary py-1.5 text-xs">{{ __('marketplace.submit_quotation') }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-on-surface-variant">{{ __('common.no_results') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($demandes->hasPages())
            <div class="border-t border-outline-variant/20 px-6 py-4">{{ $demandes->links() }}</div>
        @endif
    </section>
@endsection
