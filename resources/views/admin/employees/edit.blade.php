@extends('layouts.admin')

@php
    $pageTitle = __('admin.edit_employee_heading');
    $pageHeading = __('admin.edit_employee_heading');
    $pageSubheading = __('admin.edit_employee_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.employees.update', $employee) }}">
                @csrf
                @method('PUT')
                @include('admin.employees._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-soft-primary">
                        <i class="bi bi-save me-1"></i>
                        {{ __('admin.update_employee') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection