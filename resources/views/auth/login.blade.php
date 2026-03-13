@extends('layouts.app')

@section('content')
    <div class="auth-hero">
        <div class="auth-hero-icon">
            <i class="bi bi-shield-lock"></i>
        </div>

        <h1 class="section-title mb-2">{{ __('auth.login_title') }}</h1>
        <p class="muted mb-0">{{ __('auth.login_subtitle') }}</p>
    </div>

    <div class="card-soft auth-form-card">
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">{{ __('auth.username') }}</label>
                <div class="input-group input-soft">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-control @error('username') is-invalid @enderror"
                        placeholder="{{ __('auth.username') }}"
                        required
                        autofocus
                    >
                </div>

                @error('username')
                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">{{ __('auth.password') }}</label>
                <div class="input-group input-soft">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('auth.password') }}"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        id="togglePassword"
                        aria-label="Toggle password visibility"
                    >
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>

                @error('password')
                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-soft-primary">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    {{ __('auth.login_button') }}
                </button>
            </div>
        </form>

        <div class="auth-footer-note">
            Secure admin access
        </div>
    </div>

    @push('scripts')
    <script>
        (function () {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePassword');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (passwordInput && toggleBtn && toggleIcon) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleIcon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
                });
            }
        })();
    </script>
    @endpush
@endsection