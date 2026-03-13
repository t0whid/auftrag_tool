@extends('layouts.admin')

@php
    $pageTitle = __('admin.dashboard_heading');
    $pageHeading = __('admin.dashboard_heading');
    $pageSubheading = __('admin.dashboard_subheading');
@endphp

@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-soft stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-label">{{ __('admin.total_employees') }}</div>
                <div class="stat-value">{{ $employeeCount }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-soft stat-card">
                <div class="stat-icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="stat-label">{{ __('admin.active_employees') }}</div>
                <div class="stat-value">{{ $activeEmployeeCount }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-soft stat-card">
                <div class="stat-icon">
                    <i class="bi bi-person-x"></i>
                </div>
                <div class="stat-label">{{ __('admin.inactive_employees') }}</div>
                <div class="stat-value">{{ $inactiveEmployeeCount }}</div>
            </div>
        </div>
    </div>

    <div class="card-soft mt-4">
        <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="panel-title">{{ __('admin.employees_heading') }}</h3>
                <p class="panel-subtitle">{{ __('admin.employees_subheading') }}</p>
            </div>

            <a href="{{ route('admin.employees.index') }}" class="btn btn-soft-primary">
                <i class="bi bi-arrow-right-circle me-1"></i>
                {{ __('admin.nav_employees') }}
            </a>
        </div>
        <div class="panel-body pt-3">
            <p class="mb-0 text-secondary">
                {{ __('admin.dashboard_subheading') }}
            </p>
        </div>
    </div>
@endsection