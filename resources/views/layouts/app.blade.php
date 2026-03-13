<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Auftrag Tool') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --blue-dark: #163253;
            --blue-main: #2f80ed;
            --blue-main-dark: #1f6fda;
            --blue-soft: #eaf3ff;
            --blue-soft-2: #f4f9ff;
            --bg-soft: #f5f8fc;
            --bg-soft-2: #edf4ff;
            --card-bg: rgba(255, 255, 255, 0.88);
            --card-border: rgba(255, 255, 255, 0.55);
            --text-main: #1f2d3d;
            --text-muted: #6c7a89;
            --radius-xl: 28px;
            --radius-lg: 18px;
            --shadow-soft: 0 24px 60px rgba(22, 50, 83, 0.14);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
            margin: 0;
        }

        body {
            color: var(--text-main);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(47, 128, 237, 0.18), transparent 28%),
                radial-gradient(circle at bottom right, rgba(122, 162, 255, 0.18), transparent 24%),
                linear-gradient(180deg, #f4f8ff 0%, #edf4fb 45%, #eaf2fb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 16px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 540px;
        }

        .app-shell {
            width: 100%;
            background: rgba(248, 251, 255, 0.78);
            backdrop-filter: blur(14px);
            border-radius: 34px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(255, 255, 255, 0.55);
        }

        .topbar {
            background: rgba(255, 255, 255, 0.75);
            border-bottom: 1px solid rgba(231, 238, 246, 0.9);
            padding: 18px 20px;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--blue-dark);
            letter-spacing: .5px;
        }

        .brand-badge {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, var(--blue-main) 0%, #5da2ff 100%);
            color: #fff;
            box-shadow: 0 10px 18px rgba(47, 128, 237, 0.24);
        }

        .card-soft {
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            border: 1px solid var(--card-border);
            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.06);
        }

        .btn-soft-primary {
            background: linear-gradient(180deg, var(--blue-main) 0%, var(--blue-main-dark) 100%);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            font-weight: 700;
            min-height: 50px;
            box-shadow: 0 12px 22px rgba(47, 128, 237, 0.22);
        }

        .btn-soft-primary:hover {
            color: #fff;
            transform: translateY(-1px);
        }

        .lang-switcher {
            padding: 6px;
            border-radius: 999px;
            background: rgba(234, 243, 255, 0.8);
            border: 1px solid rgba(47, 128, 237, 0.08);
        }

        .lang-switcher a {
            text-decoration: none;
            font-weight: 700;
            color: var(--blue-dark);
            padding: 7px 12px;
            border-radius: 999px;
            transition: .2s ease;
            font-size: .92rem;
        }

        .lang-switcher a.active {
            background: #fff;
            color: var(--blue-main);
            box-shadow: 0 4px 12px rgba(47, 128, 237, 0.10);
        }

        .section-title {
            font-weight: 800;
            font-size: 2rem;
            color: var(--blue-dark);
            letter-spacing: -.02em;
        }

        .muted {
            color: var(--text-muted);
        }

        .auth-card {
            padding: 22px;
        }

        .auth-hero {
            text-align: center;
            margin-bottom: 22px;
        }

        .auth-hero-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 16px;
            border-radius: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #eef5ff 0%, #dfeeff 100%);
            color: var(--blue-main);
            font-size: 1.75rem;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
        }

        .auth-form-card {
            padding: 22px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.92) 0%, rgba(248,251,255,0.9) 100%);
            border: 1px solid #e7eef7;
        }

        .form-label {
            color: var(--blue-dark);
            margin-bottom: 8px;
        }

        .input-group.input-soft {
            position: relative;
        }

        .input-group.input-soft .input-group-text {
            background: #fff;
            border: 1px solid #dbe5f0;
            border-right: 0;
            border-radius: 16px 0 0 16px;
            color: #6e84a1;
            min-height: 52px;
        }

        .input-group.input-soft .form-control {
            border: 1px solid #dbe5f0;
            border-left: 0;
            border-right: 0;
            min-height: 52px;
            box-shadow: none !important;
            background: #fff;
        }

        .input-group.input-soft .form-control:focus {
            border-color: #9ec6fb;
        }

        .input-group.input-soft .password-toggle {
            border: 1px solid #dbe5f0;
            border-left: 0;
            border-radius: 0 16px 16px 0;
            background: #fff;
            color: #6e84a1;
            min-height: 52px;
            padding: 0 16px;
        }

        .input-group.input-soft .password-toggle:hover {
            background: var(--blue-soft-2);
            color: var(--blue-main);
        }

        .input-group.input-soft .form-control.is-invalid {
            border-color: #dc3545 !important;
        }

        .input-group.input-soft .form-control.is-invalid + .password-toggle,
        .input-group.input-soft .input-group-text:has(+ .form-control.is-invalid) {
            border-color: #dc3545 !important;
        }

        .auth-footer-note {
            text-align: center;
            margin-top: 16px;
            color: var(--text-muted);
            font-size: .92rem;
        }

        @media (max-width: 576px) {
            body {
                padding: 0;
                align-items: stretch;
            }

            .auth-wrapper {
                max-width: 100%;
            }

            .app-shell {
                min-height: 100vh;
                border-radius: 0;
            }

            .topbar {
                padding: 16px;
            }

            .auth-card {
                padding: 18px;
            }

            .auth-form-card {
                padding: 18px;
            }

            .section-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="app-shell">
            <div class="topbar d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <span class="brand-badge">
                        <i class="bi bi-check2-square"></i>
                    </span>
                    <span class="brand">MEDIAAV</span>
                </div>

                <div class="lang-switcher d-flex align-items-center gap-1">
                    <a href="{{ route('lang.switch', ['locale' => 'de']) }}"
                        class="{{ app()->getLocale() === 'de' ? 'active' : '' }}">DE</a>

                    <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                        class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                </div>
            </div>

            <main class="auth-card">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>