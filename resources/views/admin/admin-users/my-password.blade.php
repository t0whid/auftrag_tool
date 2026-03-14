@extends('layouts.admin')

@php
    $pageTitle = __('admin.my_password');
    $pageHeading = __('admin.my_password');
    $pageSubheading = __('admin.change_your_password');
@endphp

@section('content')
    <div class="card-soft order-page-card">
        <div class="order-page-header">
            <div class="order-page-header-left">
                <div class="order-page-header-icon">
                    <i class="bi bi-key-fill"></i>
                </div>
                <div>
                    <h3 class="order-page-title">{{ __('admin.my_password') }}</h3>
                    <p class="order-page-subtitle">{{ __('admin.change_your_password') }}</p>
                </div>
            </div>
        </div>

        <div class="order-page-divider"></div>

        <div class="panel-body">
            <form method="POST" action="{{ route('admin.my-password.update') }}">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">{{ __('admin.current_password') }}</label>
                        <input type="password" name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">{{ __('admin.new_password') }}</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">{{ __('admin.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="order-form-actions">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-soft-light order-action-btn">
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