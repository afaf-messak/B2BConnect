<script>
    (function () {
        var storageKey = 'supplylink-theme';

        function isDark() {
            return document.documentElement.classList.contains('dark');
        }

        function syncToggleUi() {
            var dark = isDark();
            document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
                btn.querySelectorAll('.theme-icon-light').forEach(function (el) {
                    el.classList.toggle('hidden', dark);
                });
                btn.querySelectorAll('.theme-icon-dark').forEach(function (el) {
                    el.classList.toggle('hidden', !dark);
                });
                btn.querySelectorAll('.theme-label-light').forEach(function (el) {
                    el.classList.toggle('hidden', dark);
                });
                btn.querySelectorAll('.theme-label-dark').forEach(function (el) {
                    el.classList.toggle('hidden', !dark);
                });
            });
        }

        function applyTheme(dark) {
            document.documentElement.classList.toggle('dark', dark);
            document.documentElement.classList.toggle('light', !dark);
            localStorage.setItem(storageKey, dark ? 'dark' : 'light');
            syncToggleUi();
        }

        document.addEventListener('click', function (event) {
            var toggle = event.target.closest('[data-theme-toggle]');
            if (!toggle) {
                return;
            }
            applyTheme(!isDark());
        });

        syncToggleUi();
    })();
</script>
