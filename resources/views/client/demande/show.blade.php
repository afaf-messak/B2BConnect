<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $demande->title ?? 'Demande Details' }} - SupplyLink</title>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
                rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet" />
        <style>
                .material-symbols-outlined {
                        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
                }

                .glass-card {
                        background: rgba(255, 255, 255, 0.7);
                        backdrop-filter: blur(24px);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                }
        </style>
        <script id="tailwind-config">
                tailwind.config = {
                        darkMode: "class",
                        theme: {
                                extend: {
                                        "colors": {
                                                "primary-fixed": "#dde1ff",
                                                "primary-container": "#1e40af",
                                                "on-secondary-container": "#003c70",
                                                "error": "#ba1a1a",
                                                "on-tertiary-fixed-variant": "#802a00",
                                                "tertiary-container": "#872d00",
                                                "surface-variant": "#d3e4fe",
                                                "primary": "#00288e",
                                                "on-error-container": "#93000a",
                                                "on-primary-fixed-variant": "#173bab",
                                                "surface-container-lowest": "#ffffff",
                                                "on-primary-fixed": "#001453",
                                                "on-tertiary-fixed": "#380d00",
                                                "secondary-container": "#64a8fe",
                                                "surface": "#f8f9ff",
                                                "surface-tint": "#3755c3",
                                                "on-secondary-fixed-variant": "#004883",
                                                "surface-container": "#e5eeff",
                                                "on-tertiary-container": "#ffa583",
                                                "on-tertiary": "#ffffff",
                                                "on-primary": "#ffffff",
                                                "secondary-fixed-dim": "#a4c9ff",
                                                "surface-container-low": "#eff4ff",
                                                "on-primary-container": "#a8b8ff"
                                        }
                                }
                        }
                };
        </script>
</head>

<body class="bg-surface font-['Geist'] text-on-surface">
        <!-- Header -->
        <header class="border-b border-outline-variant/20 sticky top-0 z-50 bg-surface/95 backdrop-blur">
                <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                                <a href="{{ route('client.demandes.index') }}"
                                        class="p-2 hover:bg-surface-container rounded-full transition">
                                        <span class="material-symbols-outlined text-primary">arrow_back</span>
                                </a>
                                <div>
                                        <h1 class="text-headline-md font-bold text-on-surface">
                                                {{ $demande->title ?? 'Demande Details' }}</h1>
                                        <p class="text-on-surface-variant text-label-sm">Request ID: #{{ $demande->id }}
                                        </p>
                                </div>
                        </div>
                        <div class="flex items-center gap-2">
                                <span
                                        class="px-3 py-1.5 bg-primary/10 text-primary rounded-full text-label-sm font-medium">
                                        {{ ucfirst($demande->status ?? 'pending') }}
                                </span>
                        </div>
                </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-6xl mx-auto px-6 py-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column - Details -->
                        <div class="lg:col-span-2 space-y-6">
                                <!-- Request Overview Card -->
                                <div class="glass-card rounded-2xl p-8 space-y-6">
                                        <div>
                                                <h2 class="text-headline-md font-bold text-on-surface mb-2">Request
                                                        Details</h2>
                                                <p class="text-on-surface-variant text-body-sm">
                                                        {{ $demande->description ?? 'No description provided' }}</p>
                                        </div>

                                        <div class="grid grid-cols-2 gap-6">
                                                <div class="space-y-2">
                                                        <p
                                                                class="text-on-surface-variant text-label-sm uppercase tracking-wider">
                                                                Category</p>
                                                        <p class="text-on-surface font-medium">
                                                                {{ $demande->category ?? 'N/A' }}</p>
                                                </div>
                                                <div class="space-y-2">
                                                        <p
                                                                class="text-on-surface-variant text-label-sm uppercase tracking-wider">
                                                                Budget</p>
                                                        <p class="text-primary font-bold text-headline-sm">
                                                                ${{ number_format($demande->budget ?? 0, 2) }}</p>
                                                </div>
                                                <div class="space-y-2">
                                                        <p
                                                                class="text-on-surface-variant text-label-sm uppercase tracking-wider">
                                                                Quantity</p>
                                                        <p class="text-on-surface font-medium">
                                                                {{ $demande->quantity ?? 'N/A' }} units</p>
                                                </div>
                                                <div class="space-y-2">
                                                        <p
                                                                class="text-on-surface-variant text-label-sm uppercase tracking-wider">
                                                                Deadline</p>
                                                        <p class="text-on-surface font-medium">
                                                                {{ $demande->deadline ? \Carbon\Carbon::parse($demande->deadline)->format('M d, Y') : 'N/A' }}
                                                        </p>
                                                </div>
                                        </div>

                                        <div class="pt-4 border-t border-outline-variant/30">
                                                <h3 class="text-headline-sm font-bold text-on-surface mb-3">Requirements
                                                </h3>
                                                <div class="space-y-2">
                                                        <div class="flex items-start gap-3">
                                                                <span
                                                                        class="material-symbols-outlined text-primary text-[20px] flex-shrink-0 mt-1">check_circle</span>
                                                                <p class="text-body-sm text-on-surface">ISO
                                                                        certification required</p>
                                                        </div>
                                                        <div class="flex items-start gap-3">
                                                                <span
                                                                        class="material-symbols-outlined text-primary text-[20px] flex-shrink-0 mt-1">check_circle</span>
                                                                <p class="text-body-sm text-on-surface">5+ years
                                                                        industry experience</p>
                                                        </div>
                                                        <div class="flex items-start gap-3">
                                                                <span
                                                                        class="material-symbols-outlined text-primary text-[20px] flex-shrink-0 mt-1">check_circle</span>
                                                                <p class="text-body-sm text-on-surface">Delivery within
                                                                        15 business days</p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <!-- Offers Received -->
                                <div class="glass-card rounded-2xl p-8">
                                        <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-headline-md font-bold text-on-surface">Offers Received
                                                </h2>
                                                <span
                                                        class="bg-primary/10 text-primary px-3 py-1 rounded-full font-bold">{{ count($demande->offres ?? []) }}</span>
                                        </div>

                                        @if($demande->offres && count($demande->offres) > 0)
                                                <div class="space-y-4">
                                                        @foreach($demande->offres as $offre)
                                                                <div
                                                                        class="border border-outline-variant/30 rounded-xl p-4 hover:border-primary/50 transition cursor-pointer">
                                                                        <div class="flex items-start justify-between">
                                                                                <div class="flex-1">
                                                                                        <h4 class="font-bold text-on-surface mb-2">
                                                                                                {{ $offre->supplier_name ?? 'Supplier' }}
                                                                                        </h4>
                                                                                        <p
                                                                                                class="text-body-sm text-on-surface-variant mb-3">
                                                                                                {{ $offre->description ?? 'No description' }}
                                                                                        </p>
                                                                                        <div class="flex items-center gap-4">
                                                                                                <span
                                                                                                        class="text-headline-sm font-bold text-primary">${{ number_format($offre->price ?? 0, 2) }}</span>
                                                                                                <span
                                                                                                        class="text-label-sm text-on-surface-variant">Delivery:
                                                                                                        {{ $offre->delivery_days ?? 'N/A' }}
                                                                                                        days</span>
                                                                                        </div>
                                                                                </div>
                                                                                <span
                                                                                        class="material-symbols-outlined text-on-surface-variant">arrow_forward</span>
                                                                        </div>
                                                                </div>
                                                        @endforeach
                                                </div>
                                        @else
                                                <div class="text-center py-8">
                                                        <span
                                                                class="material-symbols-outlined text-on-surface-variant text-[48px]">mail</span>
                                                        <p class="text-on-surface-variant mt-4">No offers yet. Offers will
                                                                appear here.</p>
                                                </div>
                                        @endif
                                </div>

                                <!-- Messages -->
                                <div class="glass-card rounded-2xl p-8">
                                        <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-headline-md font-bold text-on-surface">Messages</h2>
                                                <span
                                                        class="bg-primary/10 text-primary px-3 py-1 rounded-full font-bold">{{ count($demande->messages ?? []) }}</span>
                                        </div>

                                        <div class="space-y-4 max-h-96 overflow-y-auto">
                                                @if($demande->messages && count($demande->messages) > 0)
                                                        @foreach($demande->messages as $message)
                                                                <div
                                                                        class="flex gap-4 pb-4 border-b border-outline-variant/20 last:border-b-0">
                                                                        <div class="w-10 h-10 bg-primary/10 rounded-full flex-shrink-0">
                                                                        </div>
                                                                        <div class="flex-1">
                                                                                <div class="flex items-center gap-2 mb-1">
                                                                                        <p class="font-medium text-on-surface text-sm">
                                                                                                {{ $message->sender ?? 'User' }}</p>
                                                                                        <p
                                                                                                class="text-label-xs text-on-surface-variant">
                                                                                                {{ $message->created_at ? $message->created_at->format('M d, H:i') : 'Now' }}
                                                                                        </p>
                                                                                </div>
                                                                                <p class="text-body-sm text-on-surface-variant">
                                                                                        {{ $message->content ?? 'Message' }}</p>
                                                                        </div>
                                                                </div>
                                                        @endforeach
                                                @else
                                                        <div class="text-center py-8">
                                                                <span
                                                                        class="material-symbols-outlined text-on-surface-variant text-[40px]">chat_bubble_outline</span>
                                                                <p class="text-on-surface-variant mt-3">No messages yet</p>
                                                        </div>
                                                @endif
                                        </div>
                                </div>
                        </div>

                        <!-- Right Column - Sidebar -->
                        <div class="space-y-6">
                                <!-- Requester Info -->
                                <div class="glass-card rounded-2xl p-6 space-y-4">
                                        <h3 class="text-headline-sm font-bold text-on-surface">Requester</h3>
                                        <div class="flex items-center gap-4">
                                                <div
                                                        class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                                        <span
                                                                class="material-symbols-outlined text-primary">account_circle</span>
                                                </div>
                                                <div class="flex-1">
                                                        <p class="font-medium text-on-surface">
                                                                {{ $demande->user->name ?? 'Unknown' }}</p>
                                                        <p class="text-label-sm text-on-surface-variant">
                                                                {{ $demande->user->email ?? 'N/A' }}</p>
                                                </div>
                                        </div>
                                        <button
                                                class="w-full bg-primary/10 text-primary py-2 rounded-lg hover:bg-primary/20 transition font-medium text-label-sm">
                                                Contact Requester
                                        </button>
                                </div>

                                <!-- Timeline -->
                                <div class="glass-card rounded-2xl p-6 space-y-4">
                                        <h3 class="text-headline-sm font-bold text-on-surface">Timeline</h3>
                                        <div class="space-y-3">
                                                <div class="flex gap-3">
                                                        <div
                                                                class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                                                <span
                                                                        class="material-symbols-outlined text-on-primary text-[16px]">check</span>
                                                        </div>
                                                        <div>
                                                                <p class="font-medium text-on-surface text-sm">Request
                                                                        Created</p>
                                                                <p class="text-label-xs text-on-surface-variant">
                                                                        {{ $demande->created_at ? $demande->created_at->format('M d, Y') : 'N/A' }}
                                                                </p>
                                                        </div>
                                                </div>
                                                <div class="flex gap-3">
                                                        <div
                                                                class="w-8 h-8 border-2 border-primary rounded-full flex-shrink-0 mt-1">
                                                        </div>
                                                        <div>
                                                                <p class="font-medium text-on-surface text-sm">Offers
                                                                        Deadline</p>
                                                                <p class="text-label-xs text-on-surface-variant">
                                                                        {{ $demande->deadline ? \Carbon\Carbon::parse($demande->deadline)->format('M d, Y') : 'N/A' }}
                                                                </p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <!-- Actions -->
                                <div class="glass-card rounded-2xl p-6 space-y-3">
                                        <button
                                                class="w-full bg-primary text-on-primary py-3 rounded-lg hover:shadow-lg transition font-bold flex items-center justify-center gap-2">
                                                <span class="material-symbols-outlined">edit</span>
                                                Edit Request
                                        </button>
                                        <button
                                                class="w-full bg-error/10 text-error py-3 rounded-lg hover:bg-error/20 transition font-bold flex items-center justify-center gap-2">
                                                <span class="material-symbols-outlined">delete</span>
                                                Delete Request
                                        </button>
                                </div>
                        </div>
                </div>
        </main>
</body>

</html>
