<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('partials.theme-init')
<title>{{ $title ?? __('common.app_name') }}</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    background: '#f8f9ff',
                    surface: '#f8f9ff',
                    'surface-container-lowest': '#ffffff',
                    'surface-container-low': '#eff4ff',
                    'surface-container': '#e5eeff',
                    'surface-container-high': '#dce9ff',
                    'surface-container-highest': '#d3e4fe',
                    primary: '#00288e',
                    'primary-container': '#1e40af',
                    'on-primary': '#ffffff',
                    'on-primary-container': '#dbe6ff',
                    secondary: '#0060ac',
                    'secondary-container': '#64a8fe',
                    'on-secondary-container': '#003c70',
                    tertiary: '#611e00',
                    error: '#ba1a1a',
                    'on-surface': '#0b1c30',
                    'on-background': '#0b1c30',
                    'on-surface-variant': '#444653',
                    outline: '#757684',
                    'outline-variant': '#c4c5d5',
                },
                fontFamily: {
                    sans: ['Geist', 'ui-sans-serif', 'system-ui'],
                },
                boxShadow: {
                    soft: '0 18px 50px rgba(15, 23, 42, 0.08)',
                    card: '0 4px 20px rgba(15, 23, 42, 0.05)',
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
        background: rgba(255, 255, 255, 0.74);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(196, 197, 213, 0.55);
    }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
</style>
@include('partials.theme-styles')
