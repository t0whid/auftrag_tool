@extends('layouts.admin')

@php
    $pageTitle = __('admin.admins_heading');
    $pageHeading = __('admin.admins_heading');
    $pageSubheading = __('admin.admins_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="panel-title">{{ __('admin.admins_heading') }}</h3>
                <p class="panel-subtitle">{{ __('admin.admins_subheading') }}</p>
            </div>

            <a href="{{ route('admin.admin-users.create') }}" class="btn btn-soft-primary">
                <i class="bi bi-plus-lg me-1"></i>
                {{ __('admin.add_admin') }}
            </a>
        </div>

        <div class="panel-body">
            <div class="table-shell">
                <div class="table-responsive">
                    <table class="table table-modern align-middle mb-0" id="adminsTable">
                        <thead>
                            <tr>
                                <th>{{ __('order.sl') }}</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.username') }}</th>
                                <th>{{ __('admin.email') }}</th>
                                <th>{{ __('admin.role') }}</th>
                                <th>{{ __('admin.status') }}</th>
                                <th>{{ __('order.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $index => $admin)
                                <tr>
                                    <td class="table-center fw-bold">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $admin->name }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td class="table-center">
                                        @if($admin->role === 'super_admin')
                                            <span class="btn-soft-dark px-3 py-2 d-inline-flex rounded-pill fw-bold">
                                                {{ __('admin.super_admin') }}
                                            </span>
                                        @else
                                            <span class="btn-soft-info px-3 py-2 d-inline-flex rounded-pill fw-bold">
                                                {{ __('admin.admin_role') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="table-center">
                                        @if ($admin->status)
                                            <span class="badge-block-no">
                                                <i class="bi bi-check-circle"></i>
                                                {{ __('admin.active') }}
                                            </span>
                                        @else
                                            <span class="badge-block-yes">
                                                <i class="bi bi-dash-circle"></i>
                                                {{ __('admin.inactive') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="table-center">
                                        <div class="action-group">
                                            <a href="{{ route('admin.admin-users.edit', $admin) }}"
                                                class="btn btn-sm btn-action-edit"
                                                title="{{ __('order.edit') }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="{{ route('admin.admin-users.password.form', $admin) }}"
                                                class="btn btn-sm btn-soft-warning rounded-pill px-3"
                                                title="{{ __('admin.change_password') }}">
                                                <i class="bi bi-key"></i>
                                            </a>

                                            @if($admin->role !== 'super_admin' && auth()->id() !== $admin->id)
                                                <form method="POST"
                                                      action="{{ route('admin.admin-users.destroy', $admin) }}"
                                                      class="d-inline"
                                                      onsubmit="return confirm('{{ __('admin.confirm_delete_admin') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-action-delete"
                                                            title="{{ __('order.delete') }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
        $('#adminsTable').DataTable({
            pageLength: 10,
            ordering: true,
            autoWidth: false,
            columnDefs: [{
                    orderable: false,
                    targets: [0, 6]
                },
                {
                    className: 'text-center',
                    targets: [0, 4, 5, 6]
                }
            ]
        });
    });
</script>
@endpush