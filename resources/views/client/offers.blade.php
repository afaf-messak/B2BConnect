@extends('layouts.saas', [
    'title' => __('nav.offers_received') . ' - ' . __('common.app_name'),
    'pageTitle' => __('nav.offers_received'),
    'navActive' => 'offers',
])

@section('header-actions')
    <a href="{{ route('client.suppliers.index') }}" class="saas-btn-secondary">{{ __('nav.suppliers') }}</a>
@endsection

@section('content')
    @php
        $offers = [
            ['id' => '#OF-1208', 'supplier' => 'GlobalTrans Logistics', 'request' => 'Electronics Wholesale Shpt', 'price' => '$1,200', 'delivery' => '3 days', 'status' => 'Pending', 'rating' => '4.9', 'icon' => 'local_shipping'],
            ['id' => '#OF-1214', 'supplier' => 'SwiftLink Air', 'request' => 'Urgent Parts Delivery', 'price' => '$2,400', 'delivery' => 'Next day', 'status' => 'Recommended', 'rating' => '5.0', 'icon' => 'flight_takeoff'],
            ['id' => '#OF-1220', 'supplier' => 'EcoPack Solutions', 'request' => 'Packaging Materials', 'price' => '$840', 'delivery' => '5 days', 'status' => 'Pending', 'rating' => '4.8', 'icon' => 'package_2'],
        ];
    @endphp

    <div class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
        @foreach ([['Total offers', '12'], ['Pending review', '3'], ['Best price', '$840']] as [$label, $value])
            <article class="saas-card">
                <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">{{ $label }}</p>
                <p class="mt-3 text-4xl font-extrabold text-primary">{{ $value }}</p>
            </article>
        @endforeach
    </div>

    <section class="saas-panel">
        <div class="overflow-x-auto">
            <table class="saas-table">
                <thead>
                    <tr>
                        <th>{{ __('nav.suppliers') }}</th>
                        <th>{{ __('nav.demandes') }}</th>
                        <th>{{ __('products.price') }}</th>
                        <th>Delivery</th>
                        <th>{{ __('common.status') }}</th>
                        <th class="text-end">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary">{{ $offer['icon'] }}</span>
                                    <div>
                                        <p class="font-bold">{{ $offer['supplier'] }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $offer['id'] }} · {{ $offer['rating'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $offer['request'] }}</td>
                            <td class="font-bold text-primary">{{ $offer['price'] }}</td>
                            <td>{{ $offer['delivery'] }}</td>
                            <td><span class="saas-badge saas-badge-primary">{{ $offer['status'] }}</span></td>
                            <td class="text-end"><button type="button" class="saas-btn-primary saas-btn-sm">{{ __('common.view') }}</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
