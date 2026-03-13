@extends('layouts.admin')

@php
    $pageTitle = __('order.add_order');
    $pageHeading = __('order.add_order');
    $pageSubheading = __('order.orders_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.orders.store') }}">
                @csrf

                @include('admin.orders._form')

                <div class="d-flex justify-content-between align-items-center gap-3 mt-4 flex-wrap">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        {{ __('order.back') }}
                    </a>

                    <button type="submit" class="btn btn-soft-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('order.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection