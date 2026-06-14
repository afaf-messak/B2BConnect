<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('landingPage', () => ({
            mobileOpen: false,
            scrolled: false,
            activeSection: '',
            parallax: { x: 0, y: 0 },
            navSections: ['why-choose', 'how-it-works', 'features', 'marketplace', 'faq'],

            init() {
                this.onScroll();
                window.addEventListener('scroll', () => this.onScroll(), { passive: true });
                window.addEventListener('mousemove', (e) => {
                    this.parallax.x = (e.clientX - window.innerWidth / 2) * 0.5;
                    this.parallax.y = (e.clientY - window.innerHeight / 2) * 0.5;
                }, { passive: true });
                this.initParticles();

                const hash = window.location.hash.slice(1);
                if (hash && this.navSections.includes(hash)) {
                    this.activeSection = hash;
                }
            },

            onScroll() {
                this.scrolled = window.scrollY > 24;
                this.updateActiveSection();
            },

            updateActiveSection() {
                const trigger = window.scrollY + 160;
                let current = '';

                for (const id of this.navSections) {
                    const el = document.getElementById(id);
                    if (!el) {
                        continue;
                    }

                    const sectionTop = el.getBoundingClientRect().top + window.scrollY;
                    if (sectionTop <= trigger) {
                        current = id;
                    }
                }

                this.activeSection = current;
            },

            setActiveSection(id) {
                if (this.navSections.includes(id)) {
                    this.activeSection = id;
                }
            },

            isActive(id) {
                return this.activeSection === id;
            },

            initParticles() {
                const canvas = document.getElementById('hero-particles');
                if (!canvas || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

                const ctx = canvas.getContext('2d');
                let particles = [];
                const dpr = window.devicePixelRatio || 1;

                const resize = () => {
                    const w = canvas.offsetWidth;
                    const h = canvas.offsetHeight;
                    canvas.width = w * dpr;
                    canvas.height = h * dpr;
                    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                };

                const count = Math.min(50, Math.floor(window.innerWidth / 24));
                const spawn = () => {
                    particles = [];
                    for (let i = 0; i < count; i++) {
                        particles.push({
                            x: Math.random() * canvas.offsetWidth,
                            y: Math.random() * canvas.offsetHeight,
                            r: Math.random() * 2 + 0.5,
                            dx: (Math.random() - 0.5) * 0.4,
                            dy: (Math.random() - 0.5) * 0.4,
                            o: Math.random() * 0.4 + 0.1,
                        });
                    }
                };

                resize();
                spawn();
                window.addEventListener('resize', () => { resize(); spawn(); }, { passive: true });

                const draw = () => {
                    const w = canvas.offsetWidth;
                    const h = canvas.offsetHeight;
                    ctx.clearRect(0, 0, w, h);
                    const isDark = document.documentElement.classList.contains('dark');
                    particles.forEach(p => {
                        p.x += p.dx;
                        p.y += p.dy;
                        if (p.x < 0 || p.x > w) p.dx *= -1;
                        if (p.y < 0 || p.y > h) p.dy *= -1;
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                        ctx.fillStyle = isDark
                            ? `rgba(129, 140, 248, ${p.o})`
                            : `rgba(99, 102, 241, ${p.o})`;
                        ctx.fill();
                    });
                    requestAnimationFrame(draw);
                };
                draw();
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
                }, { threshold: 0.4 });
                observer.observe(el);
            },

            animate(target, suffix) {
                const duration = 2200;
                const start = performance.now();
                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 4);
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
