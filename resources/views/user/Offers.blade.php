<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "on-primary-container": "#a8b8ff",
                        "tertiary": "#611e00",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "secondary": "#0060ac",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-surface": "#0b1c30",
                        "background": "#f8f9ff",
                        "on-secondary-fixed": "#001c39",
                        "inverse-surface": "#213145",
                        "on-background": "#0b1c30",
                        "surface-dim": "#cbdbf5",
                        "error-container": "#ffdad6",
                        "surface-container-high": "#dce9ff",
                        "tertiary-fixed": "#ffdbce",
                        "primary-fixed-dim": "#b8c4ff",
                        "outline": "#757684",
                        "inverse-primary": "#b8c4ff",
                        "surface-container-highest": "#d3e4fe",
                        "outline-variant": "#c4c5d5",
                        "on-surface-variant": "#444653",
                        "secondary-fixed": "#d4e3ff",
                        "surface-bright": "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "unit": "8px",
                        "container-max": "1440px",
                        "margin-desktop": "40px",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "body-md": ["Geist"],
                        "label-md": ["Geist"],
                        "body-lg": ["Geist"],
                        "headline-md": ["Geist"],
                        "display-lg": ["Geist"],
                        "label-sm": ["Geist"],
                        "headline-lg": ["Geist"]
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Geist', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-background text-on-background">
<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-screen w-[280px] bg-surface dark:bg-surface-dim border-r border-outline-variant/30 dark:border-outline/30 flex flex-col h-full py-8 z-50">
<div class="px-8 mb-10 flex items-center gap-3">
<div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-on-primary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
</div>
<div>
<h1 class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed">SupplyLink</h1>
<p class="text-[10px] uppercase tracking-wider text-outline">Logistics Portal</p>
</div>
</div>
<nav class="flex-grow flex flex-col">
<a class="flex items-center gap-4 px-6 py-3 font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all hover:translate-x-1 duration-200" href="#">
<span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
<a class="flex items-center gap-4 px-6 py-3 font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all hover:translate-x-1 duration-200" href="#">
<span class="material-symbols-outlined">assignment</span>
                Demandes
            </a>
<a class="flex items-center gap-4 px-6 py-3 font-label-md text-label-md bg-secondary-container dark:bg-primary-container text-on-secondary-container dark:text-on-primary-container rounded-xl mx-4 mb-2 transition-all hover:translate-x-1 duration-200" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_offer</span>
                Offres
            </a>
<a class="flex items-center gap-4 px-6 py-3 font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all hover:translate-x-1 duration-200" href="#">
<span class="material-symbols-outlined">mail</span>
                Messages
            </a>
<a class="flex items-center gap-4 px-6 py-3 font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-high mx-4 mb-2 rounded-xl transition-all hover:translate-x-1 duration-200" href="#">
<span class="material-symbols-outlined">person</span>
                Profile
            </a>
</nav>
<div class="mt-auto px-4 space-y-2">
<button class="w-full flex items-center justify-center gap-2 bg-primary text-on-primary py-3 rounded-xl font-label-md shadow-lg active:scale-[0.98] transition-all">
<span class="material-symbols-outlined">add</span>
                New Request
            </button>
<div class="pt-6 border-t border-outline-variant/20">
<a class="flex items-center gap-4 px-6 py-3 font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">settings</span>
                    Settings
                </a>
<a class="flex items-center gap-4 px-6 py-3 font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">help</span>
                    Help
                </a>
</div>
</div>
</aside>
<!-- Main Content Wrapper -->
<main class="ml-[280px] min-h-screen">
<!-- TopAppBar -->
<header class="fixed top-0 right-0 left-[280px] z-40 bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-md border-b border-outline-variant/10 flex justify-between items-center h-16 px-8 shadow-sm">
<div class="flex items-center bg-surface-container-low rounded-full px-4 py-2 w-96 border border-outline-variant/20 focus-within:ring-2 focus-within:ring-primary transition-all">
<span class="material-symbols-outlined text-outline">search</span>
<input class="bg-transparent border-none focus:ring-0 text-body-md w-full ml-2" placeholder="Search offers, routes, or suppliers..." type="text"/>
</div>
<div class="flex items-center gap-4">
<button class="hover:bg-surface-container-highest rounded-full p-2 transition-all">
<span class="material-symbols-outlined text-on-surface-variant">notifications</span>
</button>
<button class="hover:bg-surface-container-highest rounded-full p-2 transition-all">
<span class="material-symbols-outlined text-on-surface-variant">chat_bubble</span>
</button>
<button class="hover:bg-surface-container-highest rounded-full p-2 transition-all">
<span class="material-symbols-outlined text-on-surface-variant">settings</span>
</button>
<div class="h-8 w-px bg-outline-variant/30 mx-2"></div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="text-label-sm font-bold text-on-surface">Alex Durand</p>
<p class="text-[10px] text-outline">Logistics Manager</p>
</div>
<img alt="User Profile" class="w-10 h-10 rounded-full object-cover border border-outline-variant/50" data-alt="A professional headshot of a middle-aged logistics manager with a confident and friendly expression. He is wearing a sharp, navy blue business casual shirt, set against a clean, softly blurred office background with cool tones. The lighting is high-quality studio lighting, creating a bright and trustworthy professional aesthetic that aligns with a modern corporate supply chain management platform." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCt7dlaHliG50Hvk56ny8cHZo7lLxX-X-TyJ-Dts8h6vNJXCGc1g447EC67R0RTV-Cs5_5YN12upMgNXpPFCuipi6Nw3YgMn4GbjZ1ROzxV93-tBBKR89wWERqtoVftBMjjDPwndX1NRWBvyCdLd6Xf_fYOkLzjTfqSd8eODPKI7LRw-S8xAVm1_LC2QsYM0dDrJFzvxDSeDX64uzObt7YFy7FPq_IjNsJtdVcdNUO6qPHnA_4EnSf_zchyj1QRr4j89IASgxmDMuI"/>
</div>
</div>
</header>
<!-- Page Content -->
<div class="pt-24 px-10 pb-12 max-w-container-max mx-auto">
<div class="flex justify-between items-end mb-10">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-2">Offres Récentes</h2>
<p class="text-body-md text-on-surface-variant max-w-2xl">Gérez vos propositions logistiques entrantes. Comparez les tarifs, les délais et la fiabilité des transporteurs en temps réel.</p>
</div>
<div class="flex gap-3">
<button class="px-6 py-2.5 rounded-xl border border-outline text-label-md font-bold hover:bg-surface-container transition-all">
                        Filtrer
                    </button>
<button class="px-6 py-2.5 rounded-xl bg-primary text-on-primary text-label-md font-bold shadow-lg shadow-primary/20 hover:opacity-90 transition-all">
                        Exporter (CSV)
                    </button>
</div>
</div>
<!-- Bento Grid of Offers -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Main Featured Offer -->
<div class="lg:col-span-8 group">
<div class="bg-white rounded-[32px] p-8 shadow-sm border border-outline-variant/50 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
<div class="absolute top-0 right-0 p-6">
<span class="bg-secondary-container text-on-secondary-container px-4 py-1.5 rounded-full text-label-sm font-bold uppercase tracking-widest">Recommandé</span>
</div>
<div class="flex items-start gap-6 mb-8">
<div class="w-16 h-16 rounded-2xl bg-surface-container flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-4xl">inventory_2</span>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">TransLogistics Global</h3>
<p class="text-body-md text-outline">Trajet: Paris (FR) → Berlin (DE)</p>
</div>
</div>
<div class="grid grid-cols-3 gap-8 mb-10">
<div class="p-6 rounded-2xl bg-surface-container-low border border-outline-variant/20">
<p class="text-label-sm text-outline mb-1">Prix Total</p>
<p class="text-headline-md font-bold text-primary">€1,250.00</p>
</div>
<div class="p-6 rounded-2xl bg-surface-container-low border border-outline-variant/20">
<p class="text-label-sm text-outline mb-1">Livraison Estimée</p>
<p class="text-headline-md font-bold text-on-surface">48 Heures</p>
</div>
<div class="p-6 rounded-2xl bg-surface-container-low border border-outline-variant/20">
<p class="text-label-sm text-outline mb-1">Type de Cargo</p>
<p class="text-headline-md font-bold text-on-surface">Fragile</p>
</div>
</div>
<div class="flex items-center justify-between border-t border-outline-variant/30 pt-8">
<div class="flex items-center gap-4">
<div class="flex -space-x-2">
<div class="w-8 h-8 rounded-full border-2 border-white bg-green-500 flex items-center justify-center text-[10px] text-white font-bold">98%</div>
</div>
<p class="text-label-sm text-on-surface-variant">Taux de fiabilité du transporteur</p>
</div>
<div class="flex gap-4">
<button class="px-8 py-3 rounded-xl border-2 border-error/20 text-error font-bold text-label-md hover:bg-error-container/20 transition-all">Refuser</button>
<button class="px-10 py-3 rounded-xl bg-primary text-on-primary font-bold text-label-md shadow-lg shadow-primary/30 active:scale-95 transition-all">Accepter l'offre</button>
</div>
</div>
</div>
</div>
<!-- Secondary Offers Column -->
<div class="lg:col-span-4 space-y-gutter">
<!-- Card 2 -->
<div class="bg-white rounded-[24px] p-6 shadow-sm border border-outline-variant/50 hover:shadow-md transition-all group">
<div class="flex justify-between items-start mb-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-tertiary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-tertiary">rocket_launch</span>
</div>
<div>
<h4 class="font-label-md font-bold text-on-surface">SwiftPath Express</h4>
<p class="text-[12px] text-outline">24h Express</p>
</div>
</div>
<p class="text-label-md font-bold text-primary">€1,890</p>
</div>
<div class="space-y-4 mb-6">
<div class="flex justify-between text-label-sm">
<span class="text-outline">Assurance incluse</span>
<span class="text-green-600 font-bold">OUI</span>
</div>
<div class="flex justify-between text-label-sm">
<span class="text-outline">Suivi en direct</span>
<span class="text-green-600 font-bold">OUI</span>
</div>
</div>
<div class="grid grid-cols-2 gap-3">
<button class="py-2 rounded-lg border border-outline-variant text-label-sm font-bold text-on-surface-variant hover:bg-surface-container transition-all">Rejeter</button>
<button class="py-2 rounded-lg bg-primary-container text-on-primary-container text-label-sm font-bold hover:opacity-90 transition-all">Choisir</button>
</div>
</div>
<!-- Card 3 -->
<div class="bg-white rounded-[24px] p-6 shadow-sm border border-outline-variant/50 hover:shadow-md transition-all group">
<div class="flex justify-between items-start mb-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-secondary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-secondary">eco</span>
</div>
<div>
<h4 class="font-label-md font-bold text-on-surface">EcoShip FR</h4>
<p class="text-[12px] text-outline">Transport Durable</p>
</div>
</div>
<p class="text-label-md font-bold text-primary">€950</p>
</div>
<div class="space-y-4 mb-6">
<div class="flex justify-between text-label-sm">
<span class="text-outline">Empreinte CO2</span>
<span class="text-secondary font-bold">-45%</span>
</div>
<div class="flex justify-between text-label-sm">
<span class="text-outline">Délai</span>
<span class="text-on-surface-variant font-bold">5 Jours</span>
</div>
</div>
<div class="grid grid-cols-2 gap-3">
<button class="py-2 rounded-lg border border-outline-variant text-label-sm font-bold text-on-surface-variant hover:bg-surface-container transition-all">Rejeter</button>
<button class="py-2 rounded-lg bg-secondary text-white text-label-sm font-bold hover:opacity-90 transition-all">Choisir</button>
</div>
</div>
</div>
<!-- Bottom Summary / Visual Section -->
<div class="lg:col-span-12">
<div class="glass-card rounded-[32px] p-10 flex flex-col md:flex-row items-center gap-12 border border-primary/10">
<div class="flex-1">
<h3 class="font-headline-md text-headline-md text-primary mb-4">Analyse de Performance</h3>
<p class="text-body-md text-on-surface-variant mb-6">Le coût moyen de vos offres actuelles est en baisse de 12% par rapport au mois dernier. SupplyLink vous recommande de finaliser l'offre de "TransLogistics Global" pour optimiser vos flux.</p>
<div class="flex gap-8">
<div>
<p class="text-display-lg font-bold text-on-surface">14</p>
<p class="text-label-sm text-outline uppercase tracking-widest">Offres en attente</p>
</div>
<div class="w-px bg-outline-variant/50 h-16"></div>
<div>
<p class="text-display-lg font-bold text-on-surface">€1.1k</p>
<p class="text-label-sm text-outline uppercase tracking-widest">Prix Moyen</p>
</div>
</div>
</div>
<div class="w-full md:w-1/3 aspect-video bg-surface-container-high rounded-2xl overflow-hidden relative border border-outline-variant/20">
<img alt="Logistics Distribution Center" class="w-full h-full object-cover opacity-80" data-alt="A wide-angle interior shot of a massive, technologically advanced logistics distribution center filled with organized shelving and high-tech machinery. The space is illuminated by bright, cool-toned industrial LED lighting, emphasizing a clean and efficient workspace. The scene features a professional blue and grey color palette, conveying stability and precision in a modern supply chain environment." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQDyuHmpxu6skkrzpMTYg0brNJR4WZdh5MatmNHa5axX9bTwGUqgzIfOm7HfxC9-hAb6Bj8fF3VpkCsMaZFrxzx-l8KW-llD63Dzk24VkxiMoWKmT8mcJgp4c0Z_Xj2IeT1kxOokWQFH6DfENRCSPkb1oKH5h49aOz0fHwvPCvCk9RT0ECpzqhxaPCitJkwG5Ev1acDTHz4xQRjMZdNsvUKWSMbWjdBu-rhAs5CW55oots9NLsNXSh7tqYXDyth2ZJSqw7FeQhuDs"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent"></div>
<div class="absolute bottom-4 left-4 flex items-center gap-2">
<span class="w-3 h-3 bg-green-500 rounded-full"></span>
<span class="text-label-sm font-bold text-white shadow-sm">Flux de réseau optimisé</span>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Footer -->
<footer class="relative w-full bg-surface-container-low dark:bg-inverse-surface border-t border-outline-variant/50 grid grid-cols-1 md:grid-cols-4 gap-8 py-12 px-margin-desktop max-w-container-max mx-auto">
<div class="md:col-span-1">
<h4 class="font-headline-sm text-headline-sm text-primary font-bold mb-4">SupplyLink</h4>
<p class="text-label-sm text-on-surface-variant dark:text-surface-variant">La plateforme intelligente pour une logistique transparente et efficace à travers le monde.</p>
</div>
<div>
<h5 class="font-label-md font-bold text-on-surface mb-4">Plateforme</h5>
<ul class="space-y-2">
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">Solution</a></li>
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">Tarification</a></li>
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">API</a></li>
</ul>
</div>
<div>
<h5 class="font-label-md font-bold text-on-surface mb-4">Entreprise</h5>
<ul class="space-y-2">
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">À Propos</a></li>
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">Blog</a></li>
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">Contact</a></li>
</ul>
</div>
<div>
<h5 class="font-label-md font-bold text-on-surface mb-4">Légal</h5>
<ul class="space-y-2">
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">Privacy Policy</a></li>
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">Terms of Service</a></li>
<li><a class="font-label-sm text-on-surface-variant hover:text-primary underline-offset-4 hover:underline transition-colors" href="#">Security</a></li>
</ul>
</div>
<div class="md:col-span-4 border-t border-outline-variant/30 pt-8 flex justify-between items-center">
<p class="font-label-sm text-on-surface-variant dark:text-surface-variant">© 2024 SupplyLink Logistics. All rights reserved.</p>
<div class="flex gap-6">
<span class="material-symbols-outlined text-outline cursor-pointer hover:text-primary transition-colors">language</span>
<span class="material-symbols-outlined text-outline cursor-pointer hover:text-primary transition-colors">help_outline</span>
</div>
</div>
</footer>
</main>
</body></html>