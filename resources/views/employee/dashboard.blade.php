<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('order.new_order') }} - MEDIAAV</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #eef2f7;
            --panel: rgba(255, 255, 255, 0.72);
            --panel-solid: #ffffff;
            --stroke: #d9e2ee;
            --stroke-soft: #e7edf5;

            --text: #173052;
            --muted: #7a8aa1;

            --brand: #41a9e8;
            --brand-dark: #23558a;

            --success: #35c99b;
            --success-deep: #16a57a;

            --warning: #f2c244;
            --warning-deep: #c79200;

            --danger: #f66d6d;
            --danger-deep: #de4545;

            --shadow: 0 14px 35px rgba(24, 55, 92, 0.08);
            --shadow-soft: 0 8px 22px rgba(24, 55, 92, 0.06);

            --radius-xl: 28px;
            --radius-lg: 22px;
            --radius-md: 18px;
            --radius-sm: 14px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background:
                radial-gradient(circle at top left, #f7fbff 0%, #eef3f9 42%, #e8edf5 100%);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }

        .dashboard-shell {
            max-width: 760px;
            margin: 0 auto;
            min-height: 100vh;
            background: rgba(245, 248, 252, 0.82);
            border-left: 1px solid rgba(217, 226, 238, 0.9);
            border-right: 1px solid rgba(217, 226, 238, 0.9);
            box-shadow: 0 0 0 1px rgba(255,255,255,0.5), 0 30px 70px rgba(25, 45, 75, 0.08);
            overflow: hidden;
        }

        .topbar {
            padding: 24px 34px;
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--stroke);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #48b6f0, #2989d8);
            color: #fff;
            font-size: 18px;
            box-shadow: 0 10px 18px rgba(65, 169, 232, 0.28);
        }

        .brand-text {
            font-size: 2rem;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 1px;
            color: #173052;
        }

        .brand-text span {
            color: #5e7da4;
            font-weight: 500;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .lang-switcher {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px;
            border-radius: 999px;
            background: rgba(255,255,255,0.95);
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
            font-weight: 700;
            color: var(--muted);
            transition: .2s ease;
        }

        .lang-switcher a.active {
            background: linear-gradient(135deg, #42b0eb, #2d89d4);
            color: #fff;
            box-shadow: 0 8px 18px rgba(45, 137, 212, 0.22);
        }

        .admin-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--text);
        }

        .avatar-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #1c4b83, #2d6db1);
            color: #fff;
            font-size: 1rem;
            font-weight: 800;
            box-shadow: 0 6px 14px rgba(28, 75, 131, 0.22);
            border: 3px solid rgba(255,255,255,0.95);
        }

        .page-body {
            padding: 34px 34px 145px;
        }

        .page-heading {
            font-size: clamp(2rem, 3vw, 3rem);
            line-height: 1.1;
            margin: 0 0 24px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #173052;
        }

        .card-soft {
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(217, 226, 238, 0.72);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
        }

        .order-hero {
            padding: 28px 30px;
            margin-bottom: 18px;
        }

        .order-title {
            font-size: clamp(1.7rem, 2.3vw, 2.2rem);
            font-weight: 800;
            margin: 0 0 12px;
            color: #163052;
        }

        .order-lines {
            display: grid;
            gap: 8px;
            color: var(--muted);
            font-size: 1.05rem;
        }

        .order-lines strong {
            color: #224167;
            font-weight: 700;
            margin-right: 6px;
        }

        .grid-cards {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 26px;
        }

        .info-card {
            background: rgba(255,255,255,0.78);
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
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, rgba(65,169,232,0.15), rgba(65,169,232,0.08));
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
            line-height: 1.2;
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
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: rgba(255,255,255,0.72);
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow-soft);
        }

        .current-response .left .title {
            font-size: .95rem;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .current-response .left .time {
            font-size: .9rem;
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
        }

        .state-pill.yes {
            background: rgba(53, 201, 155, 0.16);
            color: var(--success-deep);
        }

        .state-pill.maybe {
            background: rgba(242, 194, 68, 0.18);
            color: #926200;
        }

        .state-pill.no {
            background: rgba(246, 109, 109, 0.18);
            color: var(--danger-deep);
        }

        .response-panel {
            padding: 26px 28px;
        }

        .response-title {
            margin: 0 0 22px;
            font-size: 1.12rem;
            color: var(--text);
            font-weight: 800;
            text-align: center;
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
            width: 82px;
            height: 82px;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 2.2rem;
            box-shadow: 0 12px 24px rgba(0,0,0,0.10);
        }

        .response-btn .label {
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: -0.01em;
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
            color: var(--success-deep);
        }

        .response-btn.maybe .label {
            color: #936400;
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

        .account-strip {
            margin-top: 20px;
            padding: 18px 24px;
            border-radius: 22px;
            background: rgba(255,255,255,0.54);
            border: 1px solid var(--stroke-soft);
            color: var(--muted);
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .account-strip a {
            color: #2e73ba;
            font-weight: 700;
        }

        .alert-floating {
            border: 0;
            border-radius: 18px;
            box-shadow: var(--shadow-soft);
            padding: 14px 18px;
            margin-bottom: 18px;
        }

        .bottom-action-bar {
            position: sticky;
            bottom: 0;
            z-index: 20;
            padding: 18px 22px 26px;
            background: linear-gradient(to top, rgba(255,255,255,0.95), rgba(255,255,255,0.78), rgba(255,255,255,0));
            backdrop-filter: blur(8px);
        }

        .bottom-action-inner {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .bottom-btn {
            border: 0;
            border-radius: 999px;
            min-height: 60px;
            font-weight: 800;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: var(--shadow-soft);
            transition: transform .2s ease, opacity .2s ease;
        }

        .bottom-btn:hover {
            transform: translateY(-1px);
        }

        .bottom-btn.yes {
            background: linear-gradient(135deg, #58d9b0, #32c396);
            color: #fff;
        }

        .bottom-btn.maybe {
            background: linear-gradient(135deg, #f9dd86, #f2c347);
            color: #20314f;
        }

        .bottom-btn.no {
            background: linear-gradient(135deg, #ff9a9a, #f46d6d);
            color: #1f2f4c;
        }

        .empty-state {
            padding: 54px 28px;
            text-align: center;
        }

        .empty-icon {
            width: 84px;
            height: 84px;
            margin: 0 auto 18px;
            border-radius: 24px;
            display: grid;
            place-items: center;
            font-size: 2rem;
            color: var(--brand);
            background: linear-gradient(135deg, rgba(65,169,232,0.14), rgba(65,169,232,0.06));
        }

        @media (max-width: 767.98px) {
            .dashboard-shell {
                max-width: 100%;
                border-left: 0;
                border-right: 0;
                box-shadow: none;
            }

            .topbar,
            .page-body {
                padding-left: 18px;
                padding-right: 18px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
            }

            .brand-text {
                font-size: 1.6rem;
            }

            .page-heading {
                font-size: 2rem;
            }

            .order-hero,
            .response-panel {
                padding: 20px;
            }

            .grid-cards,
            .response-grid,
            .bottom-action-inner {
                grid-template-columns: 1fr;
            }

            .current-response {
                flex-direction: column;
                align-items: flex-start;
            }

            .response-btn .circle {
                width: 72px;
                height: 72px;
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    @php
        $userName = auth()->user()->name ?? 'Admin';
        $userEmail = auth()->user()->email ?? 'alexander@mediaav.eu';
        $avatarLetter = strtoupper(substr($userName, 0, 1));

        $currentResponseClass = match($myResponse->response ?? null) {
            'yes' => 'yes',
            'maybe' => 'maybe',
            'no' => 'no',
            default => '',
        };

        $currentResponseText = match($myResponse->response ?? null) {
            'yes' => __('order.yes'),
            'maybe' => __('order.possibly'),
            'no' => __('order.no'),
            default => __('order.no_response_yet'),
        };
    @endphp

    <div class="dashboard-shell">
        <header class="topbar">
            <div class="brand-wrap">
                <div class="brand-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="brand-text">MEDIA<span>AV</span></div>
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

                <div class="admin-chip">
                    <span>{{ $userName }}</span>
                    <div class="avatar-circle">{{ $avatarLetter }}</div>
                </div>
            </div>
        </header>

        <main class="page-body">

            @if(session('success'))
                <div class="alert alert-success alert-floating">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-floating">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
                </div>
            @endif

            <h1 class="page-heading">{{ __('order.new_order') }}</h1>

            @if($activeOrder)
                <section class="card-soft order-hero">
                    <h2 class="order-title">{{ $activeOrder->title }}</h2>

                    <div class="order-lines">
                        @if($activeOrder->location)
                            <div>
                                <strong>{{ __('order.location') }}:</strong> {{ $activeOrder->location }}
                            </div>
                        @endif

                        <div>
                            <strong>{{ __('order.date') }}:</strong>
                            {{ $activeOrder->start_date?->format('d.m.Y') }}
                            @if($activeOrder->end_date)
                                – {{ $activeOrder->end_date->format('d.m.Y') }}
                            @endif
                        </div>

                        @if($activeOrder->team_info)
                            <div>
                                <strong>{{ __('order.team_info') }}:</strong> {{ $activeOrder->team_info }}
                            </div>
                        @endif

                        @if($activeOrder->description)
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
                                @if($activeOrder->end_date)
                                    – {{ $activeOrder->end_date->format('d.m.Y') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($activeOrder->hourly_rate !== null)
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

                    @if($activeOrder->travel_cost !== null)
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa-solid fa-road"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">{{ __('order.travel_cost') }}</div>
                                <div class="info-value">
                                    {{ number_format($activeOrder->travel_cost, 2) }} €
                                    @if($activeOrder->travel_cost_unit)
                                        <small>/ {{ $activeOrder->travel_cost_unit }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->meal_allowance !== null)
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa-solid fa-utensils"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">{{ __('order.meal_allowance') }}</div>
                                <div class="info-value">{{ number_format($activeOrder->meal_allowance, 2) }} €</div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->custom_field_1_label && $activeOrder->custom_field_1_value)
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

                    @if($activeOrder->custom_field_2_label && $activeOrder->custom_field_2_value)
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

                @if($myResponse)
                    <div class="current-response">
                        <div class="left">
                            <div class="title">{{ __('order.your_current_response') }}</div>
                            <div class="time">
                                {{ $myResponse->responded_at?->format('d.m.Y H:i') }}
                            </div>
                        </div>

                        <div class="right">
                            <span class="state-pill {{ $currentResponseClass }}">
                                @if($myResponse->response === 'yes')
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
                    <h3 class="response-title">{{ __('order.please_select_your_response') }}</h3>

                    @error('response')
                        <div class="text-danger small text-center mb-3">{{ $message }}</div>
                    @enderror

                    <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                        @csrf

                        <div class="response-grid">
                            <button type="submit"
                                    name="response"
                                    value="yes"
                                    class="response-btn yes {{ $myResponse?->response === 'yes' ? 'active' : '' }}">
                                <div class="circle">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div class="label">{{ __('order.yes') }}</div>
                            </button>

                            <button type="submit"
                                    name="response"
                                    value="maybe"
                                    class="response-btn maybe {{ $myResponse?->response === 'maybe' ? 'active' : '' }}">
                                <div class="circle">
                                    <i class="fa-solid fa-question"></i>
                                </div>
                                <div class="label">{{ __('order.possibly') }}</div>
                            </button>

                            <button type="submit"
                                    name="response"
                                    value="no"
                                    class="response-btn no {{ $myResponse?->response === 'no' ? 'active' : '' }}">
                                <div class="circle">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                                <div class="label">{{ __('order.no') }}</div>
                            </button>
                        </div>
                    </form>
                </section>

                <div class="account-strip">
                    <span>{{ __('order.logged_in_as') }}:</span>
                    <a href="mailto:{{ $userEmail }}">{{ $userEmail }}</a>
                    <span>|</span>
                    <a href="{{ route('logout') }}">{{ __('order.logout') }}</a>
                </div>
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

        @if($activeOrder)
            <div class="bottom-action-bar">
                <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                    @csrf

                    <div class="bottom-action-inner">
                        <button type="submit" name="response" value="yes" class="bottom-btn yes">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>{{ __('order.yes') }}</span>
                        </button>

                        <button type="submit" name="response" value="maybe" class="bottom-btn maybe">
                            <i class="fa-solid fa-circle-question"></i>
                            <span>{{ __('order.possibly') }}</span>
                        </button>

                        <button type="submit" name="response" value="no" class="bottom-btn no">
                            <i class="fa-solid fa-circle-xmark"></i>
                            <span>{{ __('order.no') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

</body>
</html>