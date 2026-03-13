@extends('layouts.admin')

@php
    $pageTitle = __('admin.employees_heading');
    $pageHeading = __('admin.employees_heading');
    $pageSubheading = __('admin.employees_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="panel-title">{{ __('admin.employees_heading') }}</h3>
                <p class="panel-subtitle">{{ __('admin.employees_subheading') }}</p>
            </div>

            <a href="{{ route('admin.employees.create') }}" class="btn btn-soft-primary">
                <i class="bi bi-plus-lg me-1"></i>
                {{ __('admin.add_employee') }}
            </a>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-modern align-middle mb-0" id="employeesTable">
                    <thead>
                        <tr>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.username') }}</th>
                            <th>{{ __('admin.email') }}</th>
                            <th>{{ __('admin.status') }}</th>
                            <th class="text-end">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td class="fw-semibold">{{ $employee->name }}</td>
                                <td>{{ $employee->username }}</td>
                                <td>{{ $employee->email ?: '—' }}</td>
                                <td>
                                    @if($employee->status)
                                        <span class="badge-soft-success">{{ __('admin.active') }}</span>
                                    @else
                                        <span class="badge-soft-secondary">{{ __('admin.inactive') }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.employees.edit', $employee) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-pencil-square me-1"></i>
                                        {{ __('admin.edit') }}
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.employees.destroy', $employee) }}"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                onclick="return confirm('{{ __('admin.confirm_delete_employee') }}')">
                                            <i class="bi bi-trash me-1"></i>
                                            {{ __('admin.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">
                                    {{ __('admin.no_employees_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#employeesTable').DataTable({
            pageLength: 10,
            ordering: true,
            responsive: false,
            language: {
                search: "{{ app()->getLocale() === 'de' ? 'Suche:' : 'Search:' }}",
                lengthMenu: "{{ app()->getLocale() === 'de' ? '_MENU_ Einträge anzeigen' : 'Show _MENU_ entries' }}",
                info: "{{ app()->getLocale() === 'de' ? '_START_ bis _END_ von _TOTAL_ Einträgen' : 'Showing _START_ to _END_ of _TOTAL_ entries' }}",
                infoEmpty: "{{ app()->getLocale() === 'de' ? '0 bis 0 von 0 Einträgen' : 'Showing 0 to 0 of 0 entries' }}",
                zeroRecords: "{{ app()->getLocale() === 'de' ? 'Keine passenden Einträge gefunden' : 'No matching records found' }}",
                paginate: {
                    first: "{{ app()->getLocale() === 'de' ? 'Erste' : 'First' }}",
                    last: "{{ app()->getLocale() === 'de' ? 'Letzte' : 'Last' }}",
                    next: "{{ app()->getLocale() === 'de' ? 'Weiter' : 'Next' }}",
                    previous: "{{ app()->getLocale() === 'de' ? 'Zurück' : 'Previous' }}"
                }
            }
        });
    });
</script>
@endpush