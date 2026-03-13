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
            --blue-soft: #eaf3ff;
            --bg-soft: #f5f8fc;
            --card-bg: #ffffff;
            --text-main: #1f2d3d;
            --text-muted: #6c7a89;
            --success-soft: #d9f7ea;
            --warning-soft: #fff4cc;
            --danger-soft: #ffe0e0;
            --radius-xl: 24px;
            --radius-lg: 18px;
        }

        body {
            background: linear-gradient(180deg, #f5f8fc 0%, #edf3fb 100%);
            color: var(--text-main);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            min-height: 100vh;
        }

        .app-shell {
            max-width: 480px;
            margin: 24px auto;
            background: #f8fbff;
            border-radius: 36px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(22, 50, 83, 0.12);
            border: 1px solid rgba(47, 128, 237, 0.08);
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #e7eef6;
            padding: 18px 20px;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--blue-dark);
            letter-spacing: .5px;
        }

        .card-soft {
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            border: 1px solid #edf2f7;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
        }

        .btn-soft-primary {
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .btn-soft-primary:hover {
            background: #236fd1;
            color: #fff;
        }

        .lang-switcher a {
            text-decoration: none;
            font-weight: 600;
            color: var(--blue-dark);
            padding: 6px 10px;
            border-radius: 999px;
        }

        .lang-switcher a.active {
            background: var(--blue-soft);
            color: var(--blue-main);
        }

        .section-title {
            font-weight: 800;
            font-size: 2rem;
            color: var(--blue-dark);
        }

        .muted {
            color: var(--text-muted);
        }

        @media (max-width: 576px) {
            .app-shell {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="app-shell">
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <span class="badge rounded-pill text-bg-primary px-3 py-2">
                    <i class="bi bi-check2-square"></i>
                </span>
                <span class="brand">MEDIAAV</span>
            </div>

            <div class="lang-switcher d-flex align-items-center gap-2">
                <a href="{{ route('lang.switch', ['locale' => 'de']) }}"
                    class="{{ app()->getLocale() === 'de' ? 'active' : '' }}">DE</a>

                <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                    class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
            </div>
        </div>

        <main class="p-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
