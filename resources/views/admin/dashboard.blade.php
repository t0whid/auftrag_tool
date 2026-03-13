@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="section-title mb-1">Admin Dashboard</h1>
            <p class="muted mb-0">Manage employees and system access.</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger rounded-pill">
                <i class="bi bi-box-arrow-right me-1"></i>
                {{ __('auth.logout') }}
            </button>
        </form>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card-soft p-4">
                <div class="fw-bold fs-5">Employees</div>
                <div class="muted mb-2">Overview of employee accounts.</div>

                <div class="row text-center g-3 mt-1">
                    <div class="col-4">
                        <div class="border rounded-4 p-3">
                            <div class="fs-4 fw-bold">{{ $employeeCount }}</div>
                            <div class="small text-secondary">Total</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border rounded-4 p-3">
                            <div class="fs-4 fw-bold">{{ $activeEmployeeCount }}</div>
                            <div class="small text-secondary">Active</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border rounded-4 p-3">
                            <div class="fs-4 fw-bold">{{ $inactiveEmployeeCount }}</div>
                            <div class="small text-secondary">Inactive</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-soft-primary">
                        <i class="bi bi-people me-1"></i>
                        Manage Employees
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection