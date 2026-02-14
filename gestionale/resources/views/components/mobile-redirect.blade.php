<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Redirezione automatica mobile
        const isMobile = window.innerWidth < 768; // md breakpoint
        const urlParams = new URLSearchParams(window.location.search);
        const forcedDesktop = urlParams.get('view') === 'desktop';

        if (isMobile && !forcedDesktop) {
            window.location.href = "{{ route('mobile-calendar') }}";
        }
    });
</script>