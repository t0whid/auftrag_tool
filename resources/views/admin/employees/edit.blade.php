@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="section-title mb-1">Edit Employee</h1>
        <p class="muted mb-0">Update employee details and access.</p>
    </div>

    <div class="card-soft p-4">
        <form method="POST" action="{{ route('admin.employees.update', $employee) }}">
            @csrf
            @method('PUT')
            @include('admin.employees._form')
            <button type="submit" class="btn btn-soft-primary">Update Employee</button>
        </form>
    </div>
@endsection