@extends('layouts.admin')

@php
    $pageTitle = __('admin.edit_admin');
    $pageHeading = __('admin.edit_admin');
    $pageSubheading = $admin->name;
@endphp

@section('content')
    <div class="card-soft order-page-card">
        <div class="order-page-header">
            <div class="order-page-header-left">
                <div class="order-page-header-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <h3 class="order-page-title">{{ __('admin.edit_admin') }}</h3>
                    <p class="order-page-subtitle">{{ $admin->name }}</p>
                </div>
            </div>
        </div>

        <div class="order-page-divider"></div>

        <div class="panel-body">
            <form method="POST" action="{{ route('admin.admin-users.update', $admin) }}">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('admin.name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                            class="form-control @error('name') is-invalid @enderror" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('admin.username') }}</label>
                        <input type="text" name="username" value="{{ old('username', $admin->username) }}"
                            class="form-control @error('username') is-invalid @enderror" required>
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('admin.email') }}</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                            class="form-control @error('email') is-invalid @enderror" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('admin.status') }}</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $admin->status ? '1' : '0') == '1' ? 'selected' : '' }}>
                                {{ __('admin.active') }}
                            </option>
                            <option value="0" {{ old('status', $admin->status ? '1' : '0') == '0' ? 'selected' : '' }}>
                                {{ __('admin.inactive') }}
                            </option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="order-form-actions">
                    <a href="{{ route('admin.admin-users.index') }}" class="btn btn-soft-light order-action-btn">
                        <i class="bi bi-arrow-left me-1"></i>
                        {{ __('order.back') }}
                    </a>

                    <button type="submit" class="btn btn-soft-primary order-action-btn">
                        <i class="bi bi-save me-1"></i>
                        {{ __('order.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection