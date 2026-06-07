<style>
    /* ── Buttons ─────────────────────────────────────────────── */
    .saas-btn-primary,
    .saas-btn-secondary,
    .saas-btn-danger,
    .saas-btn-ghost {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        min-height: 2.5rem;
        padding: 0.625rem 1.25rem;
        border-radius: 0.75rem;
        border: 1px solid transparent;
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.25rem;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
        transition: background-color 200ms ease, border-color 200ms ease, color 200ms ease, box-shadow 200ms ease, transform 150ms ease, opacity 200ms ease;
        -webkit-tap-highlight-color: transparent;
    }

    .saas-btn-primary:active,
    .saas-btn-secondary:active,
    .saas-btn-danger:active {
        transform: scale(0.98);
    }

    .saas-btn-primary:disabled,
    .saas-btn-secondary:disabled,
    .saas-btn-danger:disabled {
        opacity: 0.55;
        cursor: not-allowed;
        transform: none;
    }

    .saas-btn-primary {
        background-color: #00288e;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(0, 40, 142, 0.22);
    }

    .saas-btn-primary:hover {
        background-color: #001f6e;
        box-shadow: 0 6px 20px rgba(0, 40, 142, 0.28);
    }

    .saas-btn-primary:focus-visible {
        outline: 2px solid #64a8fe;
        outline-offset: 2px;
    }

    .saas-btn-secondary {
        background-color: #ffffff;
        color: #00288e;
        border-color: rgba(196, 197, 213, 0.65);
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .saas-btn-secondary:hover {
        background-color: #eff4ff;
        border-color: rgba(0, 40, 142, 0.25);
    }

    .saas-btn-secondary:focus-visible {
        outline: 2px solid #64a8fe;
        outline-offset: 2px;
    }

    .saas-btn-danger {
        background-color: #ba1a1a;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(186, 26, 26, 0.2);
    }

    .saas-btn-danger:hover {
        background-color: #93000a;
    }

    .saas-btn-ghost {
        background-color: transparent;
        color: #444653;
        border-color: transparent;
    }

    .saas-btn-ghost:hover {
        background-color: #eff4ff;
        color: #00288e;
    }

    .saas-btn-sm {
        min-height: 2rem;
        padding: 0.375rem 0.875rem;
        font-size: 0.75rem;
        border-radius: 0.5rem;
    }

    .saas-btn-lg {
        min-height: 3rem;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 0.875rem;
    }

    .saas-btn-icon {
        display: inline-grid;
        place-items: center;
        width: 2.5rem;
        height: 2.5rem;
        min-height: 2.5rem;
        padding: 0;
        border-radius: 9999px;
    }

    a.saas-btn-primary,
    a.saas-btn-secondary,
    a.saas-btn-danger {
        text-decoration: none;
    }

    .saas-btn-social {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        min-height: 3rem;
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: 1px solid rgba(196, 197, 213, 0.75);
        background-color: #ffffff;
        color: #0b1c30;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 200ms ease, border-color 200ms ease, box-shadow 200ms ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .saas-btn-social:hover {
        background-color: #eff4ff;
        border-color: rgba(0, 40, 142, 0.25);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
    }

    html.dark .saas-btn-social {
        background-color: #1a2d42;
        border-color: rgba(117, 118, 132, 0.45);
        color: #eaf1ff;
    }

    html.dark .saas-btn-social:hover {
        background-color: #2a3a50;
    }

    /* ── Forms ───────────────────────────────────────────────── */
    .saas-label {
        display: block;
        margin-bottom: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #0b1c30;
    }

    .saas-label-muted {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #444653;
    }

    .saas-input,
    .saas-select,
    .saas-textarea {
        display: block;
        width: 100%;
        min-height: 2.75rem;
        padding: 0.625rem 0.875rem;
        border-radius: 0.75rem;
        border: 1px solid rgba(196, 197, 213, 0.75);
        background-color: #ffffff;
        color: #0b1c30;
        font-size: 0.875rem;
        line-height: 1.5;
        transition: border-color 200ms ease, box-shadow 200ms ease, background-color 200ms ease;
    }

    .saas-textarea {
        min-height: 5rem;
        resize: vertical;
    }

    textarea.saas-input {
        min-height: 5rem;
        resize: vertical;
    }

    .saas-input::placeholder,
    .saas-textarea::placeholder {
        color: #757684;
    }

    .saas-input:hover,
    .saas-select:hover,
    .saas-textarea:hover {
        border-color: rgba(0, 40, 142, 0.35);
    }

    .saas-input:focus,
    .saas-select:focus,
    .saas-textarea:focus {
        outline: none;
        border-color: #00288e;
        box-shadow: 0 0 0 3px rgba(100, 168, 254, 0.35);
    }

    .saas-input:disabled,
    .saas-select:disabled,
    .saas-textarea:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        background-color: #eff4ff;
    }

    .saas-input-error {
        border-color: #ba1a1a !important;
        box-shadow: 0 0 0 3px rgba(186, 26, 26, 0.15) !important;
    }

    .saas-field-error {
        margin-top: 0.375rem;
        font-size: 0.8125rem;
        font-weight: 500;
        color: #ba1a1a;
    }

    .saas-form-group {
        display: flex;
        flex-direction: column;
        gap: 0.375rem;
    }

    .saas-checkbox,
    .saas-radio {
        width: 1rem;
        height: 1rem;
        border-radius: 0.25rem;
        border-color: rgba(196, 197, 213, 0.85);
        color: #00288e;
    }

    .saas-checkbox:focus,
    .saas-radio:focus {
        ring-color: #64a8fe;
    }

    select.saas-input,
    select.saas-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23444653'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1rem;
        padding-right: 2.5rem;
    }

    html[dir="rtl"] select.saas-input,
    html[dir="rtl"] select.saas-select {
        background-position: left 0.75rem center;
        padding-right: 0.875rem;
        padding-left: 2.5rem;
    }

    input[type="file"].saas-input {
        padding: 0.5rem;
        cursor: pointer;
    }

    input[type="file"].saas-input::file-selector-button {
        margin-inline-end: 1rem;
        border: 0;
        border-radius: 0.5rem;
        background-color: #00288e;
        padding: 0.5rem 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #ffffff;
        cursor: pointer;
    }

    html.dark input[type="file"].saas-input::file-selector-button {
        background-color: #3755c3;
    }

    /* ── Cards (layout partial) ──────────────────────────────── */
    .saas-panel {
        overflow: hidden;
        border-radius: 1rem;
        border: 1px solid rgba(196, 197, 213, 0.35);
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
    }

    .saas-panel-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        border-bottom: 1px solid rgba(196, 197, 213, 0.3);
        padding: 1rem 1.5rem;
    }

    .saas-panel-body {
        padding: 1.5rem;
    }

    .saas-panel-footer {
        border-top: 1px solid rgba(196, 197, 213, 0.25);
        padding: 1rem 1.5rem;
    }

    /* ── Tables ──────────────────────────────────────────────── */
    .saas-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .saas-table thead {
        background-color: #eff4ff;
    }

    .saas-table th {
        padding: 0.875rem 1.5rem;
        text-align: start;
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #444653;
        white-space: nowrap;
    }

    .saas-table td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        border-top: 1px solid rgba(196, 197, 213, 0.25);
        color: #0b1c30;
    }

    .saas-table tbody tr {
        transition: background-color 150ms ease;
    }

    .saas-table tbody tr:hover {
        background-color: rgba(239, 244, 255, 0.65);
    }

    .saas-table .text-end,
    .saas-table th.text-end,
    .saas-table td.text-end {
        text-align: end;
    }

    /* ── Badges ──────────────────────────────────────────────── */
    .saas-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 9999px;
        padding: 0.25rem 0.625rem;
        font-size: 0.6875rem;
        font-weight: 700;
        line-height: 1;
    }

    .saas-badge-primary {
        background-color: rgba(100, 168, 254, 0.3);
        color: #00288e;
    }

    .saas-badge-success {
        background-color: rgba(34, 197, 94, 0.15);
        color: #15803d;
    }

    .saas-badge-warning {
        background-color: rgba(234, 179, 8, 0.15);
        color: #a16207;
    }

    .saas-badge-error {
        background-color: rgba(186, 26, 26, 0.12);
        color: #ba1a1a;
    }

    /* ── Alerts ──────────────────────────────────────────────── */
    .saas-alert {
        margin-bottom: 1.5rem;
        border-radius: 0.75rem;
        border: 1px solid transparent;
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
    }

    .saas-alert-error {
        border-color: rgba(186, 26, 26, 0.25);
        background-color: #fef2f2;
        color: #991b1b;
    }

    .saas-alert-success {
        border-color: rgba(34, 197, 94, 0.25);
        background-color: #f0fdf4;
        color: #166534;
    }

    .saas-alert-info {
        border-color: rgba(0, 40, 142, 0.2);
        background-color: #eff4ff;
        color: #00288e;
    }

    /* ── Pagination ──────────────────────────────────────────── */
    .saas-pagination nav {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 0.25rem;
    }

    .saas-pagination nav > div:first-child {
        display: none;
    }

    .saas-pagination span,
    .saas-pagination a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.25rem;
        min-height: 2.25rem;
        padding: 0.375rem 0.625rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: background-color 150ms ease, color 150ms ease;
    }

    .saas-pagination a {
        color: #444653;
        text-decoration: none;
    }

    .saas-pagination a:hover {
        background-color: #eff4ff;
        color: #00288e;
    }

    .saas-pagination span[aria-current="page"] span,
    .saas-pagination .bg-white {
        background-color: #00288e !important;
        color: #ffffff !important;
        border-radius: 0.5rem;
    }

    /* ── Navbar action alignment ─────────────────────────────── */
    .saas-navbar .saas-btn-primary,
    .saas-navbar .saas-btn-secondary {
        min-height: 2.5rem;
        height: 2.5rem;
        padding-inline: 1rem;
    }

    .saas-header-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.5rem;
    }

    /* ── Dark mode ───────────────────────────────────────────── */
    html.dark .saas-btn-primary {
        background-color: #3755c3;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(55, 85, 195, 0.25);
    }

    html.dark .saas-btn-primary:hover {
        background-color: #4a6ad4;
    }

    html.dark .saas-btn-secondary {
        background-color: #1a2d42;
        color: #b8c4ff;
        border-color: rgba(117, 118, 132, 0.45);
    }

    html.dark .saas-btn-secondary:hover {
        background-color: #2a3a50;
        border-color: rgba(184, 196, 255, 0.35);
    }

    html.dark .saas-btn-ghost {
        color: #c4c5d5;
    }

    html.dark .saas-btn-ghost:hover {
        background-color: #2a3a50;
        color: #b8c4ff;
    }

    html.dark .saas-label {
        color: #eaf1ff;
    }

    html.dark .saas-label-muted {
        color: #c4c5d5;
    }

    html.dark .saas-panel {
        background: #213145;
        border-color: rgba(117, 118, 132, 0.3);
    }

    html.dark .saas-table thead {
        background-color: #1a2d42;
    }

    html.dark .saas-table th {
        color: #c4c5d5;
    }

    html.dark .saas-table td {
        color: #eaf1ff;
        border-top-color: rgba(117, 118, 132, 0.25);
    }

    html.dark .saas-badge-primary {
        background-color: rgba(55, 85, 195, 0.35);
        color: #dbe6ff;
    }

    html.dark .saas-badge-success {
        background-color: rgba(34, 197, 94, 0.2);
        color: #86efac;
    }

    html.dark .saas-badge-error {
        background-color: rgba(186, 26, 26, 0.25);
        color: #fca5a5;
    }

    html.dark .saas-alert-error {
        background-color: rgba(127, 29, 29, 0.35);
        border-color: rgba(248, 113, 113, 0.3);
        color: #fecaca;
    }

    html.dark .saas-alert-success {
        background-color: rgba(20, 83, 45, 0.35);
        border-color: rgba(74, 222, 128, 0.25);
        color: #bbf7d0;
    }

    html.dark .saas-pagination a:hover {
        background-color: #2a3a50;
        color: #b8c4ff;
    }

    html.dark .glass-card {
        background: rgba(21, 37, 54, 0.88);
        border-color: rgba(117, 118, 132, 0.35);
    }
</style>
