@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="section-title mb-2">{{ __('app.welcome_title') }}</h1>
        <p class="muted mb-0">{{ __('app.welcome_subtitle') }}</p>
    </div>

    <div class="card-soft p-4 mb-4">
        <h2 class="h4 fw-bold mb-3">{{ __('app.phase1_ready') }}</h2>
        <p class="muted mb-3">
            {{ __('app.phase1_description') }}
        </p>

        <div class="d-grid gap-3">
            <div class="p-3 rounded-4 border bg-light">
                <div class="fw-semibold">{{ __('app.feature_multilang') }}</div>
                <div class="small text-secondary">{{ __('app.feature_multilang_desc') }}</div>
            </div>

            <div class="p-3 rounded-4 border bg-light">
                <div class="fw-semibold">{{ __('app.feature_mobile') }}</div>
                <div class="small text-secondary">{{ __('app.feature_mobile_desc') }}</div>
            </div>

            <div class="p-3 rounded-4 border bg-light">
                <div class="fw-semibold">{{ __('app.feature_bootstrap') }}</div>
                <div class="small text-secondary">{{ __('app.feature_bootstrap_desc') }}</div>
            </div>
        </div>
    </div>

    <div class="card-soft p-4">
        <h3 class="h5 fw-bold mb-3">{{ __('app.next_step') }}</h3>
        <p class="muted mb-0">
            {{ __('app.next_step_desc') }}
        </p>
    </div>
@endsection