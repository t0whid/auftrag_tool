@extends('layouts.admin')

@php
    $pageTitle = __('order.view_order');
    $pageHeading = __('order.view_order');
    $pageSubheading = $order->title;
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="panel-title">{{ $order->title }}</h3>
                <p class="panel-subtitle">{{ __('order.order_details') }}</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-action-edit">
                    <i class="bi bi-pencil-square me-1"></i>
                    {{ __('order.edit') }}
                </a>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-light">
                    <i class="bi bi-arrow-left me-1"></i>
                    {{ __('order.back') }}
                </a>
            </div>
        </div>

        <div class="panel-body">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-section-card h-100">
                        <div class="form-section-title">
                            <i class="bi bi-card-text me-2"></i>
                            {{ __('order.basic_information') }}
                        </div>

                        <div class="mt-3">
                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.title') }}</div>
                                <div class="fw-semibold">{{ $order->title }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.description') }}</div>
                                <div class="fw-semibold" style="white-space: pre-line;">{{ $order->description }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.location') }}</div>
                                <div class="fw-semibold">{{ $order->location ?: '—' }}</div>
                            </div>

                            <div class="mb-0">
                                <div class="text-muted small">{{ __('order.team_info') }}</div>
                                <div class="fw-semibold">{{ $order->team_info ?: '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-section-card h-100">
                        <div class="form-section-title">
                            <i class="bi bi-calendar-event me-2"></i>
                            {{ __('order.schedule_and_status') }}
                        </div>

                        <div class="mt-3">
                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.start_date') }}</div>
                                <div class="fw-semibold">{{ $order->start_date?->format('d M Y') }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.end_date') }}</div>
                                <div class="fw-semibold">{{ $order->end_date?->format('d M Y') }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.created_by') }}</div>
                                <div class="fw-semibold">{{ $order->creator?->name ?? '—' }}</div>
                            </div>

                            <div class="mb-0">
                                <div class="text-muted small">{{ __('order.is_active') }}</div>
                                <div class="fw-semibold">
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-section-card h-100">
                        <div class="form-section-title">
                            <i class="bi bi-cash-stack me-2"></i>
                            {{ __('order.cost_fields') }}
                        </div>

                        <div class="mt-3">
                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.hourly_rate') }}</div>
                                <div class="fw-semibold">{{ $order->hourly_rate !== null ? $order->hourly_rate : '—' }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.travel_cost') }}</div>
                                <div class="fw-semibold">{{ $order->travel_cost !== null ? $order->travel_cost : '—' }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.travel_cost_unit') }}</div>
                                <div class="fw-semibold">{{ $order->travel_cost_unit ?: '—' }}</div>
                            </div>

                            <div class="mb-0">
                                <div class="text-muted small">{{ __('order.meal_allowance') }}</div>
                                <div class="fw-semibold">{{ $order->meal_allowance !== null ? $order->meal_allowance : '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-section-card h-100">
                        <div class="form-section-title">
                            <i class="bi bi-input-cursor-text me-2"></i>
                            {{ __('order.custom_fields') }}
                        </div>

                        <div class="mt-3">
                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.custom_field_1_label') }}</div>
                                <div class="fw-semibold">{{ $order->custom_field_1_label ?: '—' }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.custom_field_1_value') }}</div>
                                <div class="fw-semibold">{{ $order->custom_field_1_value ?: '—' }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">{{ __('order.custom_field_2_label') }}</div>
                                <div class="fw-semibold">{{ $order->custom_field_2_label ?: '—' }}</div>
                            </div>

                            <div class="mb-0">
                                <div class="text-muted small">{{ __('order.custom_field_2_value') }}</div>
                                <div class="fw-semibold">{{ $order->custom_field_2_value ?: '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection