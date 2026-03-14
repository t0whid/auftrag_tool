@extends('layouts.admin')

@php
    $pageTitle = __('order.responses_for_order');
    $pageHeading = __('order.responses_for_order');
    $pageSubheading = $order->title;
@endphp

@section('content')
    <div class="order-response-shell">
        <div class="card-soft response-hero-card">
            <div class="response-hero-top">
                <div class="response-hero-left">
                    <div class="response-hero-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div>
                        <div class="response-hero-label">{{ __('order.response_overview') }}</div>
                        <h1 class="response-hero-title">{{ $order->title }}</h1>
                        <p class="response-hero-subtitle">
                            {{ $order->location ?: __('order.no_location_text') }}
                        </p>
                    </div>
                </div>

                <div class="response-hero-right">
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

            <div class="response-hero-meta">
                <div class="response-meta-chip">
                    <i class="bi bi-calendar-event"></i>
                    <span>
                        {{ $order->start_date?->format('d M Y') }} — {{ $order->end_date?->format('d M Y') }}
                    </span>
                </div>

                <div class="response-meta-chip">
                    <i class="bi bi-person-badge"></i>
                    <span>{{ $order->creator?->name ?? '—' }}</span>
                </div>

                <div class="response-meta-chip">
                    <i class="bi bi-geo-alt"></i>
                    <span>{{ $order->location ?: '—' }}</span>
                </div>

                <div class="response-meta-chip">
                    <i class="bi bi-people"></i>
                    <span>{{ $order->team_info ?: '—' }}</span>
                </div>
            </div>

            <div class="response-hero-actions">
                <a href="{{ route('admin.order-responses.index') }}" class="btn btn-soft-light response-btn">
                    <i class="bi bi-arrow-left me-1"></i>
                    {{ __('order.back_to_response_list') }}
                </a>

                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-soft-primary response-btn">
                    <i class="bi bi-clipboard2-check me-1"></i>
                    {{ __('order.view_order') }}
                </a>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-xl-3 col-md-6">
                <div class="card-soft stat-response-card stat-response-total">
                    <div class="stat-response-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-response-label">{{ __('order.total_responses') }}</div>
                    <div class="stat-response-value">{{ $stats['total'] }}</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-soft stat-response-card stat-response-yes">
                    <div class="stat-response-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="stat-response-label">{{ __('order.yes_responses') }}</div>
                    <div class="stat-response-value">{{ $stats['yes'] }}</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-soft stat-response-card stat-response-maybe">
                    <div class="stat-response-icon">
                        <i class="bi bi-question-circle-fill"></i>
                    </div>
                    <div class="stat-response-label">{{ __('order.maybe_responses') }}</div>
                    <div class="stat-response-value">{{ $stats['maybe'] }}</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-soft stat-response-card stat-response-no">
                    <div class="stat-response-icon">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <div class="stat-response-label">{{ __('order.no_responses_count_label') }}</div>
                    <div class="stat-response-value">{{ $stats['no'] }}</div>
                </div>
            </div>
        </div>

        <div class="card-soft mt-4">
            <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h3 class="panel-title">{{ __('order.employee_responses') }}</h3>
                    <p class="panel-subtitle">{{ __('order.employee_responses_subtitle') }}</p>
                </div>

                @if($stats['latest_response_at'])
                    <div class="last-response-chip">
                        <i class="bi bi-clock-history"></i>
                        <span>
                            {{ __('order.last_response') }}:
                            {{ \Carbon\Carbon::parse($stats['latest_response_at'])->format('d M Y, h:i A') }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="panel-body">
                @if($responses->count())
                    <div class="table-shell">
                        <div class="table-responsive">
                            <table class="table table-modern align-middle mb-0" id="orderResponseDetailsTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('order.employee_name') }}</th>
                                        <th>{{ __('order.employee_email') }}</th>
                                        <th>{{ __('order.selected_response') }}</th>
                                        <th>{{ __('order.response_date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($responses as $response)
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">{{ $response->user?->name ?? '—' }}</div>
                                            </td>
                                            <td>{{ $response->user?->email ?? '—' }}</td>
                                            <td class="table-center">
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
                                            </td>
                                            <td class="table-center">
                                                {{ $response->responded_at?->format('d M Y') }}
                                                <br>
                                                <span class="text-muted small">
                                                    {{ $response->responded_at?->format('h:i A') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="empty-response-state">
                        <div class="empty-response-icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <h4 class="mb-2">{{ __('order.no_responses_yet') }}</h4>
                        <p class="text-muted mb-0">{{ __('order.no_responses_yet_subtitle') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .order-response-shell {
        display: grid;
        gap: 22px;
    }

    .response-hero-card {
        position: relative;
        overflow: hidden;
        padding: 26px;
        background:
            radial-gradient(circle at top right, rgba(47, 128, 237, 0.10), transparent 24%),
            linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        border: 1px solid #e5edf6;
    }

    .response-hero-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        flex-wrap: wrap;
    }

    .response-hero-left {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        min-width: 0;
    }

    .response-hero-icon {
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

    .response-hero-label {
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

    .response-hero-title {
        margin: 0;
        font-size: 1.85rem;
        line-height: 1.15;
        font-weight: 900;
        color: #163253;
        letter-spacing: -.02em;
    }

    .response-hero-subtitle {
        margin: 8px 0 0;
        color: #6b7a90;
        font-size: 1rem;
    }

    .response-hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .response-meta-chip {
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

    .response-meta-chip i {
        color: #2f80ed;
    }

    .response-hero-actions {
        margin-top: 22px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .response-btn {
        min-width: 180px;
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

    .stat-response-card {
        padding: 22px;
        height: 100%;
        border: 1px solid #e7eef6;
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
    }

    .stat-response-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 14px;
    }

    .stat-response-label {
        color: #6b7a90;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .stat-response-value {
        font-size: 1.9rem;
        font-weight: 900;
        line-height: 1;
        color: #163253;
    }

    .stat-response-total .stat-response-icon {
        background: #eaf3ff;
        color: #2f80ed;
    }

    .stat-response-yes .stat-response-icon {
        background: #dcfce7;
        color: #166534;
    }

    .stat-response-maybe .stat-response-icon {
        background: #fef3c7;
        color: #92400e;
    }

    .stat-response-no .stat-response-icon {
        background: #fee2e2;
        color: #b91c1c;
    }

    .response-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 12px;
        border-radius: 999px;
        font-weight: 800;
        font-size: .88rem;
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

    .last-response-chip {
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

    .last-response-chip i {
        color: #2f80ed;
    }

    .empty-response-state {
        text-align: center;
        padding: 32px 18px;
    }

    .empty-response-icon {
        width: 74px;
        height: 74px;
        margin: 0 auto 14px;
        border-radius: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        background: #eef6ff;
        color: #2f80ed;
    }

    @media (max-width: 767.98px) {
        .response-hero-card {
            padding: 18px;
        }

        .response-hero-top {
            flex-direction: column;
            align-items: stretch;
        }

        .response-hero-title {
            font-size: 1.35rem;
        }

        .response-hero-actions {
            flex-direction: column;
        }

        .response-btn {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#orderResponseDetailsTable').DataTable({
            pageLength: 10,
            ordering: true,
            autoWidth: false,
            order: [[3, 'desc']],
            columnDefs: [{
                    className: 'text-center',
                    targets: [2, 3]
                }
            ]
        });
    });
</script>
@endpush