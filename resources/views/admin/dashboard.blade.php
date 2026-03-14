@extends('layouts.admin')

@php
    $pageTitle = __('admin.dashboard_heading');
    $pageHeading = __('admin.dashboard_heading');
    $pageSubheading = __('admin.dashboard_subheading');
@endphp

@section('content')
    <div class="dashboard-shell">
        <div class="dashboard-hero card-soft">
            <div class="dashboard-hero-content">
                <div class="dashboard-hero-left">
                    <div class="dashboard-hero-badge">
                        <i class="bi bi-stars"></i>
                        <span>{{ __('admin.dashboard_heading') }}</span>
                    </div>

                    <h2 class="dashboard-hero-title">{{ __('admin.dashboard_heading') }}</h2>
                    <p class="dashboard-hero-text">{{ __('admin.dashboard_subheading') }}</p>

                    <div class="dashboard-hero-actions">
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-soft-primary">
                            <i class="bi bi-people-fill me-1"></i>
                            {{ __('admin.nav_employees') }}
                        </a>

                        <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-dark">
                            <i class="bi bi-clipboard2-check-fill me-1"></i>
                            {{ __('order.orders_heading') }}
                        </a>

                        <a href="{{ route('admin.order-responses.index') }}" class="btn btn-soft-success">
                            <i class="bi bi-chat-left-text-fill me-1"></i>
                            {{ __('order.nav_order_responses') }}
                        </a>
                    </div>
                </div>

                <div class="dashboard-hero-right">
                    <div class="hero-mini-grid">
                        <div class="hero-mini-card">
                            <div class="hero-mini-label">{{ __('admin.total_employees') }}</div>
                            <div class="hero-mini-value">{{ $employeeCount }}</div>
                        </div>

                        <div class="hero-mini-card">
                            <div class="hero-mini-label">{{ __('order.orders_heading') }}</div>
                            <div class="hero-mini-value">{{ $orderCount }}</div>
                        </div>

                        <div class="hero-mini-card">
                            <div class="hero-mini-label">{{ __('order.total_responses') }}</div>
                            <div class="hero-mini-value">{{ $responseCount }}</div>
                        </div>

                        <div class="hero-mini-card">
                            <div class="hero-mini-label">{{ __('order.active_order') }}</div>
                            <div class="hero-mini-value">{{ $activeOrderCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-xl-4 col-md-6">
                <div class="card-soft dashboard-stat-card">
                    <div class="dashboard-stat-top">
                        <div class="dashboard-stat-icon bg-soft-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <span class="dashboard-stat-chip chip-primary">{{ __('admin.total_employees') }}</span>
                    </div>
                    <div class="dashboard-stat-value">{{ $employeeCount }}</div>
                    <div class="dashboard-stat-meta">{{ __('admin.employees_subheading') }}</div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card-soft dashboard-stat-card">
                    <div class="dashboard-stat-top">
                        <div class="dashboard-stat-icon bg-soft-success">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <span class="dashboard-stat-chip chip-success">{{ __('admin.active_employees') }}</span>
                    </div>
                    <div class="dashboard-stat-value">{{ $activeEmployeeCount }}</div>
                    <div class="dashboard-stat-meta">{{ __('admin.dashboard_subheading') }}</div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card-soft dashboard-stat-card">
                    <div class="dashboard-stat-top">
                        <div class="dashboard-stat-icon bg-soft-danger">
                            <i class="bi bi-person-x-fill"></i>
                        </div>
                        <span class="dashboard-stat-chip chip-danger">{{ __('admin.inactive_employees') }}</span>
                    </div>
                    <div class="dashboard-stat-value">{{ $inactiveEmployeeCount }}</div>
                    <div class="dashboard-stat-meta">{{ __('admin.dashboard_subheading') }}</div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card-soft dashboard-stat-card">
                    <div class="dashboard-stat-top">
                        <div class="dashboard-stat-icon bg-soft-info">
                            <i class="bi bi-clipboard2-data-fill"></i>
                        </div>
                        <span class="dashboard-stat-chip chip-info">{{ __('order.orders_heading') }}</span>
                    </div>
                    <div class="dashboard-stat-value">{{ $orderCount }}</div>
                    <div class="dashboard-stat-meta">
                        {{ __('order.active') }}: {{ $activeOrderCount }} • {{ __('order.inactive') }}: {{ $inactiveOrderCount }}
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card-soft dashboard-stat-card">
                    <div class="dashboard-stat-top">
                        <div class="dashboard-stat-icon bg-soft-warning">
                            <i class="bi bi-chat-left-dots-fill"></i>
                        </div>
                        <span class="dashboard-stat-chip chip-warning">{{ __('order.total_responses') }}</span>
                    </div>
                    <div class="dashboard-stat-value">{{ $responseCount }}</div>
                    <div class="dashboard-stat-meta">
                        {{ __('order.yes_short') }}: {{ $yesResponseCount }} •
                        {{ __('order.maybe_short') }}: {{ $maybeResponseCount }} •
                        {{ __('order.no_short') }}: {{ $noResponseCount }}
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card-soft dashboard-stat-card">
                    <div class="dashboard-stat-top">
                        <div class="dashboard-stat-icon bg-soft-dark">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <span class="dashboard-stat-chip chip-dark">{{ __('order.active_order') }}</span>
                    </div>
                    <div class="dashboard-stat-value">{{ $activeOrderCount }}</div>
                    <div class="dashboard-stat-meta">
                        {{ $latestActiveOrder?->title ?? '—' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-xl-5">
                <div class="card-soft dashboard-section-card h-100">
                    <div class="dashboard-section-header">
                        <div>
                            <h3 class="panel-title">{{ __('order.active_order') }}</h3>
                            <p class="panel-subtitle">{{ __('order.order_details') }}</p>
                        </div>

                        @if($latestActiveOrder)
                            <a href="{{ route('admin.orders.show', $latestActiveOrder) }}" class="btn btn-soft-info btn-sm">
                                <i class="bi bi-eye me-1"></i>
                                {{ __('order.view') }}
                            </a>
                        @endif
                    </div>

                    @if($latestActiveOrder)
                        <div class="active-order-box">
                            <div class="active-order-title-row">
                                <h4 class="active-order-title">{{ $latestActiveOrder->title }}</h4>
                                <span class="badge-block-no">
                                    <i class="bi bi-check-circle"></i>
                                    {{ __('order.active') }}
                                </span>
                            </div>

                            <div class="active-order-meta-list">
                                <div class="active-order-meta-item">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>
                                        {{ $latestActiveOrder->start_date?->format('d M Y') }}
                                        —
                                        {{ $latestActiveOrder->end_date?->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="active-order-meta-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $latestActiveOrder->location ?: '—' }}</span>
                                </div>

                                <div class="active-order-meta-item">
                                    <i class="bi bi-people"></i>
                                    <span>{{ $latestActiveOrder->team_info ?: '—' }}</span>
                                </div>

                                <div class="active-order-meta-item">
                                    <i class="bi bi-person-badge"></i>
                                    <span>{{ $latestActiveOrder->creator?->name ?? '—' }}</span>
                                </div>
                            </div>

                            @if($latestActiveOrder->description)
                                <div class="active-order-description">
                                    {{ \Illuminate\Support\Str::limit($latestActiveOrder->description, 180) }}
                                </div>
                            @endif

                            <div class="active-order-actions">
                                <a href="{{ route('admin.orders.edit', $latestActiveOrder) }}" class="btn btn-soft-primary btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    {{ __('order.edit') }}
                                </a>

                                <a href="{{ route('admin.order-responses.show', $latestActiveOrder) }}" class="btn btn-soft-success btn-sm">
                                    <i class="bi bi-chat-left-text me-1"></i>
                                    {{ __('order.responses') }}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            <div class="dashboard-empty-icon">
                                <i class="bi bi-clipboard-x"></i>
                            </div>
                            <h5 class="mb-2">{{ __('order.no_active_order_available') }}</h5>
                            <p class="text-muted mb-0">{{ __('order.please_check_back_later') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-7">
                <div class="card-soft dashboard-section-card h-100">
                    <div class="dashboard-section-header">
                        <div>
                            <h3 class="panel-title">{{ __('order.responses') }}</h3>
                            <p class="panel-subtitle">{{ __('order.employee_responses_subtitle') }}</p>
                        </div>

                        <a href="{{ route('admin.order-responses.index') }}" class="btn btn-soft-info btn-sm">
                            <i class="bi bi-arrow-right-circle me-1"></i>
                            {{ __('order.view_responses') }}
                        </a>
                    </div>

                    @if($recentResponses->count())
                        <div class="dashboard-response-list">
                            @foreach($recentResponses as $response)
                                <div class="dashboard-response-item">
                                    <div class="dashboard-response-main">
                                        <div class="dashboard-response-title">
                                            {{ $response->user?->name ?? '—' }}
                                        </div>
                                        <div class="dashboard-response-subtitle">
                                            {{ $response->order?->title ?? '—' }}
                                        </div>
                                    </div>

                                    <div class="dashboard-response-side">
                                        @if($response->response === 'yes')
                                            <span class="response-badge response-badge-yes">
                                                <i class="bi bi-check-circle-fill"></i>
                                                {{ __('order.yes') }}
                                            </span>
                                        @elseif($response->response === 'maybe')
                                            <span class="response-badge response-badge-maybe">
                                                <i class="bi bi-question-circle-fill"></i>
                                                {{ __('order.possibly') }}
                                            </span>
                                        @else
                                            <span class="response-badge response-badge-no">
                                                <i class="bi bi-x-circle-fill"></i>
                                                {{ __('order.no') }}
                                            </span>
                                        @endif

                                        <div class="dashboard-response-time">
                                            {{ $response->responded_at?->format('d M Y, h:i A') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            <div class="dashboard-empty-icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                            <h5 class="mb-2">{{ __('order.no_responses_yet') }}</h5>
                            <p class="text-muted mb-0">{{ __('order.no_responses_yet_subtitle') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-soft dashboard-section-card mt-4">
            <div class="dashboard-section-header">
                <div>
                    <h3 class="panel-title">{{ __('order.orders_heading') }}</h3>
                    <p class="panel-subtitle">{{ __('order.orders_subheading') }}</p>
                </div>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-primary btn-sm">
                    <i class="bi bi-arrow-right-circle me-1"></i>
                    {{ __('order.view') }}
                </a>
            </div>

            <div class="row g-3">
                @forelse($recentOrders as $order)
                    <div class="col-xl-4 col-md-6">
                        <div class="recent-order-card">
                            <div class="recent-order-top">
                                <h4 class="recent-order-title">{{ $order->title }}</h4>

                                @if($order->is_active)
                                    <span class="badge-block-no">
                                        <i class="bi bi-check-circle"></i>
                                        {{ __('order.active') }}
                                    </span>
                                @else
                                    <span class="badge-block-yes">
                                        <i class="bi bi-dash-circle"></i>
                                        {{ __('order.inactive') }}
                                    </span>
                                @endif
                            </div>

                            <div class="recent-order-meta">
                                <div><i class="bi bi-calendar-event"></i> {{ $order->start_date?->format('d M Y') }}</div>
                                <div><i class="bi bi-geo-alt"></i> {{ $order->location ?: '—' }}</div>
                                <div><i class="bi bi-person-badge"></i> {{ $order->creator?->name ?? '—' }}</div>
                            </div>

                            <div class="recent-order-actions">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-soft-info btn-sm w-100">
                                    <i class="bi bi-eye me-1"></i>
                                    {{ __('order.view') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="dashboard-empty-state">
                            <div class="dashboard-empty-icon">
                                <i class="bi bi-folder2-open"></i>
                            </div>
                            <h5 class="mb-2">{{ __('order.no_orders_found') }}</h5>
                            <p class="text-muted mb-0">{{ __('order.orders_subheading') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .dashboard-shell {
        display: grid;
        gap: 22px;
    }

    .dashboard-hero {
        position: relative;
        overflow: hidden;
        padding: 28px;
        background:
            radial-gradient(circle at top right, rgba(47, 128, 237, 0.12), transparent 24%),
            linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        border: 1px solid #e5edf6;
    }

    .dashboard-hero-content {
        display: flex;
        justify-content: space-between;
        gap: 22px;
        align-items: stretch;
    }

    .dashboard-hero-left {
        flex: 1;
        min-width: 0;
    }

    .dashboard-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eef6ff;
        color: #2f80ed;
        font-weight: 800;
        font-size: .85rem;
        margin-bottom: 14px;
    }

    .dashboard-hero-title {
        margin: 0;
        font-size: 2rem;
        font-weight: 900;
        line-height: 1.1;
        color: #163253;
        letter-spacing: -.02em;
    }

    .dashboard-hero-text {
        margin: 10px 0 0;
        color: #6b7a90;
        font-size: 1rem;
        max-width: 760px;
    }

    .dashboard-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 22px;
    }

    .dashboard-hero-right {
        width: 360px;
        flex-shrink: 0;
    }

    .hero-mini-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        height: 100%;
    }

    .hero-mini-card {
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(180deg, #f8fbff 0%, #f3f8fe 100%);
        border: 1px solid #e7eef6;
    }

    .hero-mini-label {
        color: #6b7a90;
        font-size: .82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 8px;
    }

    .hero-mini-value {
        font-size: 1.7rem;
        font-weight: 900;
        line-height: 1;
        color: #163253;
    }

    .dashboard-stat-card {
        padding: 22px;
        height: 100%;
        border: 1px solid #e7eef6;
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
    }

    .dashboard-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
    }

    .dashboard-stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .bg-soft-primary {
        background: #eaf3ff;
        color: #2f80ed;
    }

    .bg-soft-success {
        background: #dcfce7;
        color: #166534;
    }

    .bg-soft-danger {
        background: #fee2e2;
        color: #b91c1c;
    }

    .bg-soft-info {
        background: #e0f2fe;
        color: #0c4a6e;
    }

    .bg-soft-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .bg-soft-dark {
        background: #e5ebf3;
        color: #163253;
    }

    .dashboard-stat-chip {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: .8rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .chip-primary {
        background: #eef6ff;
        color: #2f80ed;
    }

    .chip-success {
        background: #dcfce7;
        color: #166534;
    }

    .chip-danger {
        background: #fee2e2;
        color: #b91c1c;
    }

    .chip-info {
        background: #e0f2fe;
        color: #0c4a6e;
    }

    .chip-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .chip-dark {
        background: #e5ebf3;
        color: #163253;
    }

    .dashboard-stat-value {
        font-size: 2rem;
        font-weight: 900;
        line-height: 1;
        color: #163253;
    }

    .dashboard-stat-meta {
        margin-top: 10px;
        color: #6b7a90;
        font-size: .95rem;
        line-height: 1.45;
    }

    .dashboard-section-card {
        padding: 22px;
        border: 1px solid #e7eef6;
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
    }

    .dashboard-section-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .active-order-box {
        padding: 20px;
        border-radius: 22px;
        background: linear-gradient(180deg, #f8fbff 0%, #f4f9fe 100%);
        border: 1px solid #e6eef7;
    }

    .active-order-title-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .active-order-title {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 900;
        color: #163253;
    }

    .active-order-meta-list {
        display: grid;
        gap: 10px;
        margin-top: 16px;
    }

    .active-order-meta-item {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        color: #46607d;
        font-weight: 600;
    }

    .active-order-meta-item i {
        color: #2f80ed;
        margin-top: 2px;
    }

    .active-order-description {
        margin-top: 16px;
        padding: 14px 16px;
        border-radius: 16px;
        background: #fff;
        border: 1px solid #e7eef6;
        color: #4f6278;
        line-height: 1.7;
    }

    .active-order-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    .dashboard-response-list {
        display: grid;
        gap: 12px;
    }

    .dashboard-response-item {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        align-items: center;
        padding: 16px 18px;
        border-radius: 18px;
        background: #f9fbfe;
        border: 1px solid #e9eff6;
    }

    .dashboard-response-main {
        min-width: 0;
    }

    .dashboard-response-title {
        font-size: 1rem;
        font-weight: 800;
        color: #163253;
    }

    .dashboard-response-subtitle {
        font-size: .92rem;
        color: #6b7a90;
        margin-top: 4px;
    }

    .dashboard-response-side {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
        text-align: right;
    }

    .dashboard-response-time {
        font-size: .82rem;
        color: #6b7a90;
        font-weight: 700;
        white-space: nowrap;
    }

    .response-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 12px;
        border-radius: 999px;
        font-weight: 800;
        font-size: .88rem;
        white-space: nowrap;
    }

    .response-badge-yes {
        background: #dcfce7;
        color: #166534;
    }

    .response-badge-maybe {
        background: #fef3c7;
        color: #92400e;
    }

    .response-badge-no {
        background: #fee2e2;
        color: #b91c1c;
    }

    .recent-order-card {
        height: 100%;
        padding: 18px;
        border-radius: 20px;
        background: #f9fbfe;
        border: 1px solid #e9eff6;
    }

    .recent-order-top {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 14px;
    }

    .recent-order-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 800;
        color: #163253;
        line-height: 1.35;
    }

    .recent-order-meta {
        display: grid;
        gap: 8px;
        color: #5f7087;
        font-weight: 600;
        font-size: .9rem;
    }

    .recent-order-meta div {
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .recent-order-meta i {
        color: #2f80ed;
        margin-top: 2px;
    }

    .recent-order-actions {
        margin-top: 16px;
    }

    .dashboard-empty-state {
        text-align: center;
        padding: 28px 18px;
    }

    .dashboard-empty-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 14px;
        border-radius: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        background: #eef6ff;
        color: #2f80ed;
    }

    @media (max-width: 1199.98px) {
        .dashboard-hero-content {
            flex-direction: column;
        }

        .dashboard-hero-right {
            width: 100%;
        }
    }

    @media (max-width: 767.98px) {
        .dashboard-hero,
        .dashboard-section-card,
        .dashboard-stat-card {
            padding: 18px;
        }

        .dashboard-hero-title {
            font-size: 1.55rem;
        }

        .hero-mini-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-response-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .dashboard-response-side {
            align-items: flex-start;
            text-align: left;
        }

        .active-order-title-row,
        .recent-order-top {
            flex-direction: column;
        }
    }
</style>
@endpush