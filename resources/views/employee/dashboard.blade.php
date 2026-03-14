<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('order.new_order') }} - MEDIAAV</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        :root {
            --bg: #eef2f7;
            --panel: rgba(255, 255, 255, 0.82);
            --panel-strong: #ffffff;
            --stroke: #d9e2ee;
            --stroke-soft: #e8eef5;

            --text: #173052;
            --muted: #7b8ba1;

            --brand: #41a9e8;
            --brand-dark: #23558a;

            --success: #35c99b;
            --success-dark: #14996f;

            --warning: #f2c244;
            --warning-dark: #9a6a00;

            --danger: #f66d6d;
            --danger-dark: #d54747;

            --shadow: 0 18px 40px rgba(18, 49, 84, 0.08);
            --shadow-soft: 0 10px 24px rgba(18, 49, 84, 0.06);

            --radius-xl: 30px;
            --radius-lg: 24px;
            --radius-md: 18px;
            --radius-sm: 14px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, #f8fbff 0%, #eef3f9 40%, #e8edf5 100%);
        }

        a {
            text-decoration: none;
        }

        .page-wrap {
            width: 100%;
            min-height: 100vh;
            padding: 15px;
        }

        .dashboard-shell {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            background: rgba(245, 248, 252, 0.72);
            border: 1px solid rgba(217, 226, 238, 0.88);
            border-radius: 34px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(25, 45, 75, 0.08);
            backdrop-filter: blur(8px);
        }

        .topbar {
            padding: 20px 34px;
            background: rgba(255, 255, 255, 0.72);
            border-bottom: 1px solid var(--stroke);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            min-height: 52px;
        }

        .brand-logo {
            height: 46px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .lang-switcher {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow-soft);
        }

        .lang-switcher a {
            min-width: 42px;
            height: 36px;
            padding: 0 14px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            font-weight: 800;
            color: var(--muted);
            transition: .2s ease;
        }

        .lang-switcher a.active {
            background: linear-gradient(135deg, #42b0eb, #2d89d4);
            color: #fff;
            box-shadow: 0 8px 18px rgba(45, 137, 212, 0.22);
        }

        .user-dropdown .btn {
            border: 1px solid var(--stroke);
            background: rgba(255, 255, 255, 0.96);
            border-radius: 999px;
            padding: 7px 10px 7px 16px;
            color: var(--text);
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-soft);
        }

        .user-dropdown .btn:focus,
        .user-dropdown .btn:active {
            border-color: #bfd2e7;
            box-shadow: 0 0 0 .2rem rgba(65, 169, 232, 0.12);
        }

        .avatar-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #1c4b83, #2d6db1);
            color: #fff;
            font-size: 1rem;
            font-weight: 800;
            box-shadow: 0 6px 14px rgba(28, 75, 131, 0.22);
            border: 3px solid rgba(255, 255, 255, 0.95);
        }

        .dropdown-menu-modern {
            min-width: 260px;
            border: 1px solid var(--stroke);
            border-radius: 20px;
            box-shadow: 0 22px 50px rgba(18, 49, 84, 0.12);
            padding: 12px;
        }

        .dropdown-user-head {
            padding: 10px 12px 12px;
            border-bottom: 1px solid var(--stroke-soft);
            margin-bottom: 8px;
        }

        .dropdown-user-name {
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
        }

        .dropdown-user-email {
            color: var(--muted);
            font-size: .94rem;
            word-break: break-word;
            margin-top: 4px;
        }

        .dropdown-menu-modern .dropdown-item {
            border-radius: 14px;
            padding: 11px 12px;
            font-weight: 600;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-menu-modern .dropdown-item:hover {
            background: #f4f8fc;
        }

        .page-body {
            padding: 34px;
        }

        .page-heading {
            margin: 0 0 26px;
            font-size: clamp(2rem, 3vw, 3rem);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #173052;
        }

        .card-soft {
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(217, 226, 238, 0.72);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .order-hero {
            padding: 30px 32px;
            margin-bottom: 18px;
        }

        .order-title {
            font-size: clamp(1.75rem, 2vw, 2.25rem);
            font-weight: 800;
            margin: 0 0 12px;
            color: #163052;
        }

        .order-lines {
            display: grid;
            gap: 8px;
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.65;
        }

        .order-lines strong {
            color: #224167;
            font-weight: 700;
            margin-right: 6px;
        }

        .grid-cards {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 22px;
        }

        .info-card {
            grid-column: span 6;
            background: rgba(255, 255, 255, 0.84);
            border: 1px solid var(--stroke-soft);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
            padding: 18px 20px;
            min-height: 94px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-card.full {
            grid-column: 1 / -1;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, rgba(65, 169, 232, 0.15), rgba(65, 169, 232, 0.08));
            color: var(--brand);
            font-size: 1.2rem;
        }

        .info-content {
            min-width: 0;
            width: 100%;
        }

        .info-label {
            color: var(--muted);
            font-size: .95rem;
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .info-value {
            color: var(--text);
            font-weight: 700;
            font-size: 1.18rem;
            line-height: 1.25;
            word-break: break-word;
        }

        .info-value small {
            color: var(--muted);
            font-weight: 600;
            font-size: .92rem;
        }

        .current-response {
            margin-bottom: 22px;
            padding: 16px 20px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow-soft);
        }

        .current-response .left .title {
            font-size: .95rem;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .current-response .left .time {
            font-size: .92rem;
            color: var(--muted);
        }

        .state-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 800;
            font-size: .95rem;
            white-space: nowrap;
        }

        .state-pill.yes {
            background: rgba(53, 201, 155, 0.16);
            color: var(--success-dark);
        }

        .state-pill.maybe {
            background: rgba(242, 194, 68, 0.18);
            color: var(--warning-dark);
        }

        .state-pill.no {
            background: rgba(246, 109, 109, 0.18);
            color: var(--danger-dark);
        }

        .response-panel {
            padding: 26px 28px;
        }

        .response-title-inline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
            margin: 0 0 18px;
            font-size: 1.08rem;
            color: var(--text);
            font-weight: 800;
        }

        .response-title-inline i {
            color: var(--brand);
        }

        .response-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .response-btn {
            appearance: none;
            border: 0;
            width: 100%;
            border-radius: 22px;
            padding: 16px 12px 18px;
            background: transparent;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
            cursor: pointer;
            text-align: center;
        }

        .response-btn:hover {
            transform: translateY(-2px);
        }

        .response-btn .circle {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 2.15rem;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.10);
        }

        .response-btn .label {
            font-size: 1.08rem;
            font-weight: 800;
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .response-btn.yes .circle {
            background: linear-gradient(135deg, #63ddb7, #38c799);
        }

        .response-btn.maybe .circle {
            background: linear-gradient(135deg, #f8d468, #efb932);
        }

        .response-btn.no .circle {
            background: linear-gradient(135deg, #ff8585, #f45f5f);
        }

        .response-btn.yes .label {
            color: var(--success-dark);
        }

        .response-btn.maybe .label {
            color: var(--warning-dark);
        }

        .response-btn.no .label {
            color: #1f2f4c;
        }

        .response-btn.active.yes {
            background: rgba(53, 201, 155, 0.12);
            box-shadow: inset 0 0 0 2px rgba(53, 201, 155, 0.25);
        }

        .response-btn.active.maybe {
            background: rgba(242, 194, 68, 0.14);
            box-shadow: inset 0 0 0 2px rgba(242, 194, 68, 0.25);
        }

        .response-btn.active.no {
            background: rgba(246, 109, 109, 0.12);
            box-shadow: inset 0 0 0 2px rgba(246, 109, 109, 0.22);
        }

        .empty-state {
            padding: 60px 30px;
            text-align: center;
        }

        .empty-icon {
            width: 88px;
            height: 88px;
            margin: 0 auto 18px;
            border-radius: 26px;
            display: grid;
            place-items: center;
            font-size: 2rem;
            color: var(--brand);
            background: linear-gradient(135deg, rgba(65, 169, 232, 0.14), rgba(65, 169, 232, 0.06));
        }

        #toast-container {
            top: 18px !important;
            right: 18px !important;
            z-index: 99999 !important;
        }

        #toast-container>.toast {
            width: 360px;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
            opacity: 1;
            padding: 16px 16px 16px 58px;
            font-size: .95rem;
            font-weight: 600;
            background-size: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        #toast-container>.toast-success {
            background-color: #16a34a;
        }

        #toast-container>.toast-error {
            background-color: #dc2626;
        }

        #toast-container>.toast-warning {
            background-color: #d97706;
        }

        #toast-container>.toast-info {
            background-color: #2563eb;
        }

        #toast-container>.toast:hover {
            box-shadow: 0 22px 46px rgba(15, 23, 42, 0.2);
        }

        .toast-title {
            font-weight: 800;
            font-size: .95rem;
            margin-bottom: 3px;
        }

        .toast-message {
            font-size: .92rem;
            line-height: 1.45;
        }

        .toast-close-button {
            opacity: 1 !important;
            color: #fff !important;
            font-size: 20px !important;
            text-shadow: none !important;
            right: 10px !important;
            top: 8px !important;
        }

        .toast-progress {
            opacity: .22;
            height: 3px;
        }

        @media (max-width: 576px) {
            #toast-container {
                left: 12px !important;
                right: 12px !important;
                top: 12px !important;
            }

            #toast-container>.toast {
                width: 100%;
            }
        }

        .sidebar-logout-btn {
            border: 0;
            background: transparent;
            color: inherit;
            font: inherit;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0;
            text-align: left;
        }

        @media (max-width: 991.98px) {
            .page-wrap {
                padding: 0px;
            }

            .topbar,
            .page-body {
                padding-left: 18px;
                padding-right: 18px;
            }

            .info-card {
                grid-column: span 12;
            }

            .response-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 12px;
            }

            .response-btn {
                padding: 14px 8px 16px;
                border-radius: 18px;
            }

            .response-btn .circle {
                width: 64px;
                height: 64px;
                font-size: 1.6rem;
                margin-bottom: 10px;
            }

            .response-btn .label {
                font-size: .92rem;
            }
        }

        @media (max-width: 767.98px) {
            .dashboard-shell {
                border-radius: 0px;
            }

            .topbar {
                padding-top: 16px;
                padding-bottom: 16px;
            }

            .brand-logo {
                height: 40px;
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
            }

            .page-heading {
                font-size: 2rem;
                margin-bottom: 20px;
            }

            .order-hero,
            .response-panel {
                padding: 20px;
            }

            .current-response {
                flex-direction: column;
                align-items: flex-start;
            }

            .response-title-inline {
                display: inline-flex;
                flex-wrap: nowrap;
                font-size: 1rem;
            }

            .response-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 10px;
            }

            .response-btn {
                padding: 12px 6px 14px;
                border-radius: 16px;
            }

            .response-btn .circle {
                width: 54px;
                height: 54px;
                font-size: 1.35rem;
                margin-bottom: 8px;
            }

            .response-btn .label {
                font-size: .82rem;
                line-height: 1.15;
            }



            .toast-custom {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>

    @php
        $userName = auth()->user()->name ?? 'Employee';
        $userEmail = auth()->user()->email ?? 'employee@gmail.com';

        $currentResponseClass = match ($myResponse->response ?? null) {
            'yes' => 'yes',
            'maybe' => 'maybe',
            'no' => 'no',
            default => '',
        };

        $currentResponseText = match ($myResponse->response ?? null) {
            'yes' => __('order.yes'),
            'maybe' => __('order.possibly'),
            'no' => __('order.no'),
            default => __('order.no_response_yet'),
        };
    @endphp

    <div class="page-wrap">
        <div class="dashboard-shell">

            <header class="topbar">
                <div class="brand-wrap">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MEDIAAV" class="brand-logo">
                </div>

                <div class="topbar-right">
                    <div class="lang-switcher">
                        <a href="{{ route('lang.switch', ['locale' => 'de']) }}"
                            class="{{ app()->getLocale() === 'de' ? 'active' : '' }}">
                            DE
                        </a>
                        <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                            class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">
                            EN
                        </a>
                    </div>

                    <div class="dropdown user-dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="avatar-circle">E</div>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-modern">
                            <li>
                                <div class="dropdown-user-head">
                                    <div class="dropdown-user-name">{{ $userName }}</div>
                                    <div class="dropdown-user-email">{{ $userEmail }}</div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="mailto:{{ $userEmail }}">
                                    <i class="fa-regular fa-envelope"></i>
                                    <span>{{ $userEmail }}</span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item m-0">
                                    @csrf
                                    <button type="submit" class="sidebar-logout-btn w-100">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <span>{{ __('order.logout') }}</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="page-body">
                <h1 class="page-heading">{{ __('order.new_order') }}</h1>

                @if ($activeOrder)
                    <section class="card-soft order-hero">
                        <h2 class="order-title">{{ $activeOrder->title }}</h2>

                        <div class="order-lines">
                            @if ($activeOrder->location)
                                <div>
                                    <strong>{{ __('order.location') }}:</strong> {{ $activeOrder->location }}
                                </div>
                            @endif

                            <div>
                                <strong>{{ __('order.date') }}:</strong>
                                {{ $activeOrder->start_date?->format('d.m.Y') }}
                                @if ($activeOrder->end_date)
                                    – {{ $activeOrder->end_date->format('d.m.Y') }}
                                @endif
                            </div>

                            @if ($activeOrder->team_info)
                                <div>
                                    <strong>{{ __('order.team_info') }}:</strong> {{ $activeOrder->team_info }}
                                </div>
                            @endif

                            @if ($activeOrder->description)
                                <div>
                                    <strong>{{ __('order.description') }}:</strong>
                                    {!! nl2br(e($activeOrder->description)) !!}
                                </div>
                            @endif
                        </div>
                    </section>

                    <section class="grid-cards">
                        <div class="info-card full">
                            <div class="info-icon">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">{{ __('order.date') }}</div>
                                <div class="info-value">
                                    {{ $activeOrder->start_date?->format('d.m.Y') }}
                                    @if ($activeOrder->end_date)
                                        – {{ $activeOrder->end_date->format('d.m.Y') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($activeOrder->hourly_rate !== null)
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ __('order.hourly_rate') }}</div>
                                    <div class="info-value">
                                        {{ number_format($activeOrder->hourly_rate, 2) }} €
                                        <small>/ {{ __('order.hour') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($activeOrder->travel_cost !== null)
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fa-solid fa-road"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ __('order.travel_cost') }}</div>
                                    <div class="info-value">
                                        {{ number_format($activeOrder->travel_cost, 2) }} €
                                        @if ($activeOrder->travel_cost_unit)
                                            <small>/ {{ $activeOrder->travel_cost_unit }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($activeOrder->meal_allowance !== null)
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fa-solid fa-utensils"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ __('order.meal_allowance') }}</div>
                                    <div class="info-value">{{ number_format($activeOrder->meal_allowance, 2) }} €
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($activeOrder->custom_field_1_label && $activeOrder->custom_field_1_value)
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ $activeOrder->custom_field_1_label }}</div>
                                    <div class="info-value">{{ $activeOrder->custom_field_1_value }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($activeOrder->custom_field_2_label && $activeOrder->custom_field_2_value)
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ $activeOrder->custom_field_2_label }}</div>
                                    <div class="info-value">{{ $activeOrder->custom_field_2_value }}</div>
                                </div>
                            </div>
                        @endif
                    </section>

                    @if ($myResponse)
                        <div class="current-response">
                            <div class="left">
                                <div class="title">{{ __('order.your_current_response') }}</div>
                                <div class="time">
                                    {{ $myResponse->responded_at?->format('d.m.Y H:i') }}
                                </div>
                            </div>

                            <div class="right">
                                <span class="state-pill {{ $currentResponseClass }}">
                                    @if ($myResponse->response === 'yes')
                                        <i class="fa-solid fa-circle-check"></i>
                                    @elseif($myResponse->response === 'maybe')
                                        <i class="fa-solid fa-circle-question"></i>
                                    @else
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    @endif
                                    {{ $currentResponseText }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <section class="card-soft response-panel">
                        <div class="response-title-inline">
                            <i class="fa-regular fa-hand-pointer"></i>
                            <span>{{ __('order.please_select_your_response') }}</span>
                        </div>

                        @error('response')
                            <div class="text-danger small mb-3">{{ $message }}</div>
                        @enderror

                        <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                            @csrf

                            <div class="response-grid">
                                <button type="submit" name="response" value="yes"
                                    class="response-btn yes {{ $myResponse?->response === 'yes' ? 'active' : '' }}">
                                    <div class="circle">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <div class="label">{{ __('order.yes') }}</div>
                                </button>

                                <button type="submit" name="response" value="maybe"
                                    class="response-btn maybe {{ $myResponse?->response === 'maybe' ? 'active' : '' }}">
                                    <div class="circle">
                                        <i class="fa-solid fa-question"></i>
                                    </div>
                                    <div class="label">{{ __('order.possibly') }}</div>
                                </button>

                                <button type="submit" name="response" value="no"
                                    class="response-btn no {{ $myResponse?->response === 'no' ? 'active' : '' }}">
                                    <div class="circle">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                    <div class="label">{{ __('order.no') }}</div>
                                </button>
                            </div>
                        </form>
                    </section>
                @else
                    <section class="card-soft empty-state">
                        <div class="empty-icon">
                            <i class="fa-regular fa-folder-open"></i>
                        </div>
                        <h3 class="fw-bold mb-2">{{ __('order.no_active_order_available') }}</h3>
                        <p class="text-muted mb-0">{{ __('order.please_check_back_later') }}</p>
                    </section>
                @endif
            </main>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3600,
            extendedTimeOut: 1200,
            preventDuplicates: true,
            newestOnTop: true,
            showDuration: 350,
            hideDuration: 250,
            showMethod: "slideDown",
            hideMethod: "fadeOut",
            showEasing: "swing",
            hideEasing: "linear"
        };

        @if (session('success'))
            toastr.success(@json(session('success')), 'Success');
        @endif

        @if (session('error'))
            toastr.error(@json(session('error')), 'Error');
        @endif

        @if (session('warning'))
            toastr.warning(@json(session('warning')), 'Warning');
        @endif

        @if (session('info'))
            toastr.info(@json(session('info')), 'Info');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error(@json($error), 'Error');
            @endforeach
        @endif
    </script>
</body>

</html>
