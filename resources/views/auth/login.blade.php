@extends('layouts.app')

@section('content')
    <div class="mb-4 text-center">
        <h1 class="section-title mb-2">{{ __('auth.login_title') }}</h1>
        <p class="muted mb-0">{{ __('auth.login_subtitle') }}</p>
    </div>

    <div class="card-soft p-4">
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">{{ __('auth.username') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-person"></i>
                    </span>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-control @error('username') is-invalid @enderror"
                        required
                        autofocus
                    >
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">{{ __('auth.password') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    {{ __('auth.remember') }}
                </label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-soft-primary">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    {{ __('auth.login_button') }}
                </button>
            </div>
        </form>
    </div>
@endsection