<div class="order-form-shell">
    <div class="row g-4">

        {{-- BASIC INFORMATION --}}
        <div class="col-12">
            <div class="premium-form-card">
                <div class="premium-form-head">
                    <div class="premium-form-icon">
                        <i class="bi bi-card-text"></i>
                    </div>
                    <div>
                        <h3 class="premium-form-title">{{ __('order.basic_information') }}</h3>
                        <p class="premium-form-subtitle">{{ __('order.basic_information_subtitle') }}</p>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">{{ __('order.title') }}</label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $order->title ?? '') }}"
                               class="form-control premium-input @error('title') is-invalid @enderror"
                               required>
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">{{ __('order.location') }}</label>
                        <input type="text"
                               name="location"
                               value="{{ old('location', $order->location ?? '') }}"
                               class="form-control premium-input @error('location') is-invalid @enderror">
                        @error('location')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">{{ __('order.team_info') }}</label>
                        <input type="text"
                               name="team_info"
                               value="{{ old('team_info', $order->team_info ?? '') }}"
                               class="form-control premium-input @error('team_info') is-invalid @enderror">
                        @error('team_info')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">{{ __('order.start_date') }}</label>
                        <input type="date"
                               name="start_date"
                               value="{{ old('start_date', isset($order) && $order->start_date ? $order->start_date->format('Y-m-d') : '') }}"
                               class="form-control premium-input @error('start_date') is-invalid @enderror"
                               required>
                        @error('start_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">{{ __('order.end_date') }}</label>
                        <input type="date"
                               name="end_date"
                               value="{{ old('end_date', isset($order) && $order->end_date ? $order->end_date->format('Y-m-d') : '') }}"
                               class="form-control premium-input @error('end_date') is-invalid @enderror"
                               required>
                        @error('end_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">{{ __('order.description') }}</label>
                        <textarea name="description"
                                  rows="6"
                                  class="form-control premium-input premium-textarea @error('description') is-invalid @enderror"
                                  required>{{ old('description', $order->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- COST FIELDS --}}
        <div class="col-xl-6">
            <div class="premium-form-card h-100">
                <div class="premium-form-head">
                    <div class="premium-form-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <h3 class="premium-form-title">{{ __('order.cost_fields') }}</h3>
                        <p class="premium-form-subtitle">{{ __('order.cost_fields_subtitle') }}</p>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.hourly_rate') }}</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               name="hourly_rate"
                               value="{{ old('hourly_rate', $order->hourly_rate ?? '') }}"
                               class="form-control premium-input @error('hourly_rate') is-invalid @enderror">
                        @error('hourly_rate')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.travel_cost') }}</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               name="travel_cost"
                               value="{{ old('travel_cost', $order->travel_cost ?? '') }}"
                               class="form-control premium-input @error('travel_cost') is-invalid @enderror">
                        @error('travel_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.travel_cost_unit') }}</label>
                        <input type="text"
                               name="travel_cost_unit"
                               value="{{ old('travel_cost_unit', $order->travel_cost_unit ?? 'km') }}"
                               class="form-control premium-input @error('travel_cost_unit') is-invalid @enderror">
                        @error('travel_cost_unit')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.meal_allowance') }}</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               name="meal_allowance"
                               value="{{ old('meal_allowance', $order->meal_allowance ?? '') }}"
                               class="form-control premium-input @error('meal_allowance') is-invalid @enderror">
                        @error('meal_allowance')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- CUSTOM FIELDS + ACTIVE --}}
        <div class="col-xl-6">
            <div class="premium-form-card h-100">
                <div class="premium-form-head">
                    <div class="premium-form-icon">
                        <i class="bi bi-input-cursor-text"></i>
                    </div>
                    <div>
                        <h3 class="premium-form-title">{{ __('order.custom_fields') }}</h3>
                        <p class="premium-form-subtitle">{{ __('order.custom_fields_subtitle') }}</p>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.custom_field_1_label') }}</label>
                        <input type="text"
                               name="custom_field_1_label"
                               value="{{ old('custom_field_1_label', $order->custom_field_1_label ?? '') }}"
                               class="form-control premium-input @error('custom_field_1_label') is-invalid @enderror">
                        @error('custom_field_1_label')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.custom_field_1_value') }}</label>
                        <input type="text"
                               name="custom_field_1_value"
                               value="{{ old('custom_field_1_value', $order->custom_field_1_value ?? '') }}"
                               class="form-control premium-input @error('custom_field_1_value') is-invalid @enderror">
                        @error('custom_field_1_value')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.custom_field_2_label') }}</label>
                        <input type="text"
                               name="custom_field_2_label"
                               value="{{ old('custom_field_2_label', $order->custom_field_2_label ?? '') }}"
                               class="form-control premium-input @error('custom_field_2_label') is-invalid @enderror">
                        @error('custom_field_2_label')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.custom_field_2_value') }}</label>
                        <input type="text"
                               name="custom_field_2_value"
                               value="{{ old('custom_field_2_value', $order->custom_field_2_value ?? '') }}"
                               class="form-control premium-input @error('custom_field_2_value') is-invalid @enderror">
                        @error('custom_field_2_value')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="active-order-box">
                            <div class="active-order-left">
                                <div class="active-order-check-icon">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                </div>
                                <div>
                                    <div class="active-order-title">{{ __('order.is_active') }}</div>
                                    <div class="active-order-text">{{ __('order.only_one_active') }}</div>
                                </div>
                            </div>

                            <div class="active-order-right">
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-check form-switch active-order-switch">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           role="switch"
                                           id="is_active"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $order->is_active ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold ms-2" for="is_active">
                                        {{ __('order.active') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('is_active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@once
    @push('styles')
    <style>
        .order-form-shell {
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
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.85);
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
            box-shadow: 0 0 0 .18rem rgba(47,128,237,.10) !important;
        }

        .premium-textarea {
            min-height: 150px;
            resize: vertical;
            padding-top: 14px;
        }

        .active-order-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 18px;
            border-radius: 20px;
            background: linear-gradient(180deg, #f8fbff 0%, #f3f8fe 100%);
            border: 1px solid #e7eef6;
            margin-top: 4px;
            flex-wrap: wrap;
        }

        .active-order-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .active-order-check-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eaf3ff;
            color: #2f80ed;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .active-order-title {
            font-weight: 800;
            color: #163253;
            margin-bottom: 2px;
        }

        .active-order-text {
            color: #6b7a90;
            font-size: .9rem;
        }

        .active-order-switch .form-check-input {
            width: 3rem;
            height: 1.6rem;
            cursor: pointer;
        }

        .active-order-switch .form-check-input:checked {
            background-color: #2f80ed;
            border-color: #2f80ed;
        }

        @media (max-width: 767.98px) {
            .premium-form-card {
                padding: 18px;
            }

            .active-order-box {
                align-items: flex-start;
            }

            .active-order-right {
                width: 100%;
            }
        }
    </style>
    @endpush
@endonce