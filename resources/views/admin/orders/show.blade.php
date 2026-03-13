@extends('layouts.admin')

@php
    $pageTitle = __('order.view_order');
    $pageHeading = __('order.view_order');
    $pageSubheading = $order->title;
@endphp

@section('content')
    <div class="order-view-shell">
        <div class="card-soft order-hero-card">
            <div class="order-hero-top">
                <div class="order-hero-left">
                    <div class="order-hero-icon">
                        <i class="bi bi-clipboard2-check"></i>
                    </div>

                    <div>
                        <div class="order-hero-label">{{ __('order.order_details') }}</div>
                        <h1 class="order-hero-title">{{ $order->title }}</h1>
                        <p class="order-hero-subtitle">
                            {{ $order->location ?: __('order.no_location_text') }}
                        </p>
                    </div>
                </div>

                <div class="order-hero-right">
                    @if($order->is_active)
                        <span class="order-status-badge order-status-active">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ __('order.active') }}
                        </span>
                    @else
                        <span class="order-status-badge order-status-inactive">
                            <i class="bi bi-dash-circle-fill"></i>
                            {{ __('order.inactive') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="order-hero-meta">
                <div class="order-meta-chip">
                    <i class="bi bi-calendar-event"></i>
                    <span>
                        {{ $order->start_date?->format('d M Y') }} — {{ $order->end_date?->format('d M Y') }}
                    </span>
                </div>

                <div class="order-meta-chip">
                    <i class="bi bi-geo-alt"></i>
                    <span>{{ $order->location ?: '—' }}</span>
                </div>

                <div class="order-meta-chip">
                    <i class="bi bi-people"></i>
                    <span>{{ $order->team_info ?: '—' }}</span>
                </div>

                <div class="order-meta-chip">
                    <i class="bi bi-person-badge"></i>
                    <span>{{ $order->creator?->name ?? '—' }}</span>
                </div>
            </div>

            <div class="order-hero-actions">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-light order-btn">
                    <i class="bi bi-arrow-left me-1"></i>
                    {{ __('order.back') }}
                </a>

                <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-soft-primary order-btn">
                    <i class="bi bi-pencil-square me-1"></i>
                    {{ __('order.edit') }}
                </a>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-xl-8">
                <div class="card-soft order-section-card h-100">
                    <div class="order-section-header">
                        <div class="order-section-icon">
                            <i class="bi bi-card-text"></i>
                        </div>
                        <div>
                            <h3 class="order-section-title">{{ __('order.basic_information') }}</h3>
                            <p class="order-section-subtitle">{{ __('order.basic_information_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="order-description-box">
                        <div class="order-field-label">{{ __('order.description') }}</div>
                        <div class="order-description-text" style="white-space: pre-line;">{{ $order->description }}</div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="order-info-card">
                                <div class="order-field-label">{{ __('order.title') }}</div>
                                <div class="order-field-value">{{ $order->title }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="order-info-card">
                                <div class="order-field-label">{{ __('order.location') }}</div>
                                <div class="order-field-value">{{ $order->location ?: '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="order-info-card">
                                <div class="order-field-label">{{ __('order.team_info') }}</div>
                                <div class="order-field-value">{{ $order->team_info ?: '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="order-info-card">
                                <div class="order-field-label">{{ __('order.created_by') }}</div>
                                <div class="order-field-value">{{ $order->creator?->name ?? '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card-soft order-section-card h-100">
                    <div class="order-section-header">
                        <div class="order-section-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <div>
                            <h3 class="order-section-title">{{ __('order.schedule_and_status') }}</h3>
                            <p class="order-section-subtitle">{{ __('order.schedule_and_status_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="order-info-stack">
                        <div class="order-info-row">
                            <span class="order-field-label">{{ __('order.start_date') }}</span>
                            <span class="order-field-value">{{ $order->start_date?->format('d M Y') }}</span>
                        </div>

                        <div class="order-info-row">
                            <span class="order-field-label">{{ __('order.end_date') }}</span>
                            <span class="order-field-value">{{ $order->end_date?->format('d M Y') }}</span>
                        </div>

                        <div class="order-info-row">
                            <span class="order-field-label">{{ __('order.is_active') }}</span>
                            <span class="order-field-value">
                                @if($order->is_active)
                                    <span class="inline-status inline-status-active">
                                        <i class="bi bi-check-circle-fill"></i>
                                        {{ __('order.active') }}
                                    </span>
                                @else
                                    <span class="inline-status inline-status-inactive">
                                        <i class="bi bi-dash-circle-fill"></i>
                                        {{ __('order.inactive') }}
                                    </span>
                                @endif
                            </span>
                        </div>

                        <div class="order-info-row">
                            <span class="order-field-label">{{ __('order.created_at') }}</span>
                            <span class="order-field-value">{{ $order->created_at?->format('d M Y, h:i A') }}</span>
                        </div>

                        <div class="order-info-row">
                            <span class="order-field-label">{{ __('order.updated_at') }}</span>
                            <span class="order-field-value">{{ $order->updated_at?->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card-soft order-section-card h-100">
                    <div class="order-section-header">
                        <div class="order-section-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div>
                            <h3 class="order-section-title">{{ __('order.cost_fields') }}</h3>
                            <p class="order-section-subtitle">{{ __('order.cost_fields_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="order-metric-card">
                                <div class="order-metric-icon"><i class="bi bi-clock-history"></i></div>
                                <div class="order-field-label">{{ __('order.hourly_rate') }}</div>
                                <div class="order-metric-value">{{ $order->hourly_rate !== null ? $order->hourly_rate : '—' }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="order-metric-card">
                                <div class="order-metric-icon"><i class="bi bi-signpost-split"></i></div>
                                <div class="order-field-label">{{ __('order.travel_cost') }}</div>
                                <div class="order-metric-value">{{ $order->travel_cost !== null ? $order->travel_cost : '—' }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="order-metric-card">
                                <div class="order-metric-icon"><i class="bi bi-rulers"></i></div>
                                <div class="order-field-label">{{ __('order.travel_cost_unit') }}</div>
                                <div class="order-metric-value">{{ $order->travel_cost_unit ?: '—' }}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="order-metric-card">
                                <div class="order-metric-icon"><i class="bi bi-cup-hot"></i></div>
                                <div class="order-field-label">{{ __('order.meal_allowance') }}</div>
                                <div class="order-metric-value">{{ $order->meal_allowance !== null ? $order->meal_allowance : '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card-soft order-section-card h-100">
                    <div class="order-section-header">
                        <div class="order-section-icon">
                            <i class="bi bi-input-cursor-text"></i>
                        </div>
                        <div>
                            <h3 class="order-section-title">{{ __('order.custom_fields') }}</h3>
                            <p class="order-section-subtitle">{{ __('order.custom_fields_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="order-custom-card">
                                <div class="order-field-label">{{ __('order.custom_field_1_label') }}</div>
                                <div class="order-field-value">{{ $order->custom_field_1_label ?: '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="order-custom-card">
                                <div class="order-field-label">{{ __('order.custom_field_1_value') }}</div>
                                <div class="order-field-value">{{ $order->custom_field_1_value ?: '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="order-custom-card">
                                <div class="order-field-label">{{ __('order.custom_field_2_label') }}</div>
                                <div class="order-field-value">{{ $order->custom_field_2_label ?: '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="order-custom-card">
                                <div class="order-field-label">{{ __('order.custom_field_2_value') }}</div>
                                <div class="order-field-value">{{ $order->custom_field_2_value ?: '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .order-view-shell {
        display: grid;
        gap: 22px;
    }

    .order-hero-card {
        position: relative;
        overflow: hidden;
        padding: 26px;
        background:
            radial-gradient(circle at top right, rgba(47, 128, 237, 0.10), transparent 24%),
            linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        border: 1px solid #e5edf6;
    }

    .order-hero-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        flex-wrap: wrap;
    }

    .order-hero-left {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        min-width: 0;
    }

    .order-hero-icon {
        width: 68px;
        height: 68px;
        border-radius: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, #eef6ff 0%, #dfeeff 100%);
        color: #2f80ed;
        font-size: 1.7rem;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
        flex-shrink: 0;
    }

    .order-hero-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .78rem;
        font-weight: 800;
        color: #5f84c7;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 6px;
    }

    .order-hero-title {
        margin: 0;
        font-size: 1.85rem;
        line-height: 1.15;
        font-weight: 900;
        color: #163253;
        letter-spacing: -.02em;
    }

    .order-hero-subtitle {
        margin: 8px 0 0;
        color: #6b7a90;
        font-size: 1rem;
    }

    .order-hero-right {
        display: flex;
        align-items: center;
    }

    .order-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        font-weight: 800;
        font-size: .9rem;
        white-space: nowrap;
    }

    .order-status-active {
        background: #dcfce7;
        color: #166534;
    }

    .order-status-inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

    .order-hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .order-meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        background: #f8fbff;
        border: 1px solid #e4edf6;
        color: #46607d;
        font-weight: 700;
        font-size: .9rem;
    }

    .order-meta-chip i {
        color: #2f80ed;
    }

    .order-hero-actions {
        margin-top: 22px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .order-btn {
        min-width: 150px;
    }

    .order-section-card {
        padding: 22px;
        border: 1px solid #e7eef6;
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
    }

    .order-section-header {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 18px;
    }

    .order-section-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, #eef6ff 0%, #e4f0ff 100%);
        color: #2f80ed;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .order-section-title {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 800;
        color: #163253;
    }

    .order-section-subtitle {
        margin: 4px 0 0;
        color: #6b7a90;
        font-size: .92rem;
    }

    .order-description-box {
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(180deg, #f8fbff 0%, #f5f9fe 100%);
        border: 1px solid #e7eef6;
        margin-bottom: 18px;
    }

    .order-description-text {
        color: #1f2d3d;
        font-weight: 500;
        line-height: 1.7;
        margin-top: 6px;
    }

    .order-info-card,
    .order-custom-card {
        height: 100%;
        padding: 16px 18px;
        border-radius: 18px;
        background: #f9fbfe;
        border: 1px solid #e9eff6;
    }

    .order-field-label {
        color: #7a8ca3;
        font-size: .82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 6px;
    }

    .order-field-value {
        color: #163253;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.45;
    }

    .order-info-stack {
        display: grid;
        gap: 14px;
    }

    .order-info-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 14px 16px;
        border-radius: 16px;
        background: #f9fbfe;
        border: 1px solid #e9eff6;
        align-items: center;
    }

    .order-info-row .order-field-label {
        margin-bottom: 0;
    }

    .order-info-row .order-field-value {
        text-align: right;
    }

    .inline-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-weight: 800;
    }

    .inline-status-active {
        color: #166534;
    }

    .inline-status-inactive {
        color: #b91c1c;
    }

    .order-metric-card {
        height: 100%;
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(180deg, #f8fbff 0%, #f3f8fe 100%);
        border: 1px solid #e7eef6;
    }

    .order-metric-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eaf3ff;
        color: #2f80ed;
        font-size: 1rem;
        margin-bottom: 12px;
    }

    .order-metric-value {
        font-size: 1.2rem;
        font-weight: 900;
        color: #163253;
        line-height: 1.2;
    }

    @media (max-width: 991.98px) {
        .order-hero-title {
            font-size: 1.55rem;
        }
    }

    @media (max-width: 767.98px) {
        .order-hero-card,
        .order-section-card {
            padding: 18px;
        }

        .order-hero-top {
            flex-direction: column;
            align-items: stretch;
        }

        .order-hero-left {
            align-items: flex-start;
        }

        .order-hero-actions {
            flex-direction: column;
        }

        .order-btn {
            width: 100%;
        }

        .order-info-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-info-row .order-field-value {
            text-align: left;
        }

        .order-hero-title {
            font-size: 1.35rem;
        }
    }
</style>
@endpush