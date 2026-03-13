<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? config('app.name', 'Auftrag Tool') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

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

    <script src="{{ asset('assets/js/admin.js') }}"></script>

    @stack('scripts')
</body>
</html>