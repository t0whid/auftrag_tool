@extends('layouts.employee')

@php
    $pageTitle = __('employee.dashboard_heading');
@endphp

@section('content')
    @php
        $employeeUser = auth()->user();
    @endphp

    <div class="card-soft welcome-card">
        <h2 class="welcome-title">{{ __('employee.dashboard_heading') }}</h2>
        <p class="welcome-text">{{ __('employee.dashboard_subheading') }}</p>

        <div class="employee-chip">
            <div class="employee-chip-avatar">
                {{ strtoupper(substr($employeeUser->name ?? 'E', 0, 1)) }}
            </div>
            <div>
                <div class="employee-chip-name">{{ $employeeUser->name }}</div>
                <div class="employee-chip-role">{{ __('employee.employee_role') }}</div>
            </div>
        </div>
    </div>

    @if($activeOrder)
        <div class="card-soft employee-order-card">
            <div class="employee-order-head">
                <div class="employee-order-head-left">
                    <div class="employee-order-icon">
                        <i class="bi bi-clipboard2-check"></i>
                    </div>

                    <div>
                        <div class="employee-order-label">{{ __('employee.current_order_title') }}</div>
                        <h3 class="employee-order-title">{{ $activeOrder->title }}</h3>
                        <p class="employee-order-subtitle">
                            {{ $activeOrder->location ?: __('employee.no_location_text') }}
                        </p>
                    </div>
                </div>

                <div class="employee-order-status">
                    <span class="employee-status-badge">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ __('employee.active_order_badge') }}
                    </span>
                </div>
            </div>

            <div class="employee-order-meta">
                <div class="employee-meta-chip">
                    <i class="bi bi-calendar-event"></i>
                    <span>{{ $activeOrder->start_date?->format('d M Y') }} — {{ $activeOrder->end_date?->format('d M Y') }}</span>
                </div>

                @if($activeOrder->team_info)
                    <div class="employee-meta-chip">
                        <i class="bi bi-people"></i>
                        <span>{{ $activeOrder->team_info }}</span>
                    </div>
                @endif

                @if($activeOrder->location)
                    <div class="employee-meta-chip">
                        <i class="bi bi-geo-alt"></i>
                        <span>{{ $activeOrder->location }}</span>
                    </div>
                @endif
            </div>

            <div class="employee-order-section">
                <div class="employee-section-title">
                    <i class="bi bi-card-text"></i>
                    <span>{{ __('employee.order_description') }}</span>
                </div>

                <div class="employee-description-box" style="white-space: pre-line;">{{ $activeOrder->description }}</div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-12 col-lg-6">
                    <div class="employee-info-card h-100">
                        <div class="employee-section-title">
                            <i class="bi bi-cash-stack"></i>
                            <span>{{ __('employee.cost_fields_title') }}</span>
                        </div>

                        <div class="employee-info-list">
                            <div class="employee-info-row">
                                <span>{{ __('employee.hourly_rate') }}</span>
                                <strong>{{ $activeOrder->hourly_rate !== null ? $activeOrder->hourly_rate : '—' }}</strong>
                            </div>

                            <div class="employee-info-row">
                                <span>{{ __('employee.travel_cost') }}</span>
                                <strong>{{ $activeOrder->travel_cost !== null ? $activeOrder->travel_cost : '—' }}</strong>
                            </div>

                            <div class="employee-info-row">
                                <span>{{ __('employee.travel_cost_unit') }}</span>
                                <strong>{{ $activeOrder->travel_cost_unit ?: '—' }}</strong>
                            </div>

                            <div class="employee-info-row">
                                <span>{{ __('employee.meal_allowance') }}</span>
                                <strong>{{ $activeOrder->meal_allowance !== null ? $activeOrder->meal_allowance : '—' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="employee-info-card h-100">
                        <div class="employee-section-title">
                            <i class="bi bi-input-cursor-text"></i>
                            <span>{{ __('employee.custom_fields_title') }}</span>
                        </div>

                        <div class="employee-info-list">
                            @if($activeOrder->custom_field_1_label || $activeOrder->custom_field_1_value)
                                <div class="employee-info-row employee-info-row-stack">
                                    <span>{{ $activeOrder->custom_field_1_label ?: __('employee.custom_field_1') }}</span>
                                    <strong>{{ $activeOrder->custom_field_1_value ?: '—' }}</strong>
                                </div>
                            @endif

                            @if($activeOrder->custom_field_2_label || $activeOrder->custom_field_2_value)
                                <div class="employee-info-row employee-info-row-stack">
                                    <span>{{ $activeOrder->custom_field_2_label ?: __('employee.custom_field_2') }}</span>
                                    <strong>{{ $activeOrder->custom_field_2_value ?: '—' }}</strong>
                                </div>
                            @endif

                            @if(
                                !($activeOrder->custom_field_1_label || $activeOrder->custom_field_1_value) &&
                                !($activeOrder->custom_field_2_label || $activeOrder->custom_field_2_value)
                            )
                                <div class="employee-info-empty">
                                    {{ __('employee.no_custom_fields') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="employee-next-step-note">
                <i class="bi bi-info-circle"></i>
                <span>{{ __('employee.response_buttons_coming') }}</span>
            </div>
        </div>
    @else
        <div class="card-soft order-placeholder">
            <div class="placeholder-icon">
                <i class="bi bi-clipboard2-check"></i>
            </div>

            <div class="placeholder-title">{{ __('employee.no_active_order_title') }}</div>
            <div class="placeholder-text">{{ __('employee.no_active_order_text') }}</div>

            <div class="info-list">
                <div class="info-item">
                    <i class="bi bi-eye"></i>
                    <div>
                        <div class="info-item-title">{{ __('employee.info_visibility_title') }}</div>
                        <div class="info-item-text">{{ __('employee.info_visibility_text') }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-phone"></i>
                    <div>
                        <div class="info-item-title">{{ __('employee.info_mobile_title') }}</div>
                        <div class="info-item-text">{{ __('employee.info_mobile_text') }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-arrow-repeat"></i>
                    <div>
                        <div class="info-item-title">{{ __('employee.info_response_title') }}</div>
                        <div class="info-item-text">{{ __('employee.info_response_text') }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="employee-footer-actions">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-soft-light w-100">
                <i class="bi bi-box-arrow-right me-1"></i>
                {{ __('auth.logout') }}
            </button>
        </form>
    </div>
@endsection

@push('styles')
<style>
    .employee-order-card {
        padding: 22px;
        overflow: hidden;
    }

    .employee-order-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        flex-wrap: wrap;
    }

    .employee-order-head-left {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .employee-order-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, #eef6ff 0%, #e1efff 100%);
        color: #2f80ed;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .employee-order-label {
        font-size: .78rem;
        font-weight: 800;
        color: #5f84c7;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 6px;
    }

    .employee-order-title {
        font-size: 1.4rem;
        font-weight: 900;
        color: #163253;
        margin: 0;
        line-height: 1.2;
    }

    .employee-order-subtitle {
        margin: 6px 0 0;
        color: #6b7a90;
    }

    .employee-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        background: #dcfce7;
        color: #166534;
        font-weight: 800;
        font-size: .88rem;
    }

    .employee-order-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .employee-meta-chip {
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

    .employee-meta-chip i {
        color: #2f80ed;
    }

    .employee-order-section {
        margin-top: 18px;
    }

    .employee-section-title {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: .95rem;
        font-weight: 800;
        color: #163253;
        margin-bottom: 12px;
    }

    .employee-section-title i {
        color: #2f80ed;
    }

    .employee-description-box {
        padding: 16px;
        border-radius: 18px;
        background: #f8fbff;
        border: 1px solid #e7eef6;
        color: #1f2d3d;
        line-height: 1.7;
        font-weight: 500;
    }

    .employee-info-card {
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        border: 1px solid #e7eef6;
    }

    .employee-info-list {
        display: grid;
        gap: 12px;
    }

    .employee-info-row {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 12px 14px;
        border-radius: 14px;
        background: #f9fbfe;
        border: 1px solid #ebf1f7;
        font-size: .94rem;
    }

    .employee-info-row span {
        color: #6b7a90;
        font-weight: 600;
    }

    .employee-info-row strong {
        color: #163253;
        font-weight: 800;
        text-align: right;
    }

    .employee-info-row-stack {
        flex-direction: column;
        align-items: flex-start;
    }

    .employee-info-row-stack strong {
        text-align: left;
    }

    .employee-info-empty {
        padding: 14px;
        border-radius: 14px;
        background: #f9fbfe;
        border: 1px dashed #dfe8f2;
        color: #6b7a90;
        font-size: .93rem;
    }

    .employee-next-step-note {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
        padding: 12px 14px;
        border-radius: 14px;
        background: #fff8e8;
        color: #8a6400;
        font-weight: 700;
        font-size: .9rem;
    }

    @media (max-width: 576px) {
        .employee-order-card {
            padding: 18px;
        }

        .employee-order-head {
            flex-direction: column;
            align-items: stretch;
        }

        .employee-info-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .employee-info-row strong {
            text-align: left;
        }
    }
</style>
@endpush