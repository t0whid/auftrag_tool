
(function () {
    const sidebar = document.getElementById('adminSidebar');
    const main = document.getElementById('adminMain');
    const overlay = document.getElementById('sidebarOverlay');
    // const desktopToggle = document.getElementById('sidebarToggleDesktop');
    const mobileToggle = document.getElementById('sidebarToggleMobile');

    function isMobile() {
        return window.innerWidth < 992;
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
        if (isMobile()) {
            return;
        }

        sidebar.classList.toggle('collapsed');
        main.classList.toggle('expanded');
    }

    function resetForScreen() {
        if (isMobile()) {
            sidebar.classList.remove('collapsed');
            main.classList.remove('expanded');
            closeMobileSidebar();
        } else {
            sidebar.classList.remove('mobile-hidden');
            sidebar.classList.remove('show-mobile');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function () {
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
