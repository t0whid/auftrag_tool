<div class="row g-4">
    <div class="col-lg-6">
        <div class="form-section-card">
            <div class="form-section-title">
                <i class="bi bi-card-text me-2"></i>
                {{ __('order.title') }} / {{ __('order.description') }}
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.title') }}</label>
                <input type="text" name="title"
                       value="{{ old('title', $order->title ?? '') }}"
                       class="form-control @error('title') is-invalid @enderror" required>
                @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.description') }}</label>
                <textarea name="description" rows="6"
                          class="form-control @error('description') is-invalid @enderror"
                          required>{{ old('description', $order->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.location') }}</label>
                <input type="text" name="location"
                       value="{{ old('location', $order->location ?? '') }}"
                       class="form-control @error('location') is-invalid @enderror">
                @error('location')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.team_info') }}</label>
                <input type="text" name="team_info"
                       value="{{ old('team_info', $order->team_info ?? '') }}"
                       class="form-control @error('team_info') is-invalid @enderror">
                @error('team_info')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-section-card">
            <div class="form-section-title">
                <i class="bi bi-calendar-event me-2"></i>
                {{ __('order.start_date') }} / {{ __('order.end_date') }}
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.start_date') }}</label>
                <input type="date" name="start_date"
                       value="{{ old('start_date', isset($order) && $order->start_date ? $order->start_date->format('Y-m-d') : '') }}"
                       class="form-control @error('start_date') is-invalid @enderror" required>
                @error('start_date')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.end_date') }}</label>
                <input type="date" name="end_date"
                       value="{{ old('end_date', isset($order) && $order->end_date ? $order->end_date->format('Y-m-d') : '') }}"
                       class="form-control @error('end_date') is-invalid @enderror" required>
                @error('end_date')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3 form-check">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                    {{ old('is_active', $order->is_active ?? false) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="is_active">
                    {{ __('order.is_active') }}
                </label>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-section-card">
            <div class="form-section-title">
                <i class="bi bi-cash-stack me-2"></i>
                Cost Fields
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.hourly_rate') }}</label>
                <input type="number" step="0.01" min="0" name="hourly_rate"
                       value="{{ old('hourly_rate', $order->hourly_rate ?? '') }}"
                       class="form-control @error('hourly_rate') is-invalid @enderror">
                @error('hourly_rate')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.travel_cost') }}</label>
                <input type="number" step="0.01" min="0" name="travel_cost"
                       value="{{ old('travel_cost', $order->travel_cost ?? '') }}"
                       class="form-control @error('travel_cost') is-invalid @enderror">
                @error('travel_cost')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.travel_cost_unit') }}</label>
                <input type="text" name="travel_cost_unit"
                       value="{{ old('travel_cost_unit', $order->travel_cost_unit ?? 'km') }}"
                       class="form-control @error('travel_cost_unit') is-invalid @enderror">
                @error('travel_cost_unit')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.meal_allowance') }}</label>
                <input type="number" step="0.01" min="0" name="meal_allowance"
                       value="{{ old('meal_allowance', $order->meal_allowance ?? '') }}"
                       class="form-control @error('meal_allowance') is-invalid @enderror">
                @error('meal_allowance')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-section-card">
            <div class="form-section-title">
                <i class="bi bi-input-cursor-text me-2"></i>
                Custom Fields
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.custom_field_1_label') }}</label>
                <input type="text" name="custom_field_1_label"
                       value="{{ old('custom_field_1_label', $order->custom_field_1_label ?? '') }}"
                       class="form-control @error('custom_field_1_label') is-invalid @enderror">
                @error('custom_field_1_label')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.custom_field_1_value') }}</label>
                <input type="text" name="custom_field_1_value"
                       value="{{ old('custom_field_1_value', $order->custom_field_1_value ?? '') }}"
                       class="form-control @error('custom_field_1_value') is-invalid @enderror">
                @error('custom_field_1_value')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.custom_field_2_label') }}</label>
                <input type="text" name="custom_field_2_label"
                       value="{{ old('custom_field_2_label', $order->custom_field_2_label ?? '') }}"
                       class="form-control @error('custom_field_2_label') is-invalid @enderror">
                @error('custom_field_2_label')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-semibold">{{ __('order.custom_field_2_value') }}</label>
                <input type="text" name="custom_field_2_value"
                       value="{{ old('custom_field_2_value', $order->custom_field_2_value ?? '') }}"
                       class="form-control @error('custom_field_2_value') is-invalid @enderror">
                @error('custom_field_2_value')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>