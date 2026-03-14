<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderResponse;
use Illuminate\View\View;

class OrderResponseController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->with('creator')
            ->withCount('responses')
            ->withCount([
                'responses as yes_responses_count' => fn ($query) => $query->where('response', OrderResponse::RESPONSE_YES),
                'responses as maybe_responses_count' => fn ($query) => $query->where('response', OrderResponse::RESPONSE_MAYBE),
                'responses as no_responses_count' => fn ($query) => $query->where('response', OrderResponse::RESPONSE_NO),
            ])
            ->withMax('responses', 'responded_at')
            ->orderByDesc('is_active')
            ->orderByDesc('start_date')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.order-responses.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load([
            'creator',
            'responses' => fn ($query) => $query
                ->with('user')
                ->latest('responded_at')
                ->latest('id'),
        ]);

        $responses = $order->responses;

        $stats = [
            'total' => $responses->count(),
            'yes' => $responses->where('response', OrderResponse::RESPONSE_YES)->count(),
            'maybe' => $responses->where('response', OrderResponse::RESPONSE_MAYBE)->count(),
            'no' => $responses->where('response', OrderResponse::RESPONSE_NO)->count(),
            'latest_response_at' => $responses->max('responded_at'),
        ];

        return view('admin.order-responses.show', compact('order', 'responses', 'stats'));
    }
}