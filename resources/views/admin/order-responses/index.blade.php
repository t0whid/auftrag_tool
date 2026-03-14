@extends('layouts.admin')

@php
    $pageTitle = __('order.order_responses_heading');
    $pageHeading = __('order.order_responses_heading');
    $pageSubheading = __('order.order_responses_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="panel-title">{{ __('order.order_responses_heading') }}</h3>
                <p class="panel-subtitle">{{ __('order.order_responses_subheading') }}</p>
            </div>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-light">
                <i class="bi bi-clipboard2-check me-1"></i>
                {{ __('order.orders_heading') }}
            </a>
        </div>

        <div class="panel-body">
            <div class="table-shell">
                <div class="table-responsive">
                    <table class="table table-modern align-middle mb-0" id="orderResponsesTable">
                        <thead>
                            <tr>
                                <th>{{ __('order.sl') }}</th>
                                <th>{{ __('order.title') }}</th>
                                <th>{{ __('order.location') }}</th>
                                <th>{{ __('order.date') }}</th>
                                <th>{{ __('order.created_by') }}</th>
                                <th>{{ __('order.order_status') }}</th>
                                <th>{{ __('order.response_summary') }}</th>
                                <th>{{ __('order.last_response') }}</th>
                                <th>{{ __('order.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td class="table-center fw-bold">{{ $index + 1 }}</td>

                                    <td>
                                        <div class="fw-semibold text-dark">{{ $order->title }}</div>
                                        @if($order->is_active)
                                            <div class="small text-primary fw-semibold mt-1">
                                                <i class="bi bi-stars me-1"></i>{{ __('order.current_order') }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>{{ $order->location ?: '—' }}</td>

                                    <td class="table-center">
                                        {{ $order->start_date?->format('d M Y') }}
                                        <br>
                                        <span class="text-muted small">
                                            {{ $order->end_date?->format('d M Y') }}
                                        </span>
                                    </td>

                                    <td>{{ $order->creator?->name ?? '—' }}</td>

                                    <td class="table-center">
                                        @if ($order->is_active)
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
                                    </td>

                                    <td>
                                        <div class="response-summary-wrap">
                                            <div class="response-pill-row">
                                                <span class="response-pill response-pill-yes">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    {{ __('order.yes_short') }}: {{ $order->yes_responses_count }}
                                                </span>

                                                <span class="response-pill response-pill-maybe">
                                                    <i class="bi bi-question-circle-fill"></i>
                                                    {{ __('order.maybe_short') }}: {{ $order->maybe_responses_count }}
                                                </span>

                                                <span class="response-pill response-pill-no">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                    {{ __('order.no_short') }}: {{ $order->no_responses_count }}
                                                </span>
                                            </div>

                                            <div class="response-total-text">
                                                {{ __('order.total_responses') }}: {{ $order->responses_count }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-center">
                                        @if ($order->responses_max_responded_at)
                                            <div class="last-response-date">
                                                {{ \Carbon\Carbon::parse($order->responses_max_responded_at)->format('d M Y') }}
                                            </div>
                                            <div class="last-response-time">
                                                {{ \Carbon\Carbon::parse($order->responses_max_responded_at)->format('h:i A') }}
                                            </div>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    <td class="table-center">
                                        <div class="action-group action-group-compact">
                                            <a href="{{ route('admin.order-responses.show', $order) }}"
                                                class="btn btn-sm btn-soft-light rounded-pill px-3 action-btn-compact">
                                                <i class="bi bi-eye me-1"></i>
                                                {{ __('order.responses') }}
                                            </a>

                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-action-edit action-btn-compact">
                                                <i class="bi bi-clipboard-data me-1"></i>
                                                {{ __('order.view') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .response-summary-wrap {
        min-width: 246px;
    }

    .response-pill-row {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 8px;
    }

    .response-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: .79rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .response-pill-yes {
        background: #dcfce7;
        color: #166534;
    }

    .response-pill-maybe {
        background: #fef3c7;
        color: #92400e;
    }

    .response-pill-no {
        background: #fee2e2;
        color: #b91c1c;
    }

    .response-total-text {
        font-size: .9rem;
        font-weight: 700;
        color: #5f7087;
    }

    .last-response-date {
        font-weight: 700;
        color: #163253;
        white-space: nowrap;
    }

    .last-response-time {
        margin-top: 4px;
        font-size: .83rem;
        color: #6b7a90;
        white-space: nowrap;
    }

    .action-group-compact {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: center;
    }

    .action-btn-compact {
        min-width: 132px;
        justify-content: center;
    }

    @media (max-width: 767.98px) {
        .response-summary-wrap {
            min-width: 180px;
        }

        .action-btn-compact {
            min-width: 110px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#orderResponsesTable').DataTable({
            pageLength: 10,
            ordering: true,
            autoWidth: false,
            order: [],
            columnDefs: [{
                    orderable: false,
                    targets: [0, 6, 8]
                },
                {
                    className: 'text-center',
                    targets: [0, 3, 5, 7, 8]
                }
            ]
        });
    });
</script>
@endpush