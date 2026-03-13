@extends('layouts.admin')

@php
    $pageTitle = __('admin.create_employee_heading');
    $pageHeading = __('admin.create_employee_heading');
    $pageSubheading = __('admin.create_employee_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.employees.store') }}">
                @csrf
                @include('admin.employees._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-soft-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('admin.create_employee') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection