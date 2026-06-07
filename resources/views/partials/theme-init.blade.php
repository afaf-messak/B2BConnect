<script>
    (function () {
        var stored = localStorage.getItem('supplylink-theme');
        var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (stored === 'dark' || (stored !== 'light' && prefersDark)) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        }
    })();
</script>
