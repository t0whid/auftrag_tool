@php
    $showStatusField = $showStatusField ?? false;
@endphp

<div class="row g-4">
    <div class="col-lg-6">
        <div class="form-section-card">
            <div class="form-section-title">
                <i class="bi bi-person me-2"></i>
                {{ __('admin.personal_information') }}
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('admin.name') }}</label>
                <div class="input-icon-wrap">
                    <span class="input-icon"><i class="bi bi-person"></i></span>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $employee->name ?? '') }}"
                        class="form-control input-with-icon @error('name') is-invalid @enderror"
                        required
                    >
                </div>
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('admin.username') }}</label>
                <div class="input-icon-wrap">
                    <span class="input-icon"><i class="bi bi-person-badge"></i></span>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username', $employee->username ?? '') }}"
                        class="form-control input-with-icon @error('username') is-invalid @enderror"
                        required
                    >
                </div>
                @error('username')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('admin.email') }}</label>
                <div class="input-icon-wrap">
                    <span class="input-icon"><i class="bi bi-envelope"></i></span>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $employee->email ?? '') }}"
                        class="form-control input-with-icon @error('email') is-invalid @enderror"
                    >
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            @if($showStatusField)
                <div class="mt-3">
                    <label class="form-label fw-semibold">{{ __('admin.block') }}</label>
                    <div class="input-icon-wrap">
                        <span class="input-icon"><i class="bi bi-shield-lock"></i></span>
                        <select
                            name="status"
                            class="form-select input-with-icon @error('status') is-invalid @enderror"
                            required
                        >
                            <option value="1" {{ old('status', isset($employee) ? (int) $employee->status : 1) == 1 ? 'selected' : '' }}>
                                {{ __('admin.active') }}
                            </option>
                            <option value="0" {{ old('status', isset($employee) ? (int) $employee->status : 1) == 0 ? 'selected' : '' }}>
                                {{ __('admin.inactive') }}
                            </option>
                        </select>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-section-card">
            <div class="form-section-title">
                <i class="bi bi-key me-2"></i>
                {{ __('admin.security_information') }}
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">
                    {{ __('admin.password') }}
                    @isset($employee)
                        <span class="text-secondary small">({{ __('admin.leave_blank_password') }})</span>
                    @endisset
                </label>

                <div class="input-icon-wrap">
                    <span class="input-icon"><i class="bi bi-lock"></i></span>
                    <input
                        type="password"
                        name="password"
                        class="form-control input-with-icon @error('password') is-invalid @enderror"
                        @empty($employee) required @endempty
                    >
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('admin.confirm_password') }}</label>
                <div class="input-icon-wrap">
                    <span class="input-icon"><i class="bi bi-shield-check"></i></span>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control input-with-icon"
                        @empty($employee) required @endempty
                    >
                </div>
            </div>
        </div>
    </div>
</div>

@once
    @push('styles')
    <style>
        .form-section-card {
            height: 100%;
            padding: 22px;
            border: 1px solid #e6edf5;
            border-radius: 22px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
        }

        .form-section-title {
            display: flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 800;
            color: #163253;
            margin-bottom: 4px;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #7b8da4;
            font-size: 1rem;
            z-index: 2;
            pointer-events: none;
        }

        .input-with-icon {
            padding-left: 42px !important;
            min-height: 50px;
            border-radius: 16px !important;
            border: 1px solid #dbe5f0 !important;
            background: #fff !important;
        }

        .input-with-icon:focus {
            border-color: #8bbaf7 !important;
            box-shadow: 0 0 0 .18rem rgba(47,128,237,.10) !important;
        }

        select.input-with-icon {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image:
                linear-gradient(45deg, transparent 50%, #2f80ed 50%),
                linear-gradient(135deg, #2f80ed 50%, transparent 50%) !important;
            background-position:
                calc(100% - 20px) calc(50% - 3px),
                calc(100% - 14px) calc(50% - 3px) !important;
            background-size: 6px 6px, 6px 6px !important;
            background-repeat: no-repeat !important;
        }

        @media (max-width: 991.98px) {
            .form-section-card {
                padding: 18px;
            }
        }
    </style>
    @endpush
@endonce