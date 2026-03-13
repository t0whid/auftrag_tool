@extends('layouts.app')

@section('content')
<style>
    :root {
        --page-bg: #edf2f8;
        --card-bg: #ffffff;
        --text-main: #183153;
        --text-soft: #6c809c;
        --border-soft: #d9e2ee;
        --shadow-soft: 0 10px 30px rgba(24, 49, 83, 0.08);
        --radius-xl: 28px;
        --radius-lg: 22px;
        --radius-md: 18px;

        --yes-bg: linear-gradient(135deg, #5dd7b2 0%, #38c9b5 100%);
        --maybe-bg: linear-gradient(135deg, #f7dc84 0%, #f0c759 100%);
        --no-bg: linear-gradient(135deg, #ff9a9a 0%, #ff7a7a 100%);

        --yes-text: #0f9f7f;
        --maybe-text: #9d6b00;
        --no-text: #d94b4b;
    }

    body {
        background: linear-gradient(180deg, #f4f7fb 0%, #eaf0f7 100%);
        color: var(--text-main);
    }

    .employee-shell {
        max-width: 760px;
        margin: 0 auto;
        padding: 18px 14px 120px;
    }

    .phone-frame {
        background: rgba(255, 255, 255, 0.35);
        border: 1px solid rgba(24, 49, 83, 0.08);
        border-radius: 34px;
        box-shadow: 0 20px 45px rgba(24, 49, 83, 0.12);
        overflow: hidden;
        backdrop-filter: blur(8px);
    }

    .employee-topbar {
        background: #f8fbff;
        border-bottom: 1px solid var(--border-soft);
        padding: 16px 18px;
    }

    .employee-brand-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }

    .employee-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .employee-logo-wrap {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        flex-shrink: 0;
    }

    .employee-logo-wrap img {
        max-width: 78%;
        max-height: 78%;
        object-fit: contain;
    }

    .employee-brand-text h1 {
        font-size: 1.05rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: 0.02em;
    }

    .employee-brand-text p {
        margin: 2px 0 0;
        color: var(--text-soft);
        font-size: 0.9rem;
    }

    .employee-user-chip {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 1px solid var(--border-soft);
        padding: 8px 12px;
        border-radius: 999px;
        box-shadow: var(--shadow-soft);
        color: var(--text-main);
        font-weight: 700;
        font-size: 0.95rem;
    }

    .employee-user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #184f90;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.95rem;
    }

    .employee-content {
        background: #f5f8fc;
        padding: 22px 16px 24px;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.15;
        color: var(--text-main);
    }

    .soft-card {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(24, 49, 83, 0.04);
    }

    .order-main-card {
        padding: 24px 22px;
        margin-bottom: 16px;
    }

    .order-title {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 14px;
        color: var(--text-main);
    }

    .order-lines {
        display: grid;
        gap: 8px;
    }

    .order-line {
        font-size: 1.25rem;
        line-height: 1.45;
        color: var(--text-main);
    }

    .order-line .label {
        color: var(--text-soft);
        margin-right: 4px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 18px;
    }

    .info-card {
        padding: 16px 18px;
        min-height: 88px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .info-card.single-line {
        min-height: 76px;
    }

    .info-label {
        font-size: 1rem;
        color: var(--text-soft);
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .info-value {
        font-size: 1.45rem;
        font-weight: 800;
        line-height: 1.2;
        color: var(--text-main);
        word-break: break-word;
    }

    .info-value small {
        font-weight: 600;
        font-size: 1rem;
        color: var(--text-soft);
    }

    .response-card {
        padding: 22px 16px;
        margin-bottom: 18px;
    }

    .response-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        text-align: center;
    }

    .response-option {
        border: none;
        background: transparent;
        padding: 8px;
        border-radius: 18px;
        transition: transform 0.18s ease, background 0.18s ease;
        color: var(--text-main);
    }

    .response-option:active {
        transform: scale(0.97);
    }

    .response-option.selected-yes {
        background: rgba(56, 201, 181, 0.1);
    }

    .response-option.selected-maybe {
        background: rgba(240, 199, 89, 0.16);
    }

    .response-option.selected-no {
        background: rgba(255, 122, 122, 0.12);
    }

    .response-circle {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.6rem;
        font-weight: 900;
        color: #fff;
        box-shadow: 0 8px 18px rgba(24, 49, 83, 0.12);
    }

    .response-circle.yes {
        background: var(--yes-bg);
    }

    .response-circle.maybe {
        background: var(--maybe-bg);
    }

    .response-circle.no {
        background: var(--no-bg);
    }

    .response-text {
        font-size: 1.15rem;
        font-weight: 700;
        line-height: 1.25;
    }

    .response-text.yes {
        color: var(--yes-text);
    }

    .response-text.maybe {
        color: #7f6208;
    }

    .response-text.no {
        color: var(--no-text);
    }

    .account-card {
        padding: 18px 18px;
        color: var(--text-soft);
        font-size: 1rem;
        line-height: 1.45;
    }

    .account-card a {
        color: #2b6cb0;
        text-decoration: none;
        font-weight: 600;
    }

    .account-card a:hover {
        text-decoration: underline;
    }

    .sticky-response-bar {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 50;
        padding: 12px 14px max(14px, env(safe-area-inset-bottom));
        background: rgba(245, 248, 252, 0.92);
        backdrop-filter: blur(14px);
        border-top: 1px solid rgba(24, 49, 83, 0.08);
    }

    .sticky-response-inner {
        max-width: 760px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .sticky-response-btn {
        border: none;
        border-radius: 999px;
        min-height: 58px;
        padding: 12px 18px;
        font-size: 1.15rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 22px rgba(24, 49, 83, 0.12);
        color: var(--text-main);
    }

    .sticky-response-btn .icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255,255,255,0.82);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 900;
    }

    .sticky-response-btn.yes {
        background: var(--yes-bg);
        color: #fff;
    }

    .sticky-response-btn.maybe {
        background: var(--maybe-bg);
        color: #183153;
    }

    .sticky-response-btn.no {
        background: var(--no-bg);
        color: #183153;
    }

    .sticky-response-btn.is-selected {
        outline: 3px solid rgba(24, 49, 83, 0.14);
    }

    .empty-state {
        padding: 42px 20px;
        text-align: center;
    }

    .empty-state h3 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--text-soft);
        margin: 0;
    }

    .flash-wrap {
        margin-bottom: 14px;
    }

    @media (min-width: 576px) {
        .employee-shell {
            padding: 28px 22px 132px;
        }

        .employee-content {
            padding: 28px 22px 28px;
        }

        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .sticky-response-inner {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 575.98px) {
        .section-title {
            font-size: 1.8rem;
        }

        .order-title {
            font-size: 1.55rem;
        }

        .order-line {
            font-size: 1.08rem;
        }

        .info-value {
            font-size: 1.22rem;
        }

        .response-circle {
            width: 72px;
            height: 72px;
            font-size: 2.2rem;
        }

        .response-text {
            font-size: 1rem;
        }

        .employee-brand-row {
            align-items: flex-start;
        }

        .employee-user-chip {
            font-size: 0.9rem;
        }
    }
</style>

<div class="employee-shell">
    <div class="phone-frame">
        <div class="employee-topbar">
            <div class="employee-brand-row">
                <div class="employee-brand">
                    <div class="employee-logo-wrap">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    </div>

                    <div class="employee-brand-text">
                        <h1>MEDIAAV</h1>
                        <p>{{ __('Employee Dashboard') }}</p>
                    </div>
                </div>

                <div class="employee-user-chip">
                    <span>{{ auth()->user()->name ?? 'Employee' }}</span>
                    <span class="employee-user-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'E', 0, 1)) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="employee-content">
            <div class="flash-wrap">
                @if(session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mb-3">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            @if($activeOrder)
                <h2 class="section-title">{{ __('Neuer Auftrag') }}</h2>

                <div class="soft-card order-main-card">
                    <div class="order-title">
                        {{ $activeOrder->title }}
                    </div>

                    <div class="order-lines">
                        @if($activeOrder->location)
                            <div class="order-line">
                                <span class="label">{{ __('Ort:') }}</span>{{ $activeOrder->location }}
                            </div>
                        @endif

                        @if($activeOrder->start_date || $activeOrder->end_date)
                            <div class="order-line">
                                <span class="label">{{ __('Datum:') }}</span>
                                {{ $activeOrder->start_date?->format('d.m.Y') }}
                                @if($activeOrder->end_date)
                                    &nbsp;–&nbsp;{{ $activeOrder->end_date->format('d.m.Y') }}
                                @endif
                            </div>
                        @endif

                        @if($activeOrder->team_info)
                            <div class="order-line">
                                <span class="label">{{ __('Team:') }}</span>{{ $activeOrder->team_info }}
                            </div>
                        @endif

                        @if($activeOrder->description)
                            <div class="order-line">
                                {!! nl2br(e($activeOrder->description)) !!}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="info-grid">
                    @if($activeOrder->start_date || $activeOrder->end_date)
                        <div class="soft-card info-card single-line" style="grid-column: 1 / -1;">
                            <div class="info-value" style="font-size: 1.25rem;">
                                📅
                                {{ $activeOrder->start_date?->format('d.m.Y') }}
                                @if($activeOrder->end_date)
                                    &nbsp;–&nbsp;{{ $activeOrder->end_date->format('d.m.Y') }}
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(!is_null($activeOrder->hourly_rate))
                        <div class="soft-card info-card">
                            <div class="info-label">{{ __('Stundensatz') }}</div>
                            <div class="info-value">
                                {{ number_format($activeOrder->hourly_rate, 2, ',', '.') }} €
                                <small>{{ __('/ Stunde') }}</small>
                            </div>
                        </div>
                    @endif

                    @if(!is_null($activeOrder->travel_cost))
                        <div class="soft-card info-card">
                            <div class="info-label">{{ __('Fahrtkosten') }}</div>
                            <div class="info-value">
                                {{ number_format($activeOrder->travel_cost, 2, ',', '.') }} €
                                @if($activeOrder->travel_cost_unit)
                                    <small>/ {{ $activeOrder->travel_cost_unit }}</small>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(!is_null($activeOrder->meal_allowance))
                        <div class="soft-card info-card">
                            <div class="info-label">{{ __('Verpflegung') }}</div>
                            <div class="info-value">
                                {{ number_format($activeOrder->meal_allowance, 2, ',', '.') }} €
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->custom_field_1_label)
                        <div class="soft-card info-card">
                            <div class="info-label">{{ $activeOrder->custom_field_1_label }}</div>
                            <div class="info-value">
                                {{ $activeOrder->custom_field_1_value ?: '—' }}
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->custom_field_2_label)
                        <div class="soft-card info-card">
                            <div class="info-label">{{ $activeOrder->custom_field_2_label }}</div>
                            <div class="info-value">
                                {{ $activeOrder->custom_field_2_value ?: '—' }}
                            </div>
                        </div>
                    @endif
                </div>

                <div class="soft-card response-card">
                    <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                        @csrf

                        @error('response')
                            <div class="text-danger small mb-3">{{ $message }}</div>
                        @enderror

                        <div class="response-grid">
                            <button type="submit"
                                    name="response"
                                    value="yes"
                                    class="response-option {{ $myResponse?->response === 'yes' ? 'selected-yes' : '' }}">
                                <div class="response-circle yes">✓</div>
                                <div class="response-text yes">{{ __('Ja, bin dabei') }}</div>
                            </button>

                            <button type="submit"
                                    name="response"
                                    value="maybe"
                                    class="response-option {{ $myResponse?->response === 'maybe' ? 'selected-maybe' : '' }}">
                                <div class="response-circle maybe">?</div>
                                <div class="response-text maybe">{{ __('Eventuell') }}</div>
                            </button>

                            <button type="submit"
                                    name="response"
                                    value="no"
                                    class="response-option {{ $myResponse?->response === 'no' ? 'selected-no' : '' }}">
                                <div class="response-circle no">✕</div>
                                <div class="response-text no">{{ __('Nein, bin raus') }}</div>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="soft-card account-card">
                    {{ __('Angemeldet als:') }}
                    <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit"
                                style="background:none;border:none;padding:0;color:#2b6cb0;font-weight:600;">
                            {{ __('Abmelden') }}
                        </button>
                    </form>

                    @if($myResponse)
                        <div class="mt-2 small">
                            {{ __('Aktuelle Antwort:') }}
                            <strong>{{ ucfirst($myResponse->response) }}</strong>
                            @if($myResponse->responded_at)
                                · {{ $myResponse->responded_at->format('d.m.Y H:i') }}
                            @endif
                        </div>
                    @endif
                </div>
            @else
                <div class="soft-card empty-state">
                    <h3>{{ __('Kein aktiver Auftrag verfügbar') }}</h3>
                    <p>{{ __('Bitte später erneut prüfen.') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

@if($activeOrder)
    <div class="sticky-response-bar">
        <div class="sticky-response-inner">
            <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                @csrf
                <input type="hidden" name="response" value="yes">
                <button type="submit"
                        class="sticky-response-btn yes {{ $myResponse?->response === 'yes' ? 'is-selected' : '' }}">
                    <span class="icon">✓</span>
                    <span>{{ __('Ja, bin dabei') }}</span>
                </button>
            </form>

            <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                @csrf
                <input type="hidden" name="response" value="maybe">
                <button type="submit"
                        class="sticky-response-btn maybe {{ $myResponse?->response === 'maybe' ? 'is-selected' : '' }}">
                    <span class="icon">?</span>
                    <span>{{ __('Eventuell') }}</span>
                </button>
            </form>

            <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                @csrf
                <input type="hidden" name="response" value="no">
                <button type="submit"
                        class="sticky-response-btn no {{ $myResponse?->response === 'no' ? 'is-selected' : '' }}">
                    <span class="icon">✕</span>
                    <span>{{ __('Nein, bin raus') }}</span>
                </button>
            </form>
        </div>
    </div>
@endif
@endsection