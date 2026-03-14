<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? config('app.name', 'Auftrag Tool') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    @stack('styles')
</head>

<body>
    @php
        $adminUser = auth()->user();
    @endphp

    <div class="admin-app">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <aside class="admin-sidebar" id="adminSidebar">
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

            <div class="sidebar-user-card">
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr($adminUser->name ?? 'A', 0, 1)) }}
                </div>

                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ $adminUser->name ?? 'Admin' }}</div>
                    <div class="sidebar-user-role">{{ __('admin.admin_role') }}</div>
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
                <a href="{{ route('admin.orders.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard2-check-fill"></i>
                    <span class="sidebar-label">{{ __('order.nav_orders') }}</span>
                </a>
                <a href="{{ route('admin.order-responses.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.order-responses.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <span class="sidebar-label">{{ __('order.nav_order_responses') }}</span>
                </a>
                @if (auth()->user()?->role === 'super_admin')
                    <a href="{{ route('admin.admin-users.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.admin-users.*') ? 'active' : '' }}">
                        <i class="bi bi-shield-lock-fill"></i>
                        <span class="sidebar-label">{{ __('admin.nav_admins') }}</span>
                    </a>
                @endif

                @php
                    $settingsOpen = request()->routeIs('admin.profile.*') || request()->routeIs('admin.my-password.*');
                @endphp

                <div class="sidebar-settings-group">
                    <button type="button"
                        class="sidebar-link sidebar-collapse-btn {{ $settingsOpen ? 'active' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#settingsSubmenu"
                        aria-expanded="{{ $settingsOpen ? 'true' : 'false' }}" aria-controls="settingsSubmenu">
                        <i class="bi bi-gear-fill"></i>
                        <span class="sidebar-label">{{ __('admin.settings') }}</span>
                        <span class="sidebar-caret ms-auto">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </button>

                    <div class="collapse sidebar-submenu-wrap {{ $settingsOpen ? 'show' : '' }}" id="settingsSubmenu">
                        <div class="sidebar-submenu">
                            <a href="{{ route('admin.profile.edit') }}"
                                class="sidebar-sublink {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ __('admin.update_profile') }}</span>
                            </a>

                            <a href="{{ route('admin.my-password.form') }}"
                                class="sidebar-sublink {{ request()->routeIs('admin.my-password.*') ? 'active' : '' }}">
                                <i class="bi bi-key-fill"></i>
                                <span>{{ __('admin.update_password') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" class="w-100">
                    @csrf
                    <button type="submit" class="sidebar-logout-btn w-100">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="sidebar-label">{{ __('auth.logout') }}</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main" id="adminMain">
            <div class="topbar d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="topbar-left">
                    <button type="button" class="topbar-menu-btn" id="sidebarToggleMobile">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="topbar-heading-wrap">
                        <div class="topbar-breadcrumb">{{ __('admin.panel_subtitle') }}</div>
                        <h2 class="topbar-title">{{ $pageHeading ?? __('admin.default_heading') }}</h2>
                        <div class="topbar-subtitle">{{ $pageSubheading ?? __('admin.default_subheading') }}</div>
                    </div>
                </div>

                <div class="topbar-actions">
                    <div class="topbar-datetime-chip">
                        <div class="topbar-datetime-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <div class="topbar-datetime-meta">
                            <div class="topbar-date" id="liveDate">--</div>
                            <div class="topbar-time" id="liveTime">--</div>
                        </div>
                    </div>

                    <div class="topbar-admin-chip">
                        <div class="topbar-admin-avatar">
                            {{ strtoupper(substr($adminUser->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="topbar-admin-meta">
                            <div class="topbar-admin-name">{{ $adminUser->name ?? 'Admin' }}</div>
                            <div class="topbar-admin-role">{{ __('admin.admin_role') }}</div>
                        </div>
                    </div>

                    <div class="lang-switcher">
                        <a href="{{ route('lang.switch', ['locale' => 'de']) }}"
                            class="{{ app()->getLocale() === 'de' ? 'active' : '' }}">DE</a>
                        <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                            class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                    </div>
                </div>
            </div>

            <div class="page-body">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/js/admin.js') }}"></script>

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3500,
            extendedTimeOut: 1200,
            preventDuplicates: true,
            newestOnTop: true,
            showDuration: 250,
            hideDuration: 200,
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };

        @if (session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if (session('error'))
            toastr.error(@json(session('error')));
        @endif

        @if (session('warning'))
            toastr.warning(@json(session('warning')));
        @endif

        @if (session('info'))
            toastr.info(@json(session('info')));
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        @endif
    </script>

    @stack('scripts')
</body>

</html>
