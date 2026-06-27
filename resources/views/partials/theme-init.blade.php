<script>
    (function () {
        var stored = localStorage.getItem('supplylink-theme');
        var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        var root = document.documentElement;

        if (stored === 'dark' || (stored !== 'light' && prefersDark)) {
            root.classList.add('dark');
            root.classList.remove('light');
        } else {
            root.classList.remove('dark');
            root.classList.add('light');
        }
    })();
</script>
