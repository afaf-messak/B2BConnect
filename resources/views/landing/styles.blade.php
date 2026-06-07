<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .landing-gradient-text {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 35%, #3b82f6 70%, #06b6d4 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradient 8s ease infinite;
    }

    .landing-mesh {
        background:
            radial-gradient(ellipse 80% 50% at 50% -20%, rgba(99, 102, 241, 0.25), transparent),
            radial-gradient(ellipse 60% 40% at 100% 0%, rgba(139, 92, 246, 0.15), transparent),
            radial-gradient(ellipse 50% 30% at 0% 100%, rgba(59, 130, 246, 0.12), transparent);
    }

    .dark .landing-mesh {
        background:
            radial-gradient(ellipse 80% 50% at 50% -20%, rgba(99, 102, 241, 0.18), transparent),
            radial-gradient(ellipse 60% 40% at 100% 0%, rgba(139, 92, 246, 0.12), transparent),
            radial-gradient(ellipse 50% 30% at 0% 100%, rgba(59, 130, 246, 0.08), transparent);
    }

    .glass {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .dark .glass {
        background: rgba(24, 24, 27, 0.65);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06), 0 0 0 1px rgba(255, 255, 255, 0.5) inset;
    }

    .dark .glass-card {
        background: rgba(24, 24, 27, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.06);
        box-shadow: 0 4px 32px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.04) inset;
    }

    .glow-brand {
        box-shadow: 0 0 60px rgba(99, 102, 241, 0.35), 0 0 120px rgba(139, 92, 246, 0.15);
    }

    .dark .glow-brand {
        box-shadow: 0 0 80px rgba(99, 102, 241, 0.25), 0 0 160px rgba(139, 92, 246, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(99, 102, 241, 0.5);
    }

    .btn-secondary {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        background: rgba(99, 102, 241, 0.08);
    }

    .feature-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);
    }

    .dark .feature-card:hover {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        animation: float 8s ease-in-out infinite;
    }

    .grid-pattern {
        background-image:
            linear-gradient(rgba(99, 102, 241, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(99, 102, 241, 0.03) 1px, transparent 1px);
        background-size: 64px 64px;
    }

    .dark .grid-pattern {
        background-image:
            linear-gradient(rgba(99, 102, 241, 0.06) 1px, transparent 1px),
            linear-gradient(90deg, rgba(99, 102, 241, 0.06) 1px, transparent 1px);
    }

    .shimmer-border {
        background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.4), transparent);
        background-size: 200% 100%;
        animation: shimmer 2.5s linear infinite;
    }

    .nav-scrolled {
        background: rgba(250, 250, 250, 0.85) !important;
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
    }

    .dark .nav-scrolled {
        background: rgba(9, 9, 11, 0.85) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .faq-item[open] summary .faq-icon {
        transform: rotate(45deg);
    }

    .hero-dashboard {
        perspective: 1200px;
    }

    .hero-dashboard-inner {
        transform: rotateX(8deg) rotateY(-8deg);
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hero-dashboard:hover .hero-dashboard-inner {
        transform: rotateX(4deg) rotateY(-4deg) scale(1.02);
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
