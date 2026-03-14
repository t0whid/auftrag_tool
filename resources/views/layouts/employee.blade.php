<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? config('app.name', 'Auftrag Tool') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        :root {
            --blue-dark: #163253;
            --blue-main: #2f80ed;
            --blue-soft: #eaf3ff;
            --page-bg: #f4f8fc;
            --card-bg: #ffffff;
            --border: #e4edf6;
            --text-main: #1f2d3d;
            --text-muted: #6b7a90;
            --radius-xl: 28px;
            --radius-lg: 20px;
            --shadow-soft: 0 18px 42px rgba(22, 50, 83, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(47, 128, 237, 0.10), transparent 26%),
                linear-gradient(180deg, #f5f9ff 0%, #edf4fb 100%);
            color: var(--text-main);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .employee-shell {
            min-height: 100vh;
            max-width: 700px;
            margin: 0 auto;
            background: transparent;
        }

        .employee-topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(245, 249, 255, 0.88);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(228, 237, 246, 0.95);
            padding: 16px 18px;
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, var(--blue-main) 0%, #5ea4ff 100%);
            color: #fff;
            box-shadow: 0 10px 18px rgba(47, 128, 237, 0.22);
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--blue-dark);
            margin: 0;
        }

        .brand-subtitle {
            color: var(--text-muted);
            font-size: .88rem;
            margin-top: 2px;
        }

        .lang-switcher {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--border);
        }

        .lang-switcher a {
            text-decoration: none;
            color: var(--blue-dark);
            font-weight: 700;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: .9rem;
        }

        .lang-switcher a.active {
            background: var(--blue-soft);
            color: var(--blue-main);
        }

        .employee-body {
            padding: 22px 18px 28px;
        }

        .card-soft {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-soft);
        }

        .welcome-card {
            padding: 22px;
            margin-bottom: 18px;
        }

        .welcome-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--blue-dark);
            margin: 0 0 6px;
        }

        .welcome-text {
            color: var(--text-muted);
            margin: 0;
        }

        .employee-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 999px;
            background: #f8fbff;
            border: 1px solid var(--border);
            margin-top: 16px;
        }

        .employee-chip-avatar {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #2f80ed 0%, #1f6fda 100%);
            color: #fff;
            font-weight: 800;
        }

        .employee-chip-name {
            font-weight: 800;
            color: var(--blue-dark);
            line-height: 1.1;
        }

        .employee-chip-role {
            font-size: .8rem;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .order-placeholder {
            padding: 24px;
        }

        .placeholder-icon {
            width: 70px;
            height: 70px;
            border-radius: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #eef6ff 0%, #e1efff 100%);
            color: var(--blue-main);
            font-size: 1.65rem;
            margin-bottom: 16px;
        }

        .placeholder-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--blue-dark);
            margin-bottom: 8px;
        }

        .placeholder-text {
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .info-list {
            display: grid;
            gap: 12px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 18px;
            background: #f9fbfe;
            border: 1px solid #e9eff6;
        }

        .info-item i {
            color: var(--blue-main);
            font-size: 1.05rem;
            margin-top: 2px;
        }

        .info-item-title {
            font-weight: 700;
            color: var(--blue-dark);
            margin-bottom: 2px;
        }

        .info-item-text {
            color: var(--text-muted);
            font-size: .93rem;
        }

        .employee-footer-actions {
            margin-top: 18px;
            display: grid;
            gap: 12px;
        }



        #toast-container > .toast {
            border-radius: 16px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.14);
            opacity: 1;
            padding: 14px 14px 14px 50px;
            font-size: .95rem;
        }

        #toast-container > .toast-success { background-color: #16a34a; }
        #toast-container > .toast-error { background-color: #dc2626; }
        #toast-container > .toast-warning { background-color: #d97706; }
        #toast-container > .toast-info { background-color: #2563eb; }

        .toast-close-button {
            opacity: 1 !important;
            color: #fff !important;
            text-shadow: none !important;
        }

        .toast-progress {
            opacity: .22;
            height: 3px;
        }

        @media (max-width: 576px) {
            .employee-shell {
                max-width: 100%;
            }

            .employee-body {
                padding: 16px 14px 24px;
            }

            .welcome-card,
            .order-placeholder {
                padding: 18px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    @php
        $employeeUser = auth()->user();
    @endphp

    <div class="employee-shell">
        <div class="employee-topbar">
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div class="brand-wrap">
                    <div class="brand-icon">
                        <i class="bi bi-check2-square"></i>
                    </div>

                    <div>
                        <h1 class="brand-title">MEDIAAV</h1>
                        <div class="brand-subtitle">{{ __('employee.panel_subtitle') }}</div>
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

        <main class="employee-body">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

        @if(session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if(session('error'))
            toastr.error(@json(session('error')));
        @endif

        @if(session('warning'))
            toastr.warning(@json(session('warning')));
        @endif

        @if(session('info'))
            toastr.info(@json(session('info')));
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        @endif
    </script>

    @stack('scripts')
</body>
</html>