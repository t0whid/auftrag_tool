@extends('layouts.employee')

@section('content')
    <div class="page-body">
        <div class="employee-order-detail-page">
            <div class="employee-order-back-wrap">
                <a href="{{ route('employee.dashboard') }}" class="employee-back-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>{{ __('order.back_to_orders') }}</span>
                </a>
            </div>

            <h1 class="page-heading">{{ __('order.new_order') }}</h1>

            <section class="card-soft order-hero">
                <h2 class="order-title">{{ $order->title }}</h2>

                <div class="order-lines">
                    @if ($order->location)
                        <div>
                            <strong>{{ __('order.location') }}:</strong> {{ $order->location }}
                        </div>
                    @endif

                    <div>
                        <strong>{{ __('order.date') }}:</strong>
                        {{ $order->start_date?->format('d.m.Y') }}
                        @if ($order->end_date)
                            – {{ $order->end_date->format('d.m.Y') }}
                        @endif
                    </div>

                    @if ($order->team_info)
                        <div>
                            <strong>{{ __('order.team_info') }}:</strong> {{ $order->team_info }}
                        </div>
                    @endif

                    @if ($order->description)
                        <div>
                            <strong>{{ __('order.description') }}:</strong>
                            {!! nl2br(e($order->description)) !!}
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
                            {{ $order->start_date?->format('d.m.Y') }}
                            @if ($order->end_date)
                                – {{ $order->end_date->format('d.m.Y') }}
                            @endif
                        </div>
                    </div>
                </div>

                @if ($order->hourly_rate !== null)
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">{{ __('order.hourly_rate') }}</div>
                            <div class="info-value">
                                {{ number_format($order->hourly_rate, 2) }} €
                                <small>/ {{ __('order.hour') }}</small>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($order->travel_cost !== null)
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-road"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">{{ __('order.travel_cost') }}</div>
                            <div class="info-value">
                                {{ number_format($order->travel_cost, 2) }} €
                                @if ($order->travel_cost_unit)
                                    <small>/ {{ $order->travel_cost_unit }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if ($order->meal_allowance !== null)
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">{{ __('order.meal_allowance') }}</div>
                            <div class="info-value">{{ number_format($order->meal_allowance, 2) }} €</div>
                        </div>
                    </div>
                @endif

                @if ($order->custom_field_1_label && $order->custom_field_1_value)
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">{{ $order->custom_field_1_label }}</div>
                            <div class="info-value">{{ $order->custom_field_1_value }}</div>
                        </div>
                    </div>
                @endif

                @if ($order->custom_field_2_label && $order->custom_field_2_value)
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">{{ $order->custom_field_2_label }}</div>
                            <div class="info-value">{{ $order->custom_field_2_value }}</div>
                        </div>
                    </div>
                @endif
            </section>

            @if ($order->attachments->count())
                <section class="card-soft response-panel attachment-panel">
                    <div class="response-title-inline">
                        <i class="fa-solid fa-paperclip"></i>
                        <span>{{ __('order.attachments') }}</span>
                    </div>

                    <div class="employee-attachments-grid mt-3">
                        @foreach ($order->attachments as $attachment)
                            @php
                                $ext = strtolower(pathinfo($attachment->file_name, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                $isPdf = $ext === 'pdf';
                            @endphp

                            <a href="{{ route('employee.orders.attachments.view', [$order, $attachment]) }}" target="_blank" class="employee-attachment-card">
                                <div class="employee-attachment-icon {{ $isPdf ? 'pdf' : 'image' }}">
                                    @if ($isImage)
                                        <i class="fa-regular fa-image"></i>
                                    @elseif($isPdf)
                                        <i class="fa-regular fa-file-pdf"></i>
                                    @else
                                        <i class="fa-regular fa-file"></i>
                                    @endif
                                </div>

                                <div class="employee-attachment-content">
                                    <div class="employee-attachment-name">{{ $attachment->file_name }}</div>
                                    <div class="employee-attachment-meta">
                                        {{ strtoupper($ext) ?: __('order.file') }}
                                        @if (!empty($attachment->file_size))
                                            · {{ number_format($attachment->file_size / 1024, 1) }} KB
                                        @endif
                                    </div>
                                </div>

                                <div class="employee-attachment-open">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

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

                <form method="POST" action="{{ route('employee.orders.response.store', $order) }}">
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
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .attachment-panel {
            margin-top: 18px;
        }

        .employee-attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 14px;
        }

        .employee-attachment-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px;
            border-radius: 16px;
            background: #f8fbff;
            border: 1px solid #e7eef6;
            text-decoration: none;
            transition: all .18s ease;
        }

        .employee-attachment-card:hover {
            background: #f2f8ff;
            border-color: #d6e4f3;
            transform: translateY(-1px);
        }

        .employee-attachment-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1rem;
            background: #eaf3ff;
            color: #2f80ed;
        }

        .employee-attachment-icon.pdf {
            background: #fff1f1;
            color: #dc2626;
        }

        .employee-attachment-content {
            min-width: 0;
            flex: 1;
        }

        .employee-attachment-name {
            font-weight: 700;
            color: #163253;
            word-break: break-word;
            line-height: 1.4;
        }

        .employee-attachment-meta {
            margin-top: 4px;
            font-size: .84rem;
            color: #6b7a90;
        }

        .employee-attachment-open {
            color: #7e95b2;
            flex-shrink: 0;
        }
    </style>
@endpush