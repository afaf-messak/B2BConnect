<style>
    /* ── Soft dark palette (shared) ── */
    html.dark {
        color-scheme: dark;
    }

    html.dark body {
        background-color: #1a1b23 !important;
        background-image:
            radial-gradient(ellipse 80% 55% at 50% -15%, rgba(99, 102, 241, 0.14), transparent 65%),
            radial-gradient(ellipse 45% 35% at 100% 0%, rgba(139, 92, 246, 0.08), transparent 55%),
            radial-gradient(ellipse 40% 30% at 0% 100%, rgba(56, 189, 248, 0.06), transparent 55%) !important;
        color: #e4e4e7 !important;
    }

    /* ── SaaS / portal surfaces ── */
    html.dark .bg-background,
    html.dark.bg-background {
        background-color: #1a1b23 !important;
    }

    html.dark .bg-surface {
        background-color: #22232d !important;
    }

    html.dark .text-on-background,
    html.dark .text-on-surface {
        color: #f4f4f5 !important;
    }

    html.dark .text-on-surface-variant {
        color: #a1a1aa !important;
    }

    html.dark .bg-surface-container-lowest {
        background-color: #1e1f28 !important;
    }

    html.dark .bg-surface-container-low {
        background-color: #272830 !important;
    }

    html.dark .bg-surface-container {
        background-color: #2e303c !important;
    }

    html.dark .bg-surface-container-high {
        background-color: #363845 !important;
    }

    html.dark .bg-surface-container-highest {
        background-color: #3f4250 !important;
    }

    html.dark .bg-secondary-container {
        background-color: #3730a3 !important;
    }

    html.dark .text-on-secondary-container {
        color: #e0e7ff !important;
    }

    html.dark .glass-card {
        background: rgba(39, 39, 50, 0.82) !important;
        border-color: rgba(161, 161, 170, 0.22) !important;
        box-shadow:
            0 0 0 1px rgba(255, 255, 255, 0.04) inset,
            0 12px 40px rgba(0, 0, 0, 0.25) !important;
    }

    html.dark .glass {
        background: rgba(39, 39, 50, 0.75) !important;
        border-color: rgba(161, 161, 170, 0.18) !important;
    }

    html.dark .saas-card {
        background: #2e303c !important;
        border-color: rgba(161, 161, 170, 0.2) !important;
    }

    html.dark .saas-panel {
        background: #272830 !important;
        border-color: rgba(161, 161, 170, 0.18) !important;
    }

    html.dark .saas-input,
    html.dark input:not([type="checkbox"]):not([type="radio"]),
    html.dark select,
    html.dark textarea {
        background-color: #272830 !important;
        color: #f4f4f5 !important;
        border-color: rgba(161, 161, 170, 0.28) !important;
    }

    html.dark .saas-input::placeholder,
    html.dark input::placeholder,
    html.dark textarea::placeholder {
        color: #71717a !important;
    }

    html.dark .saas-table tbody tr:hover {
        background: rgba(99, 102, 241, 0.08);
    }

    html.dark .saas-table thead {
        background: #272830 !important;
    }

    html.dark .saas-table th {
        color: #d4d4d8 !important;
    }

    html.dark .saas-table td {
        color: #e4e4e7 !important;
        border-color: rgba(161, 161, 170, 0.15) !important;
    }

    html.dark aside,
    html.dark #saas-sidebar,
    html.dark .bg-surface\/90 {
        background-color: rgba(30, 31, 40, 0.96) !important;
    }

    html.dark header,
    html.dark .saas-navbar {
        background-color: rgba(30, 31, 40, 0.92) !important;
        border-color: rgba(161, 161, 170, 0.18) !important;
    }

    html.dark .bg-white {
        background-color: #2e303c !important;
    }

    html.dark .text-primary {
        color: #a5b4fc !important;
    }

    html.dark .text-zinc-900 {
        color: #f4f4f5 !important;
    }

    html.dark .text-zinc-800 {
        color: #e4e4e7 !important;
    }

    html.dark .text-zinc-700 {
        color: #d4d4d8 !important;
    }

    html.dark .text-zinc-600 {
        color: #a1a1aa !important;
    }

    html.dark .text-zinc-500 {
        color: #71717a !important;
    }

    html.dark .border-zinc-200,
    html.dark .border-zinc-200\/60,
    html.dark .border-zinc-200\/80 {
        border-color: rgba(161, 161, 170, 0.22) !important;
    }

    html.dark .border-outline-variant\/10,
    html.dark .border-outline-variant\/20,
    html.dark .border-outline-variant\/30,
    html.dark .border-outline-variant\/40 {
        border-color: rgba(161, 161, 170, 0.22) !important;
    }

    html.dark .bg-zinc-50 {
        background-color: #22232d !important;
    }

    html.dark .bg-zinc-50\/80,
    html.dark .bg-zinc-50\/50 {
        background-color: rgba(39, 39, 50, 0.65) !important;
    }

    html.dark .hover\:bg-zinc-100:hover {
        background-color: #363845 !important;
    }

    html.dark [data-theme-toggle] {
        background-color: #272830;
        color: #c7d2fe;
        border-color: rgba(161, 161, 170, 0.25);
    }

    html.dark .nav-scrolled {
        background: rgba(26, 27, 35, 0.88) !important;
        border-bottom-color: rgba(161, 161, 170, 0.15) !important;
    }

    html.dark .b2b-logo-img {
        filter: drop-shadow(0 0 12px rgba(147, 197, 253, 0.35));
    }

    .b2b-logo-img {
        vertical-align: middle;
    }

    html.dark .hero-dashboard .glass-card {
        background: rgba(46, 48, 60, 0.92) !important;
        border-color: rgba(165, 180, 252, 0.28) !important;
    }

    html.dark .premium-card:hover {
        box-shadow:
            0 24px 48px rgba(0, 0, 0, 0.35),
            0 0 0 1px rgba(129, 140, 248, 0.18) !important;
    }
</style>
