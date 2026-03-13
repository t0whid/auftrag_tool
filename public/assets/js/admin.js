(function () {
    const sidebar = document.getElementById('adminSidebar');
    const main = document.getElementById('adminMain');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggleMobile');
    const liveDateEl = document.getElementById('liveDate');
    const liveTimeEl = document.getElementById('liveTime');

    const STORAGE_KEY = 'admin_sidebar_collapsed';
    const MOBILE_BREAKPOINT = 992;

    if (!sidebar || !main || !overlay || !toggleBtn) {
        return;
    }

    function isMobile() {
        return window.innerWidth < MOBILE_BREAKPOINT;
    }

    function getSavedDesktopCollapsedState() {
        return localStorage.getItem(STORAGE_KEY) === 'true';
    }

    function saveDesktopCollapsedState(value) {
        localStorage.setItem(STORAGE_KEY, value ? 'true' : 'false');
    }

    function clearMobileState() {
        sidebar.classList.remove('show-mobile');
        sidebar.classList.remove('mobile-hidden');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    function applyDesktopState() {
        const collapsed = getSavedDesktopCollapsedState();

        sidebar.classList.remove('show-mobile');
        sidebar.classList.remove('mobile-hidden');
        overlay.classList.remove('show');
        document.body.style.overflow = '';

        sidebar.classList.toggle('collapsed', collapsed);
        main.classList.toggle('expanded', collapsed);
    }

    function applyMobileState() {
        sidebar.classList.remove('collapsed');
        main.classList.remove('expanded');

        sidebar.classList.remove('show-mobile');
        sidebar.classList.add('mobile-hidden');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    function openMobileSidebar() {
        sidebar.classList.remove('collapsed');
        main.classList.remove('expanded');

        sidebar.classList.remove('mobile-hidden');
        sidebar.classList.add('show-mobile');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileSidebar() {
        sidebar.classList.remove('show-mobile');
        sidebar.classList.add('mobile-hidden');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    function toggleMobileSidebar() {
        if (sidebar.classList.contains('show-mobile')) {
            closeMobileSidebar();
        } else {
            openMobileSidebar();
        }
    }

    function toggleDesktopSidebar() {
        const willCollapse = !sidebar.classList.contains('collapsed');

        sidebar.classList.toggle('collapsed', willCollapse);
        main.classList.toggle('expanded', willCollapse);

        saveDesktopCollapsedState(willCollapse);
    }

    function syncSidebarForCurrentScreen() {
        if (isMobile()) {
            applyMobileState();
        } else {
            applyDesktopState();
        }
    }

    let lastIsMobile = isMobile();

    function handleResize() {
        const currentIsMobile = isMobile();

        if (currentIsMobile !== lastIsMobile) {
            syncSidebarForCurrentScreen();
            lastIsMobile = currentIsMobile;
            return;
        }

        if (currentIsMobile) {
            sidebar.classList.remove('collapsed');
            main.classList.remove('expanded');
        }
    }

    toggleBtn.addEventListener('click', function () {
        if (isMobile()) {
            toggleMobileSidebar();
        } else {
            toggleDesktopSidebar();
        }
    });

    overlay.addEventListener('click', function () {
        if (isMobile()) {
            closeMobileSidebar();
        }
    });

    window.addEventListener('resize', handleResize);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && isMobile() && sidebar.classList.contains('show-mobile')) {
            closeMobileSidebar();
        }
    });

    function updateLiveDateTime() {
        if (!liveDateEl || !liveTimeEl) {
            return;
        }

        const now = new Date();
        const lang = document.documentElement.lang || 'en';

        const dateFormatter = new Intl.DateTimeFormat(lang, {
            weekday: 'short',
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });

        const timeFormatter = new Intl.DateTimeFormat(lang, {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        liveDateEl.textContent = dateFormatter.format(now);
        liveTimeEl.textContent = timeFormatter.format(now);
    }

    syncSidebarForCurrentScreen();
    updateLiveDateTime();
    setInterval(updateLiveDateTime, 1000);
})();