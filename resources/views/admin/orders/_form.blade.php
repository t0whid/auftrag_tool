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
                        <input type="text" name="title" value="{{ old('title', $order->title ?? '') }}"
                            class="form-control premium-input @error('title') is-invalid @enderror" required>
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">{{ __('order.location') }}</label>
                        <input type="text" name="location" value="{{ old('location', $order->location ?? '') }}"
                            class="form-control premium-input @error('location') is-invalid @enderror">
                        @error('location')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">{{ __('order.team_info') }}</label>
                        <input type="text" name="team_info" value="{{ old('team_info', $order->team_info ?? '') }}"
                            class="form-control premium-input @error('team_info') is-invalid @enderror">
                        @error('team_info')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">{{ __('order.start_date') }}</label>
                        <input type="date" name="start_date"
                            value="{{ old('start_date', isset($order) && $order->start_date ? $order->start_date->format('Y-m-d') : '') }}"
                            class="form-control premium-input @error('start_date') is-invalid @enderror" required>
                        @error('start_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">{{ __('order.end_date') }}</label>
                        <input type="date" name="end_date"
                            value="{{ old('end_date', isset($order) && $order->end_date ? $order->end_date->format('Y-m-d') : '') }}"
                            class="form-control premium-input @error('end_date') is-invalid @enderror" required>
                        @error('end_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">{{ __('order.description') }}</label>
                        <textarea name="description" rows="6"
                            class="form-control premium-input premium-textarea @error('description') is-invalid @enderror" required>{{ old('description', $order->description ?? '') }}</textarea>
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
                        <input type="number" step="0.01" min="0" name="hourly_rate"
                            value="{{ old('hourly_rate', $order->hourly_rate ?? '') }}"
                            class="form-control premium-input @error('hourly_rate') is-invalid @enderror">
                        @error('hourly_rate')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.travel_cost') }}</label>
                        <input type="number" step="0.01" min="0" name="travel_cost"
                            value="{{ old('travel_cost', $order->travel_cost ?? '') }}"
                            class="form-control premium-input @error('travel_cost') is-invalid @enderror">
                        @error('travel_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.travel_cost_unit') }}</label>
                        <input type="text" name="travel_cost_unit"
                            value="{{ old('travel_cost_unit', $order->travel_cost_unit ?? 'km') }}"
                            class="form-control premium-input @error('travel_cost_unit') is-invalid @enderror">
                        @error('travel_cost_unit')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.meal_allowance') }}</label>
                        <input type="number" step="0.01" min="0" name="meal_allowance"
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
                        <input type="text" name="custom_field_1_label"
                            value="{{ old('custom_field_1_label', $order->custom_field_1_label ?? '') }}"
                            class="form-control premium-input @error('custom_field_1_label') is-invalid @enderror">
                        @error('custom_field_1_label')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.custom_field_1_value') }}</label>
                        <input type="text" name="custom_field_1_value"
                            value="{{ old('custom_field_1_value', $order->custom_field_1_value ?? '') }}"
                            class="form-control premium-input @error('custom_field_1_value') is-invalid @enderror">
                        @error('custom_field_1_value')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.custom_field_2_label') }}</label>
                        <input type="text" name="custom_field_2_label"
                            value="{{ old('custom_field_2_label', $order->custom_field_2_label ?? '') }}"
                            class="form-control premium-input @error('custom_field_2_label') is-invalid @enderror">
                        @error('custom_field_2_label')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">{{ __('order.custom_field_2_value') }}</label>
                        <input type="text" name="custom_field_2_value"
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
                                    <div class="active-order-text">{{ __('order.mark_order_as_active') }}</div>
                                </div>
                            </div>

                            <div class="active-order-right">
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-check form-switch active-order-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                        name="is_active" value="1"
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

        {{-- ATTACHMENTS --}}
        <div class="col-12">
            <div class="premium-form-card">
                <div class="premium-form-head">
                    <div class="premium-form-icon">
                        <i class="bi bi-paperclip"></i>
                    </div>
                    <div>
                        <h3 class="premium-form-title">Attachments</h3>
                        <p class="premium-form-subtitle">Upload multiple images or PDF files. You can review and remove files before saving.</p>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Upload Files</label>

                        <div class="attachment-upload-box" id="attachmentUploadBox">
                            <div class="attachment-upload-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>

                            <div class="attachment-upload-content">
                                <div class="attachment-upload-title">Choose files</div>
                                <div class="attachment-upload-text">
                                    You can select one or many files at a time, and also add more later.
                                </div>
                                <div class="attachment-upload-meta">
                                    Allowed: JPG, JPEG, PNG, WEBP, PDF · Max 10MB each
                                </div>
                            </div>

                            <button type="button" class="btn btn-soft-primary attachment-upload-btn" id="attachmentBrowseBtn">
                                <i class="bi bi-plus-lg me-1"></i>
                                Browse Files
                            </button>
                        </div>

                        <input
                            type="file"
                            id="attachmentInput"
                            class="d-none"
                            accept=".jpg,.jpeg,.png,.webp,.pdf,image/*,application/pdf"
                            multiple
                        >

                        <input
                            type="file"
                            name="attachments[]"
                            id="attachmentInputMirror"
                            class="d-none @error('attachments') is-invalid @enderror @error('attachments.*') is-invalid @enderror"
                            multiple
                        >

                        @error('attachments')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror

                        @error('attachments.*')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="selected-files-wrap" id="selectedFilesWrap" style="display: none;">
                            <div class="selected-files-head">
                                <div class="selected-files-title">
                                    <i class="bi bi-folder2-open me-2"></i>
                                    Selected Files
                                </div>
                                <div class="selected-files-count" id="selectedFilesCount">0 files</div>
                            </div>

                            <div class="row g-3" id="selectedFilesList"></div>
                        </div>
                    </div>

                    @if (isset($order) && $order->attachments && $order->attachments->count())
                        <div class="col-12">
                            <div class="existing-attachments-wrap">
                                <div class="existing-attachments-title">Existing Attachments</div>

                                <div class="row g-3">
                                    @foreach ($order->attachments as $attachment)
                                        <div class="col-md-6 col-xl-4">
                                            <div class="existing-attachment-card-wrap">
                                                <a href="{{ asset($attachment->file_path) }}" target="_blank"
                                                    class="existing-attachment-card">
                                                    <div class="existing-attachment-icon">
                                                        @if ($attachment->is_image)
                                                            <i class="bi bi-image"></i>
                                                        @elseif($attachment->is_pdf)
                                                            <i class="bi bi-file-earmark-pdf"></i>
                                                        @else
                                                            <i class="bi bi-file-earmark"></i>
                                                        @endif
                                                    </div>

                                                    <div class="existing-attachment-content">
                                                        <div class="existing-attachment-name">{{ $attachment->file_name }}</div>
                                                        <div class="existing-attachment-meta">
                                                            {{ strtoupper(pathinfo($attachment->file_name, PATHINFO_EXTENSION)) }}
                                                            ·
                                                            {{ number_format(($attachment->file_size ?? 0) / 1024, 1) }} KB
                                                        </div>
                                                    </div>

                                                    <div class="existing-attachment-arrow">
                                                        <i class="bi bi-box-arrow-up-right"></i>
                                                    </div>
                                                </a>

                                                <button
                                                    type="button"
                                                    class="existing-attachment-delete-btn js-attachment-delete"
                                                    title="Remove file"
                                                    data-action="{{ route('admin.orders.attachments.destroy', [$order, $attachment]) }}">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
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

            .attachment-upload-box {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                padding: 20px;
                border-radius: 22px;
                border: 1.5px dashed #cfe0f4;
                background: linear-gradient(180deg, #f8fbff 0%, #f4f9ff 100%);
                transition: all .18s ease;
                flex-wrap: wrap;
                cursor: pointer;
            }

            .attachment-upload-box:hover {
                border-color: #9fc1ee;
                background: linear-gradient(180deg, #f4f9ff 0%, #eef6ff 100%);
            }

            .attachment-upload-icon {
                width: 54px;
                height: 54px;
                border-radius: 16px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #eaf3ff;
                color: #2f80ed;
                font-size: 1.2rem;
                flex-shrink: 0;
            }

            .attachment-upload-content {
                flex: 1;
                min-width: 220px;
            }

            .attachment-upload-title {
                font-weight: 800;
                color: #163253;
                margin-bottom: 4px;
            }

            .attachment-upload-text {
                color: #6b7a90;
                font-size: .92rem;
                line-height: 1.5;
            }

            .attachment-upload-meta {
                margin-top: 6px;
                color: #87a0bd;
                font-size: .82rem;
                font-weight: 600;
            }

            .attachment-upload-btn {
                min-width: 150px;
            }

            .selected-files-wrap {
                margin-top: 2px;
                padding: 18px;
                border-radius: 20px;
                background: #fbfdff;
                border: 1px solid #e6edf5;
            }

            .selected-files-head {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
                margin-bottom: 14px;
                flex-wrap: wrap;
            }

            .selected-files-title {
                font-weight: 800;
                color: #163253;
            }

            .selected-files-count {
                font-size: .88rem;
                font-weight: 700;
                color: #5c7391;
                background: #eef4fb;
                border: 1px solid #deebf8;
                border-radius: 999px;
                padding: 6px 12px;
            }

            .selected-file-card {
                position: relative;
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px;
                border-radius: 18px;
                background: #f8fbff;
                border: 1px solid #e7eef6;
                height: 100%;
            }

            .selected-file-icon {
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

            .selected-file-content {
                min-width: 0;
                flex: 1;
            }

            .selected-file-name {
                font-weight: 700;
                color: #163253;
                word-break: break-word;
                line-height: 1.4;
            }

            .selected-file-meta {
                margin-top: 4px;
                font-size: .84rem;
                color: #6b7a90;
            }

            .selected-file-remove {
                width: 34px;
                height: 34px;
                border: 0;
                border-radius: 12px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #fff1f1;
                color: #dc2626;
                transition: all .18s ease;
                flex-shrink: 0;
            }

            .selected-file-remove:hover {
                background: #ffe4e4;
                color: #b91c1c;
            }

            .existing-attachments-wrap {
                margin-top: 8px;
            }

            .existing-attachments-title {
                font-weight: 800;
                color: #163253;
                margin-bottom: 14px;
            }

            .existing-attachment-card-wrap {
                position: relative;
                height: 100%;
            }

            .existing-attachment-card {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 14px 16px;
                padding-right: 52px;
                border-radius: 18px;
                background: #f8fbff;
                border: 1px solid #e7eef6;
                text-decoration: none;
                transition: all .18s ease;
                height: 100%;
            }

            .existing-attachment-card:hover {
                background: #f2f8ff;
                border-color: #d7e6f8;
                transform: translateY(-1px);
            }

            .existing-attachment-icon {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #eaf3ff;
                color: #2f80ed;
                font-size: 1.05rem;
                flex-shrink: 0;
            }

            .existing-attachment-content {
                min-width: 0;
                flex: 1;
            }

            .existing-attachment-name {
                font-weight: 700;
                color: #163253;
                word-break: break-word;
            }

            .existing-attachment-meta {
                margin-top: 4px;
                font-size: .85rem;
                color: #6b7a90;
            }

            .existing-attachment-arrow {
                color: #7e95b2;
                flex-shrink: 0;
            }

            .existing-attachment-delete-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 3;
                width: 32px;
                height: 32px;
                border: 0;
                border-radius: 10px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #fff1f1;
                color: #dc2626;
                transition: all .18s ease;
                box-shadow: 0 4px 12px rgba(220, 38, 38, 0.10);
            }

            .existing-attachment-delete-btn:hover {
                background: #ffe4e4;
                color: #b91c1c;
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

                .attachment-upload-box {
                    align-items: flex-start;
                }

                .attachment-upload-btn {
                    width: 100%;
                }
            }
        </style>
    @endpush
@endonce

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const browseBtn = document.getElementById('attachmentBrowseBtn');
                const fileInput = document.getElementById('attachmentInput');
                const mirrorInput = document.getElementById('attachmentInputMirror');
                const selectedFilesWrap = document.getElementById('selectedFilesWrap');
                const selectedFilesList = document.getElementById('selectedFilesList');
                const selectedFilesCount = document.getElementById('selectedFilesCount');
                const uploadBox = document.getElementById('attachmentUploadBox');
                const hiddenDeleteForm = document.getElementById('attachmentDeleteHiddenForm');

                if (browseBtn && fileInput && mirrorInput && selectedFilesWrap && selectedFilesList && selectedFilesCount) {
                    let selectedFiles = [];

                    browseBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        fileInput.click();
                    });

                    uploadBox.addEventListener('click', function (e) {
                        if (e.target.closest('button')) return;
                        fileInput.click();
                    });

                    fileInput.addEventListener('change', function (event) {
                        const newFiles = Array.from(event.target.files || []);

                        if (!newFiles.length) {
                            return;
                        }

                        newFiles.forEach(file => {
                            const exists = selectedFiles.some(existing =>
                                existing.name === file.name &&
                                existing.size === file.size &&
                                existing.lastModified === file.lastModified
                            );

                            if (!exists) {
                                selectedFiles.push(file);
                            }
                        });

                        syncMirrorInput();
                        renderSelectedFiles();
                        fileInput.value = '';
                    });

                    function syncMirrorInput() {
                        const dt = new DataTransfer();

                        selectedFiles.forEach(file => dt.items.add(file));

                        mirrorInput.files = dt.files;
                    }

                    function renderSelectedFiles() {
                        selectedFilesList.innerHTML = '';

                        if (!selectedFiles.length) {
                            selectedFilesWrap.style.display = 'none';
                            selectedFilesCount.textContent = '0 files';
                            return;
                        }

                        selectedFilesWrap.style.display = '';
                        selectedFilesCount.textContent = selectedFiles.length + (selectedFiles.length === 1 ? ' file' : ' files');

                        selectedFiles.forEach((file, index) => {
                            const col = document.createElement('div');
                            col.className = 'col-md-6 col-xl-4';

                            const ext = getExtension(file.name);
                            const sizeText = formatFileSize(file.size);
                            const iconClass = getFileIcon(file);

                            col.innerHTML = `
                                <div class="selected-file-card">
                                    <div class="selected-file-icon">
                                        <i class="bi ${iconClass}"></i>
                                    </div>

                                    <div class="selected-file-content">
                                        <div class="selected-file-name">${escapeHtml(file.name)}</div>
                                        <div class="selected-file-meta">${(ext.toUpperCase() || 'FILE')} · ${sizeText}</div>
                                    </div>

                                    <button type="button" class="selected-file-remove" data-index="${index}" title="Remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            `;

                            selectedFilesList.appendChild(col);
                        });

                        selectedFilesList.querySelectorAll('.selected-file-remove').forEach(button => {
                            button.addEventListener('click', function () {
                                const index = Number(this.getAttribute('data-index'));
                                selectedFiles.splice(index, 1);
                                syncMirrorInput();
                                renderSelectedFiles();
                            });
                        });
                    }

                    function getExtension(fileName) {
                        const parts = fileName.split('.');
                        return parts.length > 1 ? parts.pop() : '';
                    }

                    function getFileIcon(file) {
                        if (file.type.startsWith('image/')) {
                            return 'bi-image';
                        }

                        if (file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')) {
                            return 'bi-file-earmark-pdf';
                        }

                        return 'bi-file-earmark';
                    }

                    function formatFileSize(bytes) {
                        if (bytes < 1024) return bytes + ' B';
                        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
                    }

                    function escapeHtml(text) {
                        const div = document.createElement('div');
                        div.textContent = text;
                        return div.innerHTML;
                    }
                }

                if (hiddenDeleteForm) {
                    document.querySelectorAll('.js-attachment-delete').forEach(button => {
                        button.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            const action = this.getAttribute('data-action');
                            if (!action) return;

                            if (confirm('Are you sure you want to remove this file?')) {
                                hiddenDeleteForm.setAttribute('action', action);
                                hiddenDeleteForm.submit();
                            }
                        });
                    });
                }
            });
        </script>
    @endpush
@endonce