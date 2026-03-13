@extends('layouts.admin')

@php
    $pageTitle = __('order.edit_order');
    $pageHeading = __('order.edit_order');
    $pageSubheading = __('order.orders_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                @csrf
                @method('PUT')

                @include('admin.orders._form', ['order' => $order])

                <div class="d-flex justify-content-between align-items-center gap-3 mt-4 flex-wrap">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        {{ __('order.back') }}
                    </a>

                    <button type="submit" class="btn btn-soft-primary">
                        <i class="bi bi-save me-1"></i>
                        {{ __('order.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection