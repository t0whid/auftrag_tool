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
            --sidebar-hover: #21456f;
            --primary: #2f80ed;
            --primary-dark: #1d68cf;
            --primary-soft: #eaf3ff;
            --page-bg: #f4f8fc;
            --card-bg: #ffffff;
            --border: #e5edf6;
            --text-main: #1f2d3d;
            --text-muted: #6b7a90;
            --success-soft: #dcfce7;
            --warning-soft: #fef3c7;
            --danger-soft: #fee2e2;
            --radius-xl: 24px;
            --radius-lg: 18px;
            --radius-md: 14px;
            --shadow-soft: 0 12px 32px rgba(22, 50, 83, 0.08);
        }

        body {
            margin: 0;
            background: var(--page-bg);
            color: var(--text-main);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .admin-wrapper {
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 270px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #10263f 100%);
            color: #fff;
            min-height: 100vh;
            position: sticky;
            top: 0;
        }

        .brand-box {
            padding: 24px 22px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 0;
            color: #fff;
        }

        .brand-subtitle {
            color: rgba(255,255,255,0.65);
            font-size: .9rem;
            margin-top: 4px;
        }

        .sidebar-menu {
            padding: 18px 14px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            text-decoration: none;
            color: rgba(255,255,255,0.88);
            font-weight: 600;
            margin-bottom: 8px;
            transition: .2s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(255,255,255,0.10);
            color: #fff;
        }

        .sidebar-link i {
            font-size: 1.1rem;
        }

        .admin-content {
            min-width: 0;
        }

        .topbar {
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            padding: 18px 24px;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .topbar-title {
            font-size: 1.35rem;
            font-weight: 800;
            margin: 0;
            color: #163253;
        }

        .topbar-subtitle {
            color: var(--text-muted);
            font-size: .95rem;
            margin-top: 2px;
        }

        .lang-switcher a {
            text-decoration: none;
            color: #163253;
            font-weight: 700;
            padding: 7px 12px;
            border-radius: 999px;
            transition: .2s ease;
        }

        .lang-switcher a.active {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .page-body {
            padding: 24px;
        }

        .card-soft {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-soft);
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
            font-size: 1.25rem;
            margin-bottom: 14px;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 1.9rem;
            font-weight: 800;
            line-height: 1;
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

        .badge-soft-success {
            background: var(--success-soft);
            color: #166534;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 700;
        }

        .badge-soft-secondary {
            background: #eef2f7;
            color: #475569;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 700;
        }

        .table-modern thead th {
            border-bottom: 1px solid var(--border);
            color: var(--text-muted);
            font-size: .9rem;
            font-weight: 700;
            background: #f9fbfe;
        }

        .table-modern tbody td {
            vertical-align: middle;
            border-color: #edf2f7;
        }

        .table-modern tbody tr:hover {
            background: #fbfdff;
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

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dbe5f0;
            border-radius: 12px;
            padding: 6px 10px;
            background: #fff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 10px !important;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                min-height: auto;
                width: 100%;
                position: relative;
            }

            .topbar {
                position: relative;
            }

            .page-body {
                padding: 16px;
            }
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
    color: #5f7087;
    font-size: .84rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .04em;
    padding: 15px 14px !important;
    text-align: center !important;
    vertical-align: middle;
    border-right: 1px solid #e2eaf3 !important;
    border-bottom: 1px solid #dfe8f2 !important;
    white-space: nowrap;
}

.table-modern thead th:last-child {
    border-right: none !important;
}

.table-modern tbody td {
    padding: 16px 14px !important;
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
    justify-content: flex-end;
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

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 18px;
}

.dataTables_wrapper .dataTables_length label,
.dataTables_wrapper .dataTables_filter label {
    font-weight: 700;
    color: #5f7087;
}

.dataTables_wrapper .dataTables_length select {
    min-width: 84px;
    margin: 0 8px;
    height: 42px;
    padding: 6px 38px 6px 12px !important;
    border-radius: 12px;
    border: 1px solid #d7e2ef !important;
    background-color: #fff !important;
    color: #163253;
    font-weight: 600;
    appearance: auto !important;
    -webkit-appearance: menulist !important;
    -moz-appearance: menulist !important;
    background-image: none !important;
}

.dataTables_wrapper .dataTables_filter input {
    height: 42px;
    min-width: 240px;
    margin-left: 8px;
    border-radius: 999px;
    border: 1px solid #d7e2ef !important;
    padding: 8px 16px;
    background: #fff;
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
    padding: 6px 12px !important;
    margin: 0 2px;
    border-radius: 10px !important;
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

@media (max-width: 767.98px) {
    .dataTables_wrapper .dataTables_filter input {
        min-width: 100%;
        margin-left: 0;
        margin-top: 8px;
    }

    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label {
        width: 100%;
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
<div class="container-fluid admin-wrapper px-0">
    <div class="row g-0">
        <div class="col-lg-auto">
            <aside class="admin-sidebar">
                <div class="brand-box">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge text-bg-primary rounded-pill px-3 py-2">
                            <i class="bi bi-check2-square"></i>
                        </span>
                        <h1 class="brand-title">MEDIAAV</h1>
                    </div>
                    <div class="brand-subtitle">{{ __('admin.panel_subtitle') }}</div>
                </div>

                <nav class="sidebar-menu">
                    <a href="{{ route('admin.dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>{{ __('admin.nav_dashboard') }}</span>
                    </a>

                    <a href="{{ route('admin.employees.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>{{ __('admin.nav_employees') }}</span>
                    </a>
                </nav>
            </aside>
        </div>

        <div class="col admin-content">
            <div class="topbar d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h2 class="topbar-title">{{ $pageHeading ?? __('admin.default_heading') }}</h2>
                    <div class="topbar-subtitle">{{ $pageSubheading ?? __('admin.default_subheading') }}</div>
                </div>

                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <div class="lang-switcher d-flex align-items-center gap-2">
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

            <main class="page-body">
                @if(session('success'))
                    <div class="alert alert-success rounded-4 border-0 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')
</body>
</html>