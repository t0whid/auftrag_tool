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
            <div class="table-shell">
                <div class="table-responsive">
                    <table class="table table-modern align-middle mb-0" id="employeesTable">
                        <thead>
                            <tr>
                                <th>{{ __('order.sl') }}</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.username') }}</th>
                                <th>{{ __('admin.email') }}</th>
                                <th>{{ __('admin.block') }}</th>
                                <th>{{ __('admin.created_at') }}</th>
                                <th>{{ __('admin.updated_at') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $index => $employee)
                                <tr>
                                    <td class="table-center fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="employee-name">{{ $employee->name }}</div>
                                    </td>

                                    <td class="table-center">
                                        <span class="employee-username">
                                            <i class="bi bi-person-badge"></i>
                                            {{ $employee->username }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="employee-email">{{ $employee->email ?: '—' }}</div>
                                    </td>

                                    <td class="table-center">
                                        @if ($employee->status)
                                            <span class="badge-block-no">
                                                <i class="bi bi-unlock"></i>
                                                {{ __('admin.active') }}
                                            </span>
                                        @else
                                            <span class="badge-block-yes">
                                                <i class="bi bi-lock"></i>
                                                {{ __('admin.inactive') }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="table-date">
                                        {{ $employee->created_at?->format('d M Y, h:i A') }}
                                    </td>

                                    <td class="table-date">
                                        {{ $employee->updated_at?->format('d M Y, h:i A') }}
                                    </td>

                                    <td class="table-center">
                                        <div class="action-group icon-action-group">
                                            <a href="{{ route('admin.employees.edit', $employee) }}"
                                                class="btn btn-sm btn-icon-action btn-icon-edit"
                                                title="{{ __('admin.edit') }}" aria-label="{{ __('admin.edit') }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form method="POST" action="{{ route('admin.employees.destroy', $employee) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon-action btn-icon-delete"
                                                    title="{{ __('admin.delete') }}" aria-label="{{ __('admin.delete') }}"
                                                    onclick="return confirm('{{ __('admin.confirm_delete_employee') }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-secondary py-4">
                                        {{ __('admin.no_employees_found') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#employeesTable').DataTable({
                pageLength: 10,
                ordering: true,
                responsive: false,
                autoWidth: false,
                language: {
                    search: "{{ app()->getLocale() === 'de' ? 'Suche:' : 'Search:' }}",
                    lengthMenu: "{{ app()->getLocale() === 'de' ? 'Show _MENU_ Einträge' : 'Show _MENU_ entries' }}",
                    info: "{{ app()->getLocale() === 'de' ? '_START_ bis _END_ von _TOTAL_ Einträgen' : 'Showing _START_ to _END_ of _TOTAL_ entries' }}",
                    infoEmpty: "{{ app()->getLocale() === 'de' ? '0 bis 0 von 0 Einträgen' : 'Showing 0 to 0 of 0 entries' }}",
                    zeroRecords: "{{ app()->getLocale() === 'de' ? 'Keine passenden Einträge gefunden' : 'No matching records found' }}",
                    emptyTable: "{{ app()->getLocale() === 'de' ? 'Keine Daten verfügbar' : 'No data available' }}",
                    paginate: {
                        first: "{{ app()->getLocale() === 'de' ? 'Erste' : 'First' }}",
                        last: "{{ app()->getLocale() === 'de' ? 'Letzte' : 'Last' }}",
                        next: "{{ app()->getLocale() === 'de' ? 'Weiter' : 'Next' }}",
                        previous: "{{ app()->getLocale() === 'de' ? 'Zurück' : 'Previous' }}"
                    }
                },
                columnDefs: [{
                        orderable: false,
                        targets: 6
                    },
                    {
                        className: 'text-center',
                        targets: [1, 3, 4, 5, 6]
                    }
                ]
            });
        });
    </script>
@endpush

@push('styles')
<style>
    .icon-action-group {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-icon-action {
        width: 38px;
        height: 38px;
        padding: 0;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        transition: all .18s ease;
    }

    .btn-icon-action i {
        font-size: 0.95rem;
        line-height: 1;
    }

    .btn-icon-edit {
        background: #fff8e8;
        color: #a16207;
        border-color: #fde7b0;
    }

    .btn-icon-edit:hover {
        background: #fef2cc;
        color: #854d0e;
    }

    .btn-icon-delete {
        background: #fff5f5;
        color: #dc2626;
        border-color: #ffd6d6;
    }

    .btn-icon-delete:hover {
        background: #ffe9e9;
        color: #b91c1c;
    }
</style>
@endpush