@extends('layouts.employee')

@section('content')
    <div class="page-body">
        <div class="employee-orders-page">
            <div class="employee-orders-head">
                <div>
                    <h1 class="page-heading mb-2">{{ __('order.new_order') }}</h1>
                    <p class="employee-orders-subtitle">{{ __('order.please_check_active_orders') }}</p>
                </div>
            </div>

            @if ($activeOrders->count())
                <div id="orderCardsContainer" class="employee-order-grid">
                    @include('employee.partials._order_cards', ['activeOrders' => $activeOrders])
                </div>

                @if ($activeOrders->hasMorePages())
                    <div class="load-more-wrap" id="loadMoreWrap">
                        <button
                            type="button"
                            id="loadMoreOrdersBtn"
                            class="load-more-btn"
                            data-next-page="{{ $activeOrders->nextPageUrl() }}">
                            <span class="load-more-btn-text">{{ __('order.load_more') }}</span>
                        </button>
                    </div>
                @endif
            @else
                <section class="card-soft empty-state">
                    <div class="empty-icon">
                        <i class="fa-regular fa-folder-open"></i>
                    </div>
                    <h3 class="fw-bold mb-2">{{ __('order.no_active_order_available') }}</h3>
                    <p class="text-muted mb-0">{{ __('order.please_check_back_later') }}</p>
                </section>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            const $loadMoreBtn = $('#loadMoreOrdersBtn');
            const $container = $('#orderCardsContainer');
            const $wrap = $('#loadMoreWrap');

            $loadMoreBtn.on('click', function() {
                const nextPage = $(this).attr('data-next-page');

                if (!nextPage) return;

                $(this).prop('disabled', true).addClass('is-loading');
                $(this).find('.load-more-btn-text').text('{{ __('order.loading') }}...');

                $.ajax({
                    url: nextPage,
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.html) {
                            $container.append(response.html);
                        }

                        if (response.next_page_url) {
                            $loadMoreBtn.attr('data-next-page', response.next_page_url);
                            $loadMoreBtn.prop('disabled', false).removeClass('is-loading');
                            $loadMoreBtn.find('.load-more-btn-text').text('{{ __('order.load_more') }}');
                        } else {
                            $wrap.remove();
                        }
                    },
                    error: function() {
                        $loadMoreBtn.prop('disabled', false).removeClass('is-loading');
                        $loadMoreBtn.find('.load-more-btn-text').text('{{ __('order.load_more') }}');
                        toastr.error('{{ __('order.something_went_wrong') }}');
                    }
                });
            });
        });
    </script>
@endpush