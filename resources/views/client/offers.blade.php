<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SupplyLink - Offers Received</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00288e',
                        surface: '#f8f9ff',
                        'surface-container-low': '#eff4ff',
                        'surface-container-high': '#dce9ff',
                        'surface-container-lowest': '#ffffff',
                        'on-surface': '#0b1c30',
                        'on-surface-variant': '#444653',
                        'outline-variant': '#c4c5d5',
                        error: '#ba1a1a',
                    },
                    fontFamily: {
                        sans: ['Geist', 'sans-serif'],
                    },
                    boxShadow: {
                        soft: '0 4px 20px rgba(15, 23, 42, 0.06)',
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Geist', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>

<body class="bg-surface text-on-surface">
    @php
        $offers = [
            ['id' => '#OF-1208', 'supplier' => 'GlobalTrans Logistics', 'request' => 'Electronics Wholesale Shpt', 'price' => '$1,200', 'delivery' => '3 days', 'status' => 'Pending', 'rating' => '4.9', 'icon' => 'local_shipping'],
            ['id' => '#OF-1214', 'supplier' => 'SwiftLink Air', 'request' => 'Urgent Parts Delivery', 'price' => '$2,400', 'delivery' => 'Next day', 'status' => 'Recommended', 'rating' => '5.0', 'icon' => 'flight_takeoff'],
            ['id' => '#OF-1220', 'supplier' => 'EcoPack Solutions', 'request' => 'Packaging Materials', 'price' => '$840', 'delivery' => '5 days', 'status' => 'Pending', 'rating' => '4.8', 'icon' => 'package_2'],
        ];
    @endphp

    <aside class="fixed left-0 top-0 z-50 flex h-screen w-[280px] flex-col border-r border-outline-variant/40 bg-surface py-8">
        <div class="mb-10 px-8">
            <h1 class="text-xl font-extrabold text-primary">SupplyLink</h1>
            <p class="text-xs font-medium text-on-surface-variant">Logistics Portal</p>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('client.dashboard') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant hover:bg-surface-container-high">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('client.demandes.index') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant hover:bg-surface-container-high">
                <span class="material-symbols-outlined">assignment</span>
                My Requests
            </a>
            <a href="{{ route('client.offers.index') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl bg-[#64a8fe] px-5 text-[#003c70]">
                <span class="material-symbols-outlined">request_quote</span>
                Offers Received
            </a>
            <a href="{{ route('client.suppliers.index') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant hover:bg-surface-container-high">
                <span class="material-symbols-outlined">hub</span>
                Suppliers
            </a>
            <a href="{{ route('profile.edit') }}" class="mx-4 flex h-12 items-center gap-4 rounded-xl px-5 text-on-surface-variant hover:bg-surface-container-high">
                <span class="material-symbols-outlined">person</span>
                Profile
            </a>
        </nav>

        <div class="px-8">
            <a href="{{ route('client.demandes.index') }}" class="flex h-14 items-center justify-center rounded-xl bg-primary font-bold text-white shadow-lg shadow-primary/20">New Request</a>
        </div>
    </aside>

    <main class="ml-[280px] min-h-screen">
        <header class="sticky top-0 z-40 flex h-20 items-center justify-between border-b border-outline-variant/20 bg-surface/90 px-10 backdrop-blur-md">
            <div>
                <h2 class="text-2xl font-extrabold">Offers Received</h2>
                <p class="text-sm text-on-surface-variant">Compare supplier proposals sent for your requests.</p>
            </div>
            <a href="{{ route('client.suppliers.index') }}" class="rounded-full bg-surface-container-low px-5 py-3 text-sm font-bold text-primary hover:bg-surface-container-high">Browse Suppliers</a>
        </header>

        <section class="px-10 py-8">
            <div class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
                <div class="rounded-3xl bg-white p-6 shadow-soft">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Total offers</p>
                    <p class="mt-3 text-4xl font-extrabold text-primary">12</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-soft">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Pending review</p>
                    <p class="mt-3 text-4xl font-extrabold text-on-surface">3</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-soft">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Best price</p>
                    <p class="mt-3 text-4xl font-extrabold text-on-surface">$840</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-outline-variant/40 bg-white shadow-soft">
                <div class="grid grid-cols-[1fr_1.2fr_0.8fr_0.8fr_0.8fr_0.7fr] border-b border-outline-variant/30 px-6 py-4 text-xs font-extrabold uppercase tracking-wider text-on-surface-variant">
                    <span>Supplier</span>
                    <span>Request</span>
                    <span>Price</span>
                    <span>Delivery</span>
                    <span>Status</span>
                    <span class="text-right">Action</span>
                </div>

                @foreach ($offers as $offer)
                    <div class="grid grid-cols-[1fr_1.2fr_0.8fr_0.8fr_0.8fr_0.7fr] items-center border-b border-outline-variant/20 px-6 py-5 last:border-b-0">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-surface-container-low text-primary">
                                <span class="material-symbols-outlined">{{ $offer['icon'] }}</span>
                            </div>
                            <div>
                                <p class="font-bold">{{ $offer['supplier'] }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $offer['id'] }} · {{ $offer['rating'] }} rating</p>
                            </div>
                        </div>
                        <p class="font-medium">{{ $offer['request'] }}</p>
                        <p class="font-extrabold text-primary">{{ $offer['price'] }}</p>
                        <p>{{ $offer['delivery'] }}</p>
                        <span class="w-fit rounded-full bg-surface-container-low px-3 py-1 text-xs font-bold text-primary">{{ $offer['status'] }}</span>
                        <button type="button" class="justify-self-end rounded-full bg-primary px-4 py-2 text-sm font-bold text-white">Review</button>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</body>

</html>
