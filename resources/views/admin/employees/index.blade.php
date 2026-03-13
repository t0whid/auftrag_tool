@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="section-title mb-1">Employees</h1>
            <p class="muted mb-0">Create, edit and manage employee accounts.</p>
        </div>
        <a href="{{ route('admin.employees.create') }}" class="btn btn-soft-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Add Employee
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
    @endif

    <div class="card-soft p-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->username }}</td>
                            <td>
                                @if($employee->status)
                                    <span class="badge text-bg-success rounded-pill">Active</span>
                                @else
                                    <span class="badge text-bg-secondary rounded-pill">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.employees.edit', $employee) }}"
                                   class="btn btn-sm btn-outline-primary rounded-pill">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.employees.destroy', $employee) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-pill"
                                            onclick="return confirm('Delete this employee?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-secondary">
                                No employees found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $employees->links() }}
        </div>
    </div>
@endsection