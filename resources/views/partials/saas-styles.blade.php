<style>
    :root {
        --sidebar-width: 280px;
        --sidebar-collapsed-width: 80px;
        --navbar-height: 64px;
        --transition-base: 280ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    html.sidebar-collapsed { --sidebar-width: var(--sidebar-collapsed-width); }

    .saas-sidebar {
        width: var(--sidebar-width);
        transition: width var(--transition-base), transform var(--transition-base);
    }

    .saas-main {
        margin-inline-start: var(--sidebar-width);
        transition: margin-inline-start var(--transition-base);
        min-height: 100vh;
    }

    @media (max-width: 1023px) {
        .saas-sidebar {
            transform: translateX(calc(-100% - 1px));
            box-shadow: 0 25px 50px rgba(15, 23, 42, 0.15);
        }
        html[dir="rtl"] .saas-sidebar { transform: translateX(calc(100% + 1px)); }
        html.sidebar-mobile-open .saas-sidebar { transform: translateX(0) !important; }
        .saas-main { margin-inline-start: 0; }
    }

    .saas-nav-label, .saas-brand-text, .saas-sidebar-footer-text {
        transition: opacity var(--transition-base), max-width var(--transition-base);
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
    }

    html.sidebar-collapsed .saas-nav-label,
    html.sidebar-collapsed .saas-brand-text,
    html.sidebar-collapsed .saas-sidebar-footer-text {
        opacity: 0; max-width: 0; margin: 0; pointer-events: none;
    }

    html.sidebar-collapsed .saas-nav-item { justify-content: center; padding-inline: 0.75rem; }
    html.sidebar-collapsed .saas-nav-badge { position: absolute; top: 0.35rem; inset-inline-end: 0.35rem; }

    .glass-card {
        background: rgba(255, 255, 255, 0.78);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(196, 197, 213, 0.45);
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
        transition: box-shadow var(--transition-base), transform var(--transition-base);
    }

    .glass-card:hover { box-shadow: 0 12px 32px rgba(15, 23, 42, 0.08); }

    .saas-card {
        border-radius: 1rem;
        border: 1px solid rgba(196, 197, 213, 0.35);
        background: #ffffff;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
    }

    @media (max-width: 640px) {
        .saas-card { padding: 1.25rem; }
    }

    html.dark .saas-card { background: #213145; border-color: rgba(117, 118, 132, 0.3); }

    .saas-dropdown {
        position: absolute;
        inset-inline-end: 0;
        top: 100%;
        z-index: 50;
        margin-top: 0.5rem;
        min-width: 10rem;
        transform: scale(0.95);
        border-radius: 0.75rem;
        border: 1px solid rgba(196, 197, 213, 0.3);
        background: #ffffff;
        padding: 0.25rem;
        opacity: 0;
        pointer-events: none;
        box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        transition: opacity 200ms, transform 200ms;
    }

    html.dark .saas-dropdown { background: #213145; }

    .saas-dropdown.open { transform: scale(1); opacity: 1; pointer-events: auto; }

    .saas-dropdown-item {
        display: flex; width: 100%; align-items: center; gap: 0.5rem;
        border-radius: 0.5rem; padding: 0.5rem 0.75rem; font-size: 0.875rem;
        transition: background-color 150ms;
    }

    .saas-dropdown-item:hover { background: #eff4ff; }
    html.dark .saas-dropdown-item:hover { background: #2a3a50; }
    .saas-dropdown-item.active { background: rgba(100, 168, 254, 0.3); font-weight: 600; color: #00288e; }

    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
    html.dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #475569; }

    #saas-overlay { transition: opacity var(--transition-base); }
    html.sidebar-mobile-open #saas-overlay { pointer-events: auto; opacity: 1; }

    .saas-nav-item.active,
    .saas-nav-item[aria-current="page"] {
        background-color: rgba(100, 168, 254, 0.35);
        color: #003c70;
    }

    html.dark .saas-nav-item.active,
    html.dark .saas-sidebar .bg-secondary-container {
        background-color: rgba(55, 85, 195, 0.45) !important;
        color: #dbe6ff !important;
    }

    html, body, .saas-sidebar, .saas-main, .glass-card, .saas-card {
        transition: background-color 300ms ease, color 300ms ease, border-color 300ms ease;
    }
</style>
