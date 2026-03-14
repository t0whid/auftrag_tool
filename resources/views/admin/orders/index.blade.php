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
                <a href="{{ route('admin.order-responses.index') }}" class="btn btn-soft-light">
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
                                <th>{{ __('order.title') }}</th>
                                <th>{{ __('order.location') }}</th>
                                <th>{{ __('order.start_date') }}</th>
                                <th>{{ __('order.end_date') }}</th>
                                <th>{{ __('order.created_by') }}</th>
                                <th>{{ __('order.is_active') }}</th>
                                <th>{{ __('order.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="fw-semibold">{{ $order->title }}</td>
                                    <td>{{ $order->location ?: '—' }}</td>
                                    <td class="table-center">{{ $order->start_date?->format('d M Y') }}</td>
                                    <td class="table-center">{{ $order->end_date?->format('d M Y') }}</td>
                                    <td>{{ $order->creator?->name ?? '—' }}</td>
                                    <td class="table-center">
                                        @if ($order->is_active)
                                            <span class="badge-block-no">
                                                <i class="bi bi-check-circle"></i>
                                                {{ __('order.active') }}
                                            </span>
                                        @else
                                            <span class="badge-block-yes">
                                                <i class="bi bi-dash-circle"></i>
                                                {{ __('order.inactive') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="table-center">
                                        <div class="action-group">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-soft-light rounded-pill px-3">
                                                <i class="bi bi-eye me-1"></i>
                                                {{ __('order.view') }}
                                            </a>

                                            <a href="{{ route('admin.order-responses.show', $order) }}"
                                                class="btn btn-sm btn-soft-light rounded-pill px-3">
                                                <i class="bi bi-chat-left-text me-1"></i>
                                                {{ __('order.view_responses') }}
                                            </a>

                                            <a href="{{ route('admin.orders.edit', $order) }}"
                                                class="btn btn-sm btn-action-edit">
                                                <i class="bi bi-pencil-square me-1"></i>
                                                {{ __('order.edit') }}
                                            </a>

                                            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action-delete"
                                                    onclick="return confirm('{{ __('order.confirm_delete_order') }}')">
                                                    <i class="bi bi-trash me-1"></i>
                                                    {{ __('order.delete') }}
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