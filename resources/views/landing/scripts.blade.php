<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('landingPage', () => ({
            mobileOpen: false,
            scrolled: false,
            parallax: { x: 0, y: 0 },

            init() {
                this.onScroll();
                window.addEventListener('scroll', () => this.onScroll(), { passive: true });
                window.addEventListener('mousemove', (e) => {
                    this.parallax.x = e.clientX - window.innerWidth / 2;
                    this.parallax.y = e.clientY - window.innerHeight / 2;
                }, { passive: true });
            },

            onScroll() {
                this.scrolled = window.scrollY > 20;
            },
        }));

        Alpine.data('counter', (target, suffix = '') => ({
            display: '0' + suffix,
            animated: false,

            observe(el) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting && !this.animated) {
                            this.animated = true;
                            this.animate(target, suffix);
                        }
                    });
                }, { threshold: 0.5 });

                observer.observe(el);
            },

            animate(target, suffix) {
                const duration = 2000;
                const start = performance.now();
                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(eased * target);
                    this.display = (target >= 1000 ? current.toLocaleString() : current) + suffix;
                    if (progress < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
            },
        }));
    });
</script>

<style>[x-cloak] { display: none !important; }</style>
