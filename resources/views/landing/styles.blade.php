<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    /* ── Typography ── */
    .landing-gradient-text {
        background: linear-gradient(135deg, #6366f1 0%, #a78bfa 30%, #38bdf8 65%, #22d3ee 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradient 8s ease infinite;
    }

    .landing-display {
        letter-spacing: -0.03em;
        line-height: 1.05;
    }

    /* ── Backgrounds ── */
    .landing-aurora {
        background:
            radial-gradient(ellipse 90% 60% at 50% -30%, rgba(99, 102, 241, 0.35), transparent 70%),
            radial-gradient(ellipse 50% 40% at 90% 10%, rgba(167, 139, 250, 0.2), transparent 60%),
            radial-gradient(ellipse 45% 35% at 5% 80%, rgba(56, 189, 248, 0.15), transparent 60%),
            radial-gradient(ellipse 30% 25% at 70% 90%, rgba(99, 102, 241, 0.12), transparent 60%);
    }

    .dark .landing-aurora {
        background:
            radial-gradient(ellipse 90% 60% at 50% -30%, rgba(99, 102, 241, 0.22), transparent 70%),
            radial-gradient(ellipse 50% 40% at 90% 10%, rgba(167, 139, 250, 0.14), transparent 60%),
            radial-gradient(ellipse 45% 35% at 5% 80%, rgba(56, 189, 248, 0.1), transparent 60%);
    }

    .landing-mesh {
        background:
            radial-gradient(ellipse 80% 50% at 50% -20%, rgba(99, 102, 241, 0.2), transparent),
            radial-gradient(ellipse 60% 40% at 100% 0%, rgba(139, 92, 246, 0.12), transparent),
            radial-gradient(ellipse 50% 30% at 0% 100%, rgba(59, 130, 246, 0.1), transparent);
    }

    .grid-pattern {
        background-image:
            linear-gradient(rgba(99, 102, 241, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(99, 102, 241, 0.04) 1px, transparent 1px);
        background-size: 72px 72px;
        mask-image: radial-gradient(ellipse 80% 70% at 50% 50%, black 30%, transparent 100%);
    }

    .dark .grid-pattern {
        background-image:
            linear-gradient(rgba(99, 102, 241, 0.07) 1px, transparent 1px),
            linear-gradient(90deg, rgba(99, 102, 241, 0.07) 1px, transparent 1px);
    }

    .section-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
    }

    /* ── Glass ── */
    .glass {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(24px) saturate(180%);
        -webkit-backdrop-filter: blur(24px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .dark .glass {
        background: rgba(39, 39, 50, 0.75);
        border: 1px solid rgba(161, 161, 170, 0.18);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.72);
        backdrop-filter: blur(28px) saturate(180%);
        -webkit-backdrop-filter: blur(28px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.65);
        box-shadow:
            0 0 0 1px rgba(255, 255, 255, 0.4) inset,
            0 4px 24px rgba(15, 23, 42, 0.06),
            0 24px 48px rgba(15, 23, 42, 0.04);
    }

    .dark .glass-card {
        background: rgba(39, 39, 50, 0.82);
        border: 1px solid rgba(161, 161, 170, 0.22);
        box-shadow:
            0 0 0 1px rgba(255, 255, 255, 0.04) inset,
            0 12px 40px rgba(0, 0, 0, 0.25);
    }

    .gradient-border {
        position: relative;
        background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(167,139,250,0.08), rgba(56,189,248,0.12));
        padding: 1px;
        border-radius: 1.25rem;
    }

    .gradient-border > .gradient-border-inner {
        border-radius: calc(1.25rem - 1px);
        background: rgba(255, 255, 255, 0.85);
    }

    .dark .gradient-border > .gradient-border-inner {
        background: rgba(15, 15, 18, 0.92);
    }

    /* ── Buttons ── */
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #7c3aed 100%);
        background-size: 200% auto;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.45), 0 0 0 1px rgba(255,255,255,0.1) inset;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-primary:hover {
        background-position: right center;
        transform: translateY(-2px);
        box-shadow: 0 12px 36px rgba(99, 102, 241, 0.55), 0 0 0 1px rgba(255,255,255,0.15) inset;
    }

    .btn-glass {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.14);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .btn-outline {
        border: 1px solid rgba(99, 102, 241, 0.25);
        background: rgba(99, 102, 241, 0.04);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-outline:hover {
        border-color: rgba(99, 102, 241, 0.5);
        background: rgba(99, 102, 241, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.15);
    }

    .dark .btn-outline {
        border-color: rgba(129, 140, 248, 0.3);
        background: rgba(99, 102, 241, 0.08);
    }

    /* ── Cards ── */
    .premium-card {
        transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .premium-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow:
            0 24px 48px rgba(15, 23, 42, 0.12),
            0 0 0 1px rgba(99, 102, 241, 0.1);
    }

    .dark .premium-card:hover {
        box-shadow:
            0 32px 64px rgba(0, 0, 0, 0.5),
            0 0 0 1px rgba(99, 102, 241, 0.2);
    }

    .feature-card {
        transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .feature-card:hover {
        transform: translateY(-6px);
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(-3deg);
    }

    .feature-icon {
        transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glow-brand {
        box-shadow: 0 0 80px rgba(99, 102, 241, 0.3), 0 0 160px rgba(139, 92, 246, 0.12);
    }

    .dark .glow-brand {
        box-shadow: 0 0 100px rgba(99, 102, 241, 0.2), 0 0 200px rgba(139, 92, 246, 0.08);
    }

    /* ── Particles & shapes ── */
    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        animation: float 8s ease-in-out infinite;
    }

    .shape-blob {
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        animation: morph 12s ease-in-out infinite;
    }

    @keyframes morph {
        0%, 100% { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
        50% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    }

    /* ── Nav ── */
    .nav-scrolled {
        background: rgba(250, 250, 250, 0.82) !important;
        backdrop-filter: blur(24px) saturate(180%);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.04);
    }

    .dark .nav-scrolled {
        background: rgba(26, 27, 35, 0.88) !important;
        border-bottom: 1px solid rgba(161, 161, 170, 0.15);
    }

    /* ── Hero dashboard ── */
    .hero-dashboard {
        perspective: 1400px;
    }

    .hero-dashboard-inner {
        transform: rotateX(6deg) rotateY(-6deg);
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hero-dashboard:hover .hero-dashboard-inner {
        transform: rotateX(2deg) rotateY(-2deg) scale(1.015);
    }

    /* ── Marquee ── */
    .marquee-track {
        animation: marquee 40s linear infinite;
    }

    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ── Steps connector ── */
    .step-connector {
        background: linear-gradient(90deg, rgba(99,102,241,0.5), rgba(167,139,250,0.3), transparent);
    }

    /* ── FAQ ── */
    .faq-item[open] summary .faq-icon {
        transform: rotate(45deg);
    }

    .faq-item summary::-webkit-details-marker { display: none; }

    /* ── Chat typing ── */
    .typing-dot {
        animation: typing 1.4s ease-in-out infinite;
    }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typing {
        0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
        30% { transform: translateY(-4px); opacity: 1; }
    }

    /* ── Product card shine ── */
    .product-shine {
        position: relative;
        overflow: hidden;
    }

    .product-shine::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.12) 50%, transparent 60%);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .product-shine:hover::after {
        transform: translateX(100%);
    }

    /* ── Stat pill ── */
    .stats-section {
        background: linear-gradient(160deg, #312e81 0%, #1e1b4b 45%, #18181b 100%);
    }

    html.dark .stats-section {
        background: linear-gradient(160deg, #3730a3 0%, #1e1b4b 40%, #27272a 100%);
    }

    .stat-pill {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(12px);
    }

    html.dark .stat-pill {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(165, 180, 252, 0.35);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(129, 140, 248, 0.12) inset;
    }

    /* ── Section label ── */
    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 1rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        background: rgba(99, 102, 241, 0.08);
        border: 1px solid rgba(99, 102, 241, 0.15);
        color: #4f46e5;
    }

    .dark .section-label {
        background: rgba(99, 102, 241, 0.12);
        border-color: rgba(99, 102, 241, 0.25);
        color: #a5b4fc;
    }

    /* ── Nav links ── */
    .nav-link {
        position: relative;
        transition: color 0.3s ease, background 0.3s ease, transform 0.3s ease;
    }

    .nav-link-active {
        color: #4f46e5 !important;
        font-weight: 600;
        background: rgba(99, 102, 241, 0.1);
    }

    .dark .nav-link-active {
        color: #a5b4fc !important;
        background: rgba(99, 102, 241, 0.15);
    }

    .nav-link-active::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 50%;
        width: 16px;
        height: 3px;
        border-radius: 9999px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        transform: translateX(-50%) scaleX(0);
        animation: nav-underline-in 0.35s cubic-bezier(0.4, 0, 0.2, 1) forwards,
                   nav-glow 2.5s ease-in-out 0.35s infinite;
    }

    @keyframes nav-underline-in {
        to { transform: translateX(-50%) scaleX(1); }
    }

    @keyframes nav-glow {
        0%, 100% { box-shadow: 0 0 6px rgba(99, 102, 241, 0.5); opacity: 1; }
        50% { box-shadow: 0 0 12px rgba(139, 92, 246, 0.7); opacity: 0.85; }
    }

    .nav-link-mobile-active {
        color: #4f46e5 !important;
        font-weight: 600;
        background: rgba(99, 102, 241, 0.1) !important;
        border-left: 3px solid #6366f1;
    }

    .dark .nav-link-mobile-active {
        color: #a5b4fc !important;
        background: rgba(99, 102, 241, 0.15) !important;
        border-left-color: #818cf8;
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
        .marquee-track { animation: none; }
    }
</style>
