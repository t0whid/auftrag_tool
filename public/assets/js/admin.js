(function () {
    const sidebar = document.getElementById('adminSidebar');
    const main = document.getElementById('adminMain');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggleMobile');

    const STORAGE_KEY = 'admin_sidebar_collapsed';

    function isMobile() {
        return window.innerWidth < 992;
    }

    function applyDesktopState() {
        const collapsed = localStorage.getItem(STORAGE_KEY) === 'true';

        if (!isMobile()) {
            sidebar.classList.toggle('collapsed', collapsed);
            main.classList.toggle('expanded', collapsed);

            sidebar.classList.remove('show-mobile');
            sidebar.classList.remove('mobile-hidden');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    function openMobileSidebar() {
        sidebar.classList.add('show-mobile');
        sidebar.classList.remove('mobile-hidden');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileSidebar() {
        sidebar.classList.remove('show-mobile');
        sidebar.classList.add('mobile-hidden');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    function toggleDesktopSidebar() {
        if (isMobile()) return;

        const willCollapse = !sidebar.classList.contains('collapsed');

        sidebar.classList.toggle('collapsed', willCollapse);
        main.classList.toggle('expanded', willCollapse);

        localStorage.setItem(STORAGE_KEY, willCollapse ? 'true' : 'false');
    }

    function resetForScreen() {
        if (isMobile()) {
            sidebar.classList.remove('collapsed');
            main.classList.remove('expanded');
            closeMobileSidebar();
        } else {
            applyDesktopState();
        }
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            if (isMobile()) {
                if (sidebar.classList.contains('show-mobile')) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            } else {
                toggleDesktopSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeMobileSidebar);
    }

    window.addEventListener('resize', resetForScreen);

    resetForScreen();
})();