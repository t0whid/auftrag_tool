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

    <div class="card-soft order-placeholder">
        <div class="placeholder-icon">
            <i class="bi bi-clipboard2-check"></i>
        </div>

        <div class="placeholder-title">{{ __('employee.current_order_title') }}</div>
        <div class="placeholder-text">{{ __('employee.current_order_text') }}</div>

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

        <div class="employee-footer-actions">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-soft-light w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    {{ __('auth.logout') }}
                </button>
            </form>
        </div>
    </div>
@endsection