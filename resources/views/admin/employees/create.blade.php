@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="section-title mb-1">Add Employee</h1>
        <p class="muted mb-0">Create a new employee account.</p>
    </div>

    <div class="card-soft p-4">
        <form method="POST" action="{{ route('admin.employees.store') }}">
            @csrf
            @include('admin.employees._form')
            <button type="submit" class="btn btn-soft-primary">Create Employee</button>
        </form>
    </div>
@endsection