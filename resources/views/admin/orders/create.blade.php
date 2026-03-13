@extends('layouts.admin')

@php
    $pageTitle = __('order.create_order');
    $pageHeading = __('order.create_order');
    $pageSubheading = __('order.create_order_subtitle');
@endphp

@section('content')
    <div class="card-soft order-page-card">
        <div class="order-page-header">
            <div class="order-page-header-left">
                <div class="order-page-header-icon">
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div>
                    <h3 class="order-page-title">{{ __('order.create_order') }}</h3>
                    <p class="order-page-subtitle">{{ __('order.create_order_subtitle') }}</p>
                </div>
            </div>
        </div>

        <div class="order-page-divider"></div>

        <div class="panel-body">
            <form method="POST" action="{{ route('admin.orders.store') }}">
                @csrf

                @include('admin.orders._form')

                <div class="order-form-actions">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-light order-action-btn">
                        <i class="bi bi-arrow-left me-1"></i>
                        {{ __('order.back') }}
                    </a>

                    <button type="submit" class="btn btn-soft-primary order-action-btn">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('order.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

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
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
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

    @media (max-width: 767.98px) {
        .order-page-header {
            padding: 20px 18px 0;
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