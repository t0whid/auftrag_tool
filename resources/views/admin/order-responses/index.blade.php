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
                            @foreach ($orders as $order)
                                <tr>
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

                                            <div class="small text-muted fw-semibold mt-2">
                                                {{ __('order.total_responses') }}: {{ $order->responses_count }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-center">
                                        @if ($order->responses_responded_at_max)
                                            {{ \Carbon\Carbon::parse($order->responses_responded_at_max)->format('d M Y') }}
                                            <br>
                                            <span class="text-muted small">
                                                {{ \Carbon\Carbon::parse($order->responses_responded_at_max)->format('h:i A') }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    <td class="table-center">
                                        <div class="action-group">
                                            <a href="{{ route('admin.order-responses.show', $order) }}"
                                                class="btn btn-sm btn-soft-light rounded-pill px-3">
                                                <i class="bi bi-eye me-1"></i>
                                                {{ __('order.view_responses') }}
                                            </a>

                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-action-edit">
                                                <i class="bi bi-clipboard-data me-1"></i>
                                                {{ __('order.view_order') }}
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
        min-width: 210px;
    }

    .response-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 999px;
        font-size: .8rem;
        font-weight: 800;
        margin: 2px 6px 2px 0;
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
                    targets: [5, 7]
                },
                {
                    className: 'text-center',
                    targets: [2, 4, 6, 7]
                }
            ]
        });
    });
</script>
@endpush