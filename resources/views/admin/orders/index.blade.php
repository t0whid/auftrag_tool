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
                                <th>Files</th>
                                <th>{{ __('order.status') }}</th>
                                <th>{{ __('order.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td class="table-center fw-bold">{{ $index + 1 }}</td>

                                    <td>
                                        <div class="order-title-cell">
                                            <div class="order-title-text">{{ $order->title }}</div>
                                            @if (!empty($order->description))
                                                <div class="order-title-subtext">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($order->description), 70) }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td>{{ $order->location ?: '—' }}</td>

                                    <td class="table-center">
                                        {{ $order->start_date?->format('d M Y') ?: '—' }}
                                    </td>

                                    <td class="table-center">
                                        {{ $order->end_date?->format('d M Y') ?: '—' }}
                                    </td>

                                    <td>{{ $order->creator?->name ?? '—' }}</td>

                                    <td class="table-center">
                                        <span class="file-count-badge">
                                            <i class="bi bi-paperclip me-1"></i>
                                            {{ $order->attachments_count ?? 0 }}
                                        </span>
                                    </td>

                                    <td class="table-center">
                                        <form method="POST"
                                            action="{{ route('admin.orders.toggle-status', $order) }}"
                                            class="d-inline-flex align-items-center gap-2 order-status-toggle-form">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-check form-switch m-0 order-status-switch-wrap">
                                                <input class="form-check-input order-status-switch" type="checkbox"
                                                    role="switch" id="order_status_{{ $order->id }}"
                                                    {{ $order->is_active ? 'checked' : '' }}
                                                    onchange="this.form.submit()">
                                            </div>

                                            @if ($order->is_active)
                                                <span class="badge-block-no">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            @else
                                                <span class="badge-block-yes">
                                                    <i class="bi bi-dash-circle"></i>
                                                </span>
                                            @endif
                                        </form>
                                    </td>

                                    <td class="table-center">
                                        <div class="action-group icon-action-group">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-icon-action btn-icon-view"
                                                title="{{ __('order.view') }}"
                                                aria-label="{{ __('order.view') }}">
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
                                                title="{{ __('order.edit') }}"
                                                aria-label="{{ __('order.edit') }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form method="POST"
                                                action="{{ route('admin.orders.destroy', $order) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-sm btn-icon-action btn-icon-delete"
                                                    title="{{ __('order.delete') }}"
                                                    aria-label="{{ __('order.delete') }}"
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

                @if ($orders->isEmpty())
                    <div class="empty-state-wrap">
                        <div class="empty-state-icon">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <h5 class="empty-state-title">No orders found</h5>
                        <p class="empty-state-text mb-0">Create your first order to get started.</p>
                    </div>
                @endif
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

        .order-title-cell {
            min-width: 180px;
        }

        .order-title-text {
            font-weight: 700;
            color: #163253;
            line-height: 1.35;
        }

        .order-title-subtext {
            margin-top: 4px;
            font-size: .84rem;
            color: #7b8aa0;
            line-height: 1.45;
        }

        .file-count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 62px;
            padding: 7px 12px;
            border-radius: 999px;
            background: #f4f8ff;
            border: 1px solid #dce7f7;
            color: #315b97;
            font-weight: 700;
            font-size: .86rem;
        }

        .empty-state-wrap {
            text-align: center;
            padding: 40px 16px 12px;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 12px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #eef6ff 0%, #e2efff 100%);
            color: #2f80ed;
            font-size: 1.5rem;
        }

        .empty-state-title {
            margin-bottom: 6px;
            font-weight: 800;
            color: #163253;
        }

        .empty-state-text {
            color: #74839a;
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
                columnDefs: [
                    {
                        orderable: false,
                        targets: [7, 8]
                    },
                    {
                        className: 'text-center',
                        targets: [0, 2, 3, 4, 6, 7, 8]
                    }
                ]
            });
        });
    </script>
@endpush