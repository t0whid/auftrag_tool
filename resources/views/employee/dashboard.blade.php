@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($activeOrder)
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">
                    <div>
                        <h2 class="mb-1">{{ $activeOrder->title }}</h2>
                        <p class="text-muted mb-0">
                            {{ $activeOrder->start_date?->format('d.m.Y') }}
                            @if($activeOrder->end_date)
                                - {{ $activeOrder->end_date->format('d.m.Y') }}
                            @endif
                        </p>
                    </div>

                    @if($myResponse)
                        <div class="text-end">
                            <div class="small text-muted">Your current response</div>
                            <span class="badge
                                @if($myResponse->response === 'yes') bg-success
                                @elseif($myResponse->response === 'maybe') bg-warning text-dark
                                @else bg-danger @endif">
                                {{ ucfirst($myResponse->response) }}
                            </span>
                            <div class="small text-muted mt-1">
                                {{ $myResponse->responded_at?->format('d.m.Y H:i') }}
                            </div>
                        </div>
                    @endif
                </div>

                @if($activeOrder->description)
                    <div class="mb-3">
                        <h6 class="fw-bold">Description</h6>
                        <div class="text-muted">{!! nl2br(e($activeOrder->description)) !!}</div>
                    </div>
                @endif

                <div class="row g-3 mb-4">
                    @if($activeOrder->location)
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted">Location</div>
                                <div class="fw-semibold">{{ $activeOrder->location }}</div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->team_info)
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted">Team Info</div>
                                <div class="fw-semibold">{{ $activeOrder->team_info }}</div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->hourly_rate)
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted">Hourly Rate</div>
                                <div class="fw-semibold">{{ number_format($activeOrder->hourly_rate, 2) }}</div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->travel_cost)
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted">Travel Cost</div>
                                <div class="fw-semibold">
                                    {{ number_format($activeOrder->travel_cost, 2) }}
                                    @if($activeOrder->travel_cost_unit)
                                        / {{ $activeOrder->travel_cost_unit }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->meal_allowance)
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted">Meal Allowance</div>
                                <div class="fw-semibold">{{ number_format($activeOrder->meal_allowance, 2) }}</div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->custom_field_1_label && $activeOrder->custom_field_1_value)
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted">{{ $activeOrder->custom_field_1_label }}</div>
                                <div class="fw-semibold">{{ $activeOrder->custom_field_1_value }}</div>
                            </div>
                        </div>
                    @endif

                    @if($activeOrder->custom_field_2_label && $activeOrder->custom_field_2_value)
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted">{{ $activeOrder->custom_field_2_label }}</div>
                                <div class="fw-semibold">{{ $activeOrder->custom_field_2_value }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                    @csrf

                    <div class="mb-2 fw-semibold">Please select your response:</div>

                    @error('response')
                        <div class="text-danger small mb-2">{{ $message }}</div>
                    @enderror

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <button type="submit"
                                name="response"
                                value="yes"
                                class="btn {{ $myResponse?->response === 'yes' ? 'btn-success' : 'btn-outline-success' }} flex-fill">
                            Yes
                        </button>

                        <button type="submit"
                                name="response"
                                value="maybe"
                                class="btn {{ $myResponse?->response === 'maybe' ? 'btn-warning text-dark' : 'btn-outline-warning' }} flex-fill">
                            Possibly
                        </button>

                        <button type="submit"
                                name="response"
                                value="no"
                                class="btn {{ $myResponse?->response === 'no' ? 'btn-danger' : 'btn-outline-danger' }} flex-fill">
                            No
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 text-center">
                <h4 class="mb-2">No active order available</h4>
                <p class="text-muted mb-0">Please check back later.</p>
            </div>
        </div>
    @endif

</div>
@endsection