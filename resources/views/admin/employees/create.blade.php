@extends('layouts.admin')

@php
    $pageTitle = __('admin.create_employee_heading');
    $pageHeading = __('admin.create_employee_heading');
    $pageSubheading = __('admin.create_employee_subheading');
@endphp

@section('content')
    <div class="employee-form-shell">
        <div class="employee-form-card card-soft">
            <div class="employee-form-header">
                <div class="employee-form-header-icon">
                    <i class="bi bi-person-plus"></i>
                </div>

                <div>
                    <h3 class="employee-form-title">{{ __('admin.create_employee_heading') }}</h3>
                    <p class="employee-form-subtitle">{{ __('admin.create_employee_subheading') }}</p>
                </div>
            </div>

            <div class="employee-form-divider"></div>

            <div class="panel-body">
                <form method="POST" action="{{ route('admin.employees.store') }}">
                    @csrf

                    @include('admin.employees._form', ['showStatusField' => false])

                    <div class="employee-form-actions">
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-soft-dark">
                            <i class="bi bi-arrow-left me-1"></i>
                            {{ __('admin.back') }}
                        </a>

                        <button type="submit" class="btn btn-soft-primary btn-create-employee">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ __('admin.create_employee') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .employee-form-shell {
        max-width: 100%;
        margin: 0 auto;
    }

    .employee-form-card {
        overflow: hidden;
    }

    .employee-form-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 28px 28px 0;
    }

    .employee-form-header-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, #eef6ff 0%, #e4f0ff 100%);
        color: #2f80ed;
        font-size: 1.4rem;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
        flex-shrink: 0;
    }

    .employee-form-title {
        font-size: 1.2rem;
        font-weight: 800;
        margin: 0;
        color: #163253;
    }

    .employee-form-subtitle {
        margin: 4px 0 0;
        color: #6b7a90;
    }

    .employee-form-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, #e9eff6 10%, #e9eff6 90%, transparent 100%);
        margin: 22px 0 0;
    }

    .employee-form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 28px;
        flex-wrap: wrap;
    }

    .btn-soft-secondary {
        background: #fff;
        color: #163253;
        border: 1px solid #dbe5f0;
        border-radius: 999px;
        padding: 10px 18px;
        font-weight: 700;
    }

    .btn-soft-secondary:hover {
        background: #f8fbff;
        color: #163253;
        border-color: #c9d8e8;
    }

    .btn-create-employee {
        min-width: 180px;
    }

    @media (max-width: 767.98px) {
        .employee-form-header {
            padding: 22px 18px 0;
            align-items: flex-start;
        }

        .employee-form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .btn-soft-secondary,
        .btn-create-employee {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush