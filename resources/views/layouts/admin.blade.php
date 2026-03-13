<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? config('app.name', 'Auftrag Tool') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #163253;
            --sidebar-bg-2: #10263f;
            --sidebar-hover: rgba(255, 255, 255, 0.10);

            --primary: #2f80ed;
            --primary-dark: #1f6fda;
            --primary-soft: #eaf3ff;

            --page-bg: #f4f8fc;
            --card-bg: #ffffff;
            --border: #dfe8f2;
            --border-soft: #e9eff6;

            --text-main: #1f2d3d;
            --text-muted: #6b7a90;
            --text-soft: #8ea0b7;

            --success-bg: #dcfce7;
            --success-text: #166534;

            --danger-bg: #fee2e2;
            --danger-text: #b91c1c;

            --radius-xl: 24px;
            --radius-lg: 18px;
            --radius-md: 14px;

            --shadow-soft: 0 14px 36px rgba(22, 50, 83, 0.08);
            --shadow-card: 0 10px 30px rgba(15, 23, 42, 0.05);

            --sidebar-width: 280px;
            --sidebar-collapsed-width: 92px;
            --topbar-height: 82px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            background: var(--page-bg);
            color: var(--text-main);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            overflow-x: hidden;
        }

        .admin-app {
            min-height: 100vh;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            opacity: 0;
            visibility: hidden;
            transition: .25s ease;
            z-index: 1039;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg-2) 100%);
            color: #fff;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: width .25s ease, transform .25s ease;
            box-shadow: 8px 0 30px rgba(15, 23, 42, 0.12);
        }

        .admin-sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .admin-sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        .brand-box {
            min-height: var(--topbar-height);
            padding: 20px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.12);
            color: #fff;
            flex-shrink: 0;
            font-size: 1.1rem;
        }

        .brand-text {
            min-width: 0;
            transition: opacity .2s ease, transform .2s ease;
        }

        .brand-title {
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0;
            color: #fff;
            letter-spacing: .02em;
        }

        .brand-subtitle {
            font-size: .88rem;
            color: rgba(255,255,255,0.66);
            margin-top: 2px;
            white-space: nowrap;
        }

        .sidebar-menu {
            padding: 18px 14px 20px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 50px;
            padding: 12px 14px;
            border-radius: 15px;
            text-decoration: none;
            color: rgba(255,255,255,0.90);
            font-weight: 700;
            margin-bottom: 8px;
            transition: .2s ease;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-link i {
            font-size: 1.12rem;
            min-width: 22px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar-label {
            transition: opacity .2s ease, transform .2s ease;
        }

        .admin-sidebar.collapsed .brand-text,
        .admin-sidebar.collapsed .sidebar-label {
            opacity: 0;
            transform: translateX(-8px);
            pointer-events: none;
            width: 0;
        }

        .admin-sidebar.collapsed .brand-box {
            padding-left: 18px;
            padding-right: 18px;
        }

        .admin-sidebar.collapsed .sidebar-link {
            justify-content: center;
            padding-left: 10px;
            padding-right: 10px;
        }

        .admin-main {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: margin-left .25s ease;
        }

        .admin-main.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .topbar {
            min-height: var(--topbar-height);
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-soft);
            padding: 16px 24px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .topbar-menu-btn {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: #fff;
            color: #163253;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
            transition: .2s ease;
        }

        .topbar-menu-btn:hover {
            background: #f8fbff;
            color: #0f3f7d;
        }

        .topbar-heading-wrap {
            min-width: 0;
        }

        .topbar-title {
            font-size: 1.35rem;
            font-weight: 800;
            margin: 0;
            color: #163253;
            line-height: 1.2;
        }

        .topbar-subtitle {
            color: var(--text-muted);
            font-size: .95rem;
            margin-top: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .lang-switcher {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px;
            border-radius: 999px;
            background: #f6f9fd;
            border: 1px solid var(--border-soft);
        }

        .lang-switcher a {
            text-decoration: none;
            color: #163253;
            font-weight: 700;
            padding: 8px 12px;
            border-radius: 999px;
            transition: .2s ease;
            font-size: .92rem;
        }

        .lang-switcher a.active {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn-soft-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 700;
        }

        .btn-soft-primary:hover {
            background: var(--primary-dark);
            color: #fff;
        }

        .btn-soft-light {
            background: #fff;
            color: #163253;
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 700;
        }

        .btn-soft-light:hover {
            background: #f8fbff;
            color: #163253;
        }

        .page-body {
            padding: 24px;
        }

        .card-soft {
            background: var(--card-bg);
            border: 1px solid var(--border-soft);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .panel-header {
            padding: 22px 22px 0;
        }

        .panel-title {
            font-size: 1.1rem;
            font-weight: 800;
            margin: 0;
            color: #163253;
        }

        .panel-subtitle {
            color: var(--text-muted);
            margin-top: 4px;
            margin-bottom: 0;
        }

        .panel-body {
            padding: 22px;
        }

        .stat-card {
            padding: 22px;
            height: 100%;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 1.2rem;
            margin-bottom: 14px;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 1.9rem;
            font-weight: 800;
            line-height: 1;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            min-height: 48px;
            border: 1px solid #dbe5f0;
            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #8bbaf7;
        }

        .input-group-text {
            border-radius: 14px 0 0 14px;
            border: 1px solid #dbe5f0;
            background: #fff;
        }

        .table-shell {
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            border: 1px solid #dfe8f2;
            border-radius: 22px;
            padding: 14px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
            overflow: hidden;
        }

        .table-modern {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            margin: 0 !important;
            border: 1px solid #e2eaf3;
            border-radius: 18px;
            overflow: hidden;
        }

        .table-modern thead th {
            background: linear-gradient(180deg, #f8fbff 0%, #f1f6fc 100%) !important;
            color: #4f6b8f;
            font-size: .84rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            padding: 15px 18px !important;
            text-align: center !important;
            vertical-align: middle;
            border-right: 1px solid #dfe7f1 !important;
            border-bottom: 1px solid #d9e4ef !important;
            white-space: nowrap;
            position: relative;
        }

        .table-modern thead th:last-child {
            border-right: none !important;
        }

        .table-modern tbody td {
            padding: 16px 18px !important;
            vertical-align: middle;
            background: #fff;
            border-right: 1px solid #edf2f7 !important;
            border-bottom: 1px solid #edf2f7 !important;
        }

        .table-modern tbody td:last-child {
            border-right: none !important;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none !important;
        }

        .table-modern tbody tr:hover td {
            background: #fbfdff;
        }

        .employee-name {
            font-weight: 700;
            color: #163253;
        }

        .employee-username {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f3f7fc;
            color: #46607d;
            font-size: .88rem;
            font-weight: 600;
        }

        .employee-email {
            color: #5f7087;
            font-weight: 500;
        }

        .badge-block-no {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-weight: 700;
            font-size: .85rem;
        }

        .badge-block-yes {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: 700;
            font-size: .85rem;
        }

        .action-group {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-action-edit {
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 700;
            border: 1px solid #cfe0f7;
            color: #2367c9;
            background: #f4f9ff;
        }

        .btn-action-edit:hover {
            background: #eaf3ff;
            color: #1c58ae;
            border-color: #bcd4f3;
        }

        .btn-action-delete {
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 700;
            border: 1px solid #f3c7c7;
            color: #c53030;
            background: #fff6f6;
        }

        .btn-action-delete:hover {
            background: #ffecec;
            color: #a61f1f;
            border-color: #ecb3b3;
        }

        .table-date {
            white-space: nowrap;
            color: #607287;
            font-size: .9rem;
            font-weight: 600;
            text-align: center;
        }

        .table-center {
            text-align: center;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 18px;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            font-weight: 700;
            color: #5f7087;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .dataTables_wrapper .dataTables_length select {
            min-width: 96px;
            height: 46px;
            padding: 8px 42px 8px 14px !important;
            border-radius: 14px;
            border: 1px solid #d7e2ef !important;
            background-color: #fff !important;
            color: #163253;
            font-weight: 700;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-image:
                linear-gradient(45deg, transparent 50%, #2f80ed 50%),
                linear-gradient(135deg, #2f80ed 50%, transparent 50%),
                linear-gradient(to right, transparent, transparent) !important;
            background-position:
                calc(100% - 18px) calc(50% - 3px),
                calc(100% - 12px) calc(50% - 3px),
                100% 0 !important;
            background-size: 6px 6px, 6px 6px, 2.5em 2.5em !important;
            background-repeat: no-repeat !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            height: 46px;
            min-width: 250px;
            margin-left: 8px;
            border-radius: 999px;
            border: 1px solid #d7e2ef !important;
            padding: 8px 16px;
            background: #fff;
            color: #163253;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            outline: none;
            border-color: #8bbaf7 !important;
            box-shadow: 0 0 0 .18rem rgba(47,128,237,.10) !important;
        }

        .dataTables_wrapper .dataTables_info {
            color: #708197;
            font-weight: 600;
            margin-top: 14px;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 14px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: none !important;
            background: transparent !important;
            color: #4b6380 !important;
            padding: 8px 14px !important;
            margin: 0 2px;
            border-radius: 12px !important;
            font-weight: 700;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #eaf3ff !important;
            color: #2f80ed !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f1f6fd !important;
            color: #1f5fb9 !important;
        }

        table.dataTable thead > tr > th.sorting,
        table.dataTable thead > tr > th.sorting_asc,
        table.dataTable thead > tr > th.sorting_desc {
            padding-right: 34px !important;
        }

        table.dataTable thead > tr > th.sorting:before,
        table.dataTable thead > tr > th.sorting:after,
        table.dataTable thead > tr > th.sorting_asc:before,
        table.dataTable thead > tr > th.sorting_asc:after,
        table.dataTable thead > tr > th.sorting_desc:before,
        table.dataTable thead > tr > th.sorting_desc:after {
            right: 12px !important;
            font-size: 12px !important;
            opacity: 1 !important;
        }

        table.dataTable thead > tr > th.sorting:before,
        table.dataTable thead > tr > th.sorting_asc:before,
        table.dataTable thead > tr > th.sorting_desc:before {
            color: #9bb3cf !important;
            top: 38% !important;
        }

        table.dataTable thead > tr > th.sorting:after,
        table.dataTable thead > tr > th.sorting_asc:after,
        table.dataTable thead > tr > th.sorting_desc:after {
            color: #2f80ed !important;
            top: 54% !important;
        }

        table.dataTable thead > tr > th.sorting_asc:after {
            color: #1d68cf !important;
        }

        table.dataTable thead > tr > th.sorting_desc:before {
            color: #1d68cf !important;
        }

        @media (max-width: 1199.98px) {
            .topbar {
                padding: 16px 18px;
            }

            .page-body {
                padding: 18px;
            }
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .admin-sidebar.show-mobile {
                transform: translateX(0);
            }

            .admin-sidebar.collapsed {
                width: var(--sidebar-width);
            }

            .admin-sidebar.collapsed .brand-text,
            .admin-sidebar.collapsed .sidebar-label {
                opacity: 1;
                transform: none;
                pointer-events: auto;
                width: auto;
            }

            .admin-sidebar.collapsed .sidebar-link {
                justify-content: flex-start;
                padding-left: 14px;
                padding-right: 14px;
            }

            .admin-main,
            .admin-main.expanded {
                margin-left: 0;
            }

            .topbar-subtitle {
                white-space: normal;
            }
        }

        @media (max-width: 767.98px) {
            .topbar {
                padding: 14px 14px;
            }

            .page-body {
                padding: 14px;
            }

            .panel-header,
            .panel-body {
                padding-left: 16px;
                padding-right: 16px;
            }

            .dataTables_wrapper .dataTables_filter input {
                min-width: 100%;
                width: 100%;
                margin-left: 0;
                margin-top: 8px;
            }

            .dataTables_wrapper .dataTables_filter label,
            .dataTables_wrapper .dataTables_length label {
                width: 100%;
                display: block;
            }

            .dataTables_wrapper .dataTables_length select {
                margin-top: 8px;
            }

            .action-group {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-action-edit,
            .btn-action-delete {
                width: 100%;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="admin-app">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <aside class="admin-sidebar mobile-hidden" id="adminSidebar">
            <div class="brand-box">
                <div class="brand-wrap">
                    <div class="brand-icon">
                        <i class="bi bi-check2-square"></i>
                    </div>

                    <div class="brand-text">
                        <h1 class="brand-title">MEDIAAV</h1>
                        <div class="brand-subtitle">{{ __('admin.panel_subtitle') }}</div>
                    </div>
                </div>

            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span class="sidebar-label">{{ __('admin.nav_dashboard') }}</span>
                </a>

                <a href="{{ route('admin.employees.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span class="sidebar-label">{{ __('admin.nav_employees') }}</span>
                </a>
            </nav>
        </aside>

        <main class="admin-main" id="adminMain">
            <div class="topbar d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="topbar-left">
                    <button type="button" class="topbar-menu-btn" id="sidebarToggleMobile">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="topbar-heading-wrap">
                        <h2 class="topbar-title">{{ $pageHeading ?? __('admin.default_heading') }}</h2>
                        <div class="topbar-subtitle">{{ $pageSubheading ?? __('admin.default_subheading') }}</div>
                    </div>
                </div>

                <div class="topbar-actions">
                    <div class="lang-switcher">
                        <a href="{{ route('lang.switch', ['locale' => 'de']) }}"
                           class="{{ app()->getLocale() === 'de' ? 'active' : '' }}">DE</a>
                        <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                           class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-soft-light">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            {{ __('auth.logout') }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="page-body">
                @if(session('success'))
                    <div class="alert alert-success rounded-4 border-0 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
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
    </script>

    @stack('scripts')
</body>
</html>