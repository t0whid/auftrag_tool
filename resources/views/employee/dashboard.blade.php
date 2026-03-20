@extends('layouts.employee')

@section('content')
    <h1 class="page-heading">{{ __('order.new_order') }}</h1>

    @if ($activeOrder)
        <section class="card-soft order-hero">
            <h2 class="order-title">{{ $activeOrder->title }}</h2>

            <div class="order-lines">
                @if ($activeOrder->location)
                    <div>
                        <strong>{{ __('order.location') }}:</strong> {{ $activeOrder->location }}
                    </div>
                @endif

                <div>
                    <strong>{{ __('order.date') }}:</strong>
                    {{ $activeOrder->start_date?->format('d.m.Y') }}
                    @if ($activeOrder->end_date)
                        – {{ $activeOrder->end_date->format('d.m.Y') }}
                    @endif
                </div>

                @if ($activeOrder->team_info)
                    <div>
                        <strong>{{ __('order.team_info') }}:</strong> {{ $activeOrder->team_info }}
                    </div>
                @endif

                @if ($activeOrder->description)
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
                        @if ($activeOrder->end_date)
                            – {{ $activeOrder->end_date->format('d.m.Y') }}
                        @endif
                    </div>
                </div>
            </div>

            @if ($activeOrder->hourly_rate !== null)
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

            @if ($activeOrder->travel_cost !== null)
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fa-solid fa-road"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">{{ __('order.travel_cost') }}</div>
                        <div class="info-value">
                            {{ number_format($activeOrder->travel_cost, 2) }} €
                            @if ($activeOrder->travel_cost_unit)
                                <small>/ {{ $activeOrder->travel_cost_unit }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if ($activeOrder->meal_allowance !== null)
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

            @if ($activeOrder->custom_field_1_label && $activeOrder->custom_field_1_value)
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

            @if ($activeOrder->custom_field_2_label && $activeOrder->custom_field_2_value)
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

        @if ($myResponse)
            @php
                $currentResponseClass = match ($myResponse->response ?? null) {
                    'yes' => 'yes',
                    'maybe' => 'maybe',
                    'no' => 'no',
                    default => '',
                };

                $currentResponseText = match ($myResponse->response ?? null) {
                    'yes' => __('order.yes'),
                    'maybe' => __('order.possibly'),
                    'no' => __('order.no'),
                    default => __('order.no_response_yet'),
                };
            @endphp

            <div class="current-response">
                <div class="left">
                    <div class="title">{{ __('order.your_current_response') }}</div>
                    <div class="time">
                        {{ $myResponse->responded_at?->format('d.m.Y H:i') }}
                    </div>
                </div>

                <div class="right">
                    <span class="state-pill {{ $currentResponseClass }}">
                        @if ($myResponse->response === 'yes')
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
            <div class="response-title-inline">
                <i class="fa-regular fa-hand-pointer"></i>
                <span>{{ __('order.please_select_your_response') }}</span>
            </div>

            @error('response')
                <div class="text-danger small mb-3">{{ $message }}</div>
            @enderror

            <form method="POST" action="{{ route('employee.orders.response.store', $activeOrder) }}">
                @csrf

                <div class="response-grid">
                    <button type="submit" name="response" value="yes"
                        class="response-btn yes {{ $myResponse?->response === 'yes' ? 'active' : '' }}">
                        <div class="circle">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="label">{{ __('order.yes') }}</div>
                    </button>

                    <button type="submit" name="response" value="maybe"
                        class="response-btn maybe {{ $myResponse?->response === 'maybe' ? 'active' : '' }}">
                        <div class="circle">
                            <i class="fa-solid fa-question"></i>
                        </div>
                        <div class="label">{{ __('order.possibly') }}</div>
                    </button>

                    <button type="submit" name="response" value="no"
                        class="response-btn no {{ $myResponse?->response === 'no' ? 'active' : '' }}">
                        <div class="circle">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class="label">{{ __('order.no') }}</div>
                    </button>
                </div>
            </form>
        </section>
    @else
        <section class="card-soft empty-state">
            <div class="empty-icon">
                <i class="fa-regular fa-folder-open"></i>
            </div>
            <h3 class="fw-bold mb-2">{{ __('order.no_active_order_available') }}</h3>
            <p class="text-muted mb-0">{{ __('order.please_check_back_later') }}</p>
        </section>
    @endif
@endsection