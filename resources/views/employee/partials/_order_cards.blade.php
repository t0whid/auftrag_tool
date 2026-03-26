@foreach ($activeOrders as $order)
    <a href="{{ route('employee.orders.show', $order) }}" class="employee-order-card-link">
        <article class="employee-order-card">
            <div class="employee-order-card-top">
                <div class="employee-order-card-icon">
                    <i class="fa-regular fa-folder-open"></i>
                </div>

                <span class="employee-order-card-status">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ __('order.active') }}
                </span>
            </div>

            <h3 class="employee-order-card-title">{{ $order->title }}</h3>

            <div class="employee-order-card-meta">
                @if ($order->location)
                    <div class="employee-order-meta-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{ $order->location }}</span>
                    </div>
                @endif

                <div class="employee-order-meta-item">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span>
                        {{ $order->start_date?->format('d.m.Y') }}
                        @if ($order->end_date)
                            – {{ $order->end_date->format('d.m.Y') }}
                        @endif
                    </span>
                </div>

                @if ($order->team_info)
                    <div class="employee-order-meta-item">
                        <i class="fa-solid fa-users"></i>
                        <span>{{ $order->team_info }}</span>
                    </div>
                @endif

                @if (($order->attachments_count ?? 0) > 0)
                    <div class="employee-order-meta-item">
                        <i class="fa-solid fa-paperclip"></i>
                        <span>
                            {{ $order->attachments_count }}
                            {{ $order->attachments_count > 1 ? __('order.files') : __('order.file') }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="employee-order-card-footer">
                <span class="employee-order-open-text">{{ __('order.view_details') }}</span>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </article>
    </a>
@endforeach