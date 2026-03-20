@extends('layouts.admin')

@php
    $pageTitle = __('order.orders_heading');
    $pageHeading = __('order.orders_heading');
    $pageSubheading = __('order.orders_subheading');
@endphp

@section('content')
    <div class="card-soft">
        <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="panel-title">{{ __('order.orders_heading') }}</h3>
                <p class="panel-subtitle">{{ __('order.orders_subheading') }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.order-responses.index') }}" class="btn btn-soft-success">
                    <i class="bi bi-chat-left-text me-1"></i>
                    {{ __('order.nav_order_responses') }}
                </a>

                <a href="{{ route('admin.orders.create') }}" class="btn btn-soft-primary">
                    <i class="bi bi-plus-lg me-1"></i>
                    {{ __('order.add_order') }}
                </a>
            </div>
        </div>

        <div class="panel-body">
            <div class="table-shell">
                <div class="table-responsive">
                    <table class="table table-modern align-middle mb-0" id="ordersTable">
                        <thead>
                            <tr>
                                <th>{{ __('order.sl') }}</th>
                                <th>{{ __('order.title') }}</th>
                                <th>{{ __('order.location') }}</th>
                                <th>{{ __('order.start_date') }}</th>
                                <th>{{ __('order.end_date') }}</th>
                                <th>{{ __('order.created_by') }}</th>
                                <th>{{ __('order.status') }}</th>
                                <th>{{ __('order.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td class="table-center fw-bold">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $order->title }}</td>
                                    <td>{{ $order->location ?: '—' }}</td>
                                    <td class="table-center">{{ $order->start_date?->format('d M Y') }}</td>
                                    <td class="table-center">{{ $order->end_date?->format('d M Y') }}</td>
                                    <td>{{ $order->creator?->name ?? '—' }}</td>

                                    <td class="table-center">
                                        <form method="POST" action="{{ route('admin.orders.toggle-status', $order) }}"
                                            class="d-inline-flex align-items-center gap-2 order-status-toggle-form">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-check form-switch m-0 order-status-switch-wrap">
                                                <input class="form-check-input order-status-switch" type="checkbox"
                                                    role="switch" id="order_status_{{ $order->id }}"
                                                    {{ $order->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                            </div>

                                            @if ($order->is_active)
                                                <span class="badge-block-no">
                                                    <i class="bi bi-check-circle"></i>
                                                    {{-- {{ __('order.active') }} --}}
                                                </span>
                                            @else
                                                <span class="badge-block-yes">
                                                    <i class="bi bi-dash-circle"></i>
                                                    {{-- {{ __('order.inactive') }} --}}
                                                </span>
                                            @endif
                                        </form>
                                    </td>

                                    <td class="table-center">
                                        <div class="action-group icon-action-group">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-icon-action btn-icon-view"
                                                title="{{ __('order.view') }}" aria-label="{{ __('order.view') }}">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.order-responses.show', $order) }}"
                                                class="btn btn-sm btn-icon-action btn-icon-response"
                                                title="{{ __('order.view_responses') }}"
                                                aria-label="{{ __('order.view_responses') }}">
                                                <i class="bi bi-chat-square-text"></i>
                                            </a>

                                            <a href="{{ route('admin.orders.edit', $order) }}"
                                                class="btn btn-sm btn-icon-action btn-icon-edit"
                                                title="{{ __('order.edit') }}" aria-label="{{ __('order.edit') }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon-action btn-icon-delete"
                                                    title="{{ __('order.delete') }}" aria-label="{{ __('order.delete') }}"
                                                    onclick="return confirm('{{ __('order.confirm_delete_order') }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
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

@push('styles')
    <style>
        .order-status-toggle-form {
            justify-content: center;
            flex-wrap: wrap;
        }

        .order-status-switch-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-status-switch {
            width: 3rem;
            height: 1.6rem;
            cursor: pointer;
        }

        .order-status-switch:checked {
            background-color: #2f80ed;
            border-color: #2f80ed;
        }

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

        .btn-icon-view {
            background: #eaf8ef;
            color: #18794e;
            border-color: #ccebd7;
        }

        .btn-icon-view:hover {
            background: #def3e6;
            color: #125c3b;
        }

        .btn-icon-response {
            background: #eef4ff;
            color: #2563eb;
            border-color: #d7e5ff;
        }

        .btn-icon-response:hover {
            background: #e3edff;
            color: #1d4ed8;
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable({
                pageLength: 10,
                ordering: true,
                autoWidth: false,
                columnDefs: [{
                        orderable: false,
                        targets: 6
                    },
                    {
                        className: 'text-center',
                        targets: [2, 3, 5, 6]
                    }
                ]
            });
        });
    </script>
@endpush
