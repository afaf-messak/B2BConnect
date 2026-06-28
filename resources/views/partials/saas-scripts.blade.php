<div id="saas-overlay" class="pointer-events-none fixed inset-0 z-40 bg-black/40 opacity-0 lg:hidden" aria-hidden="true"></div>

@include('partials.theme-script')

<script>
    (function () {
        var sidebarKey = 'supplylink-sidebar-collapsed';
        var html = document.documentElement;
        var sidebar = document.getElementById('saas-sidebar');
        var overlay = document.getElementById('saas-overlay');
        var toggleBtn = document.getElementById('saas-sidebar-toggle');
        var toggleIcon = document.getElementById('saas-sidebar-toggle-icon');

        function isDesktop() {
            return window.matchMedia('(min-width: 1024px)').matches;
        }

        function applySidebarCollapsed(collapsed) {
            var isCollapsed = collapsed && isDesktop();
            html.classList.toggle('sidebar-collapsed', isCollapsed);
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-label', isCollapsed ? '{{ __('common.sidebar.expand') }}' : '{{ __('common.sidebar.collapse') }}');
            }
            if (toggleIcon) {
                var isRtl = html.getAttribute('dir') === 'rtl';
                toggleIcon.textContent = isCollapsed
                    ? (isRtl ? 'chevron_left' : 'chevron_right')
                    : (isRtl ? 'chevron_right' : 'chevron_left');
            }
        }

        function closeMobileSidebar() {
            html.classList.remove('sidebar-mobile-open');
        }

        if (localStorage.getItem(sidebarKey) === 'true') {
            applySidebarCollapsed(true);
        }

        toggleBtn?.addEventListener('click', function () {
            if (isDesktop()) {
                var collapsed = !html.classList.contains('sidebar-collapsed');
                localStorage.setItem(sidebarKey, collapsed ? 'true' : 'false');
                applySidebarCollapsed(collapsed);
            } else {
                html.classList.toggle('sidebar-mobile-open');
            }
        });

        overlay?.addEventListener('click', closeMobileSidebar);

        window.addEventListener('resize', function () {
            if (isDesktop()) {
                closeMobileSidebar();
                applySidebarCollapsed(localStorage.getItem(sidebarKey) === 'true');
            } else {
                html.classList.remove('sidebar-collapsed');
            }
        });

        document.querySelectorAll('[data-dropdown]').forEach(function (dropdown) {
            var trigger = dropdown.querySelector('[data-dropdown-trigger]');
            var menu = dropdown.querySelector('[data-dropdown-menu]');

            trigger?.addEventListener('click', function (e) {
                e.stopPropagation();
                document.querySelectorAll('[data-dropdown-menu].open').forEach(function (openMenu) {
                    if (openMenu !== menu) openMenu.classList.remove('open');
                });
                menu?.classList.toggle('open');
            });
        });

        document.addEventListener('click', function () {
            document.querySelectorAll('[data-dropdown-menu].open').forEach(function (menu) {
                menu.classList.remove('open');
            });
        });
    })();
</script>
