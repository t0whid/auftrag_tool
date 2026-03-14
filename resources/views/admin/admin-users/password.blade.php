@extends('layouts.admin')

@php
    $pageTitle = __('admin.change_password');
    $pageHeading = __('admin.change_password');
    $pageSubheading = $admin->name;
@endphp

@section('content')
    <div class="card-soft order-page-card">
        <div class="order-page-header">
            <div class="order-page-header-left">
                <div class="order-page-header-icon">
                    <i class="bi bi-key-fill"></i>
                </div>
                <div>
                    <h3 class="order-page-title">{{ __('admin.change_password') }}</h3>
                    <p class="order-page-subtitle">{{ $admin->name }}</p>
                </div>
            </div>
        </div>

        <div class="order-page-divider"></div>

        <div class="panel-body">
            <form method="POST" action="{{ route('admin.admin-users.password.update', $admin) }}">
                @csrf
                @method('PUT')

                <div class="admin-user-form-shell">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="premium-form-card">
                                <div class="premium-form-head">
                                    <div class="premium-form-icon">
                                        <i class="bi bi-shield-lock-fill"></i>
                                    </div>
                                    <div>
                                        <h3 class="premium-form-title">{{ __('admin.change_password') }}</h3>
                                        <p class="premium-form-subtitle">{{ $admin->name }}</p>
                                    </div>
                                </div>

                                <div class="row g-4 mt-1">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">{{ __('admin.new_password') }}</label>
                                        <input type="password"
                                               name="password"
                                               class="form-control premium-input @error('password') is-invalid @enderror"
                                               required>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">{{ __('admin.confirm_password') }}</label>
                                        <input type="password"
                                               name="password_confirmation"
                                               class="form-control premium-input"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-form-actions">
                    <a href="{{ route('admin.admin-users.index') }}" class="btn btn-soft-dark order-action-btn">
                        <i class="bi bi-arrow-left me-1"></i>
                        {{ __('order.back') }}
                    </a>

                    <button type="submit" class="btn btn-soft-warning order-action-btn">
                        <i class="bi bi-key me-1"></i>
                        {{ __('admin.change_password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@once
    @push('styles')
        <style>
            .order-page-card {
                overflow: hidden;
            }

            .order-page-header {
                padding: 26px 26px 0;
            }

            .order-page-header-left {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .order-page-header-icon {
                width: 58px;
                height: 58px;
                border-radius: 18px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(180deg, #eef6ff 0%, #e2efff 100%);
                color: #2f80ed;
                font-size: 1.35rem;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
                flex-shrink: 0;
            }

            .order-page-title {
                margin: 0;
                font-size: 1.2rem;
                font-weight: 800;
                color: #163253;
            }

            .order-page-subtitle {
                margin: 4px 0 0;
                color: #6b7a90;
            }

            .order-page-divider {
                height: 1px;
                background: linear-gradient(90deg, transparent 0%, #e9eff6 10%, #e9eff6 90%, transparent 100%);
                margin: 22px 0 0;
            }

            .order-form-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 12px;
                margin-top: 28px;
                flex-wrap: wrap;
            }

            .order-action-btn {
                min-width: 180px;
            }

            .admin-user-form-shell {
                width: 100%;
            }

            .premium-form-card {
                padding: 24px;
                border-radius: 24px;
                background:
                    radial-gradient(circle at top right, rgba(47, 128, 237, 0.05), transparent 26%),
                    linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
                border: 1px solid #e6edf5;
                box-shadow: 0 10px 26px rgba(15, 23, 42, 0.05);
                height: 100%;
            }

            .premium-form-head {
                display: flex;
                align-items: flex-start;
                gap: 14px;
                margin-bottom: 18px;
            }

            .premium-form-icon {
                width: 50px;
                height: 50px;
                border-radius: 16px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(180deg, #eef6ff 0%, #e2efff 100%);
                color: #2f80ed;
                font-size: 1.15rem;
                flex-shrink: 0;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.85);
            }

            .premium-form-title {
                margin: 0;
                font-size: 1.1rem;
                font-weight: 800;
                color: #163253;
            }

            .premium-form-subtitle {
                margin: 4px 0 0;
                color: #6b7a90;
                font-size: .92rem;
            }

            .premium-input {
                min-height: 52px;
                border-radius: 16px !important;
                border: 1px solid #dbe5f0 !important;
                background: #fff !important;
                box-shadow: none !important;
                font-weight: 500;
            }

            .premium-input:focus {
                border-color: #8bbaf7 !important;
                box-shadow: 0 0 0 .18rem rgba(47, 128, 237, .10) !important;
            }

            @media (max-width: 767.98px) {
                .order-page-header {
                    padding: 20px 18px 0;
                }

                .premium-form-card {
                    padding: 18px;
                }

                .order-form-actions {
                    flex-direction: column-reverse;
                    align-items: stretch;
                }

                .order-action-btn {
                    width: 100%;
                }
            }
        </style>
    @endpush
@endonce