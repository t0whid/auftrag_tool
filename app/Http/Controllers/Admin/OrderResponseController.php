<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderResponseController extends Controller
{
    public function index(Request $request): View
    {
        $responseFilter = $request->get('response');
        $orderFilter = $request->get('order');

        $orders = Order::query()
            ->with('creator')
            ->withCount('responses')
            ->withCount([
                'responses as yes_responses_count' => fn($q) => $q->where('response', 'yes'),
                'responses as maybe_responses_count' => fn($q) => $q->where('response', 'maybe'),
                'responses as no_responses_count' => fn($q) => $q->where('response', 'no'),
            ])
            ->withMax('responses', 'responded_at')

            ->when($orderFilter, fn($q) => $q->where('id', $orderFilter))

            ->orderByDesc('is_active')
            ->orderByDesc('start_date')
            ->get();

        $orderList = Order::orderByDesc('is_active')->orderByDesc('created_at')->get();

        return view('admin.order-responses.index', compact(
            'orders',
            'orderList',
            'responseFilter',
            'orderFilter'
        ));
    }

    public function show(Order $order): View
    {
        $order->load('creator');

        $responses = OrderResponse::query()
            ->with('user')
            ->where('order_id', $order->id)
            ->latest('responded_at')
            ->latest('id')
            ->get();

        $stats = [
            'total' => $responses->count(),
            'yes' => $responses->where('response', OrderResponse::RESPONSE_YES)->count(),
            'maybe' => $responses->where('response', OrderResponse::RESPONSE_MAYBE)->count(),
            'no' => $responses->where('response', OrderResponse::RESPONSE_NO)->count(),
            'latest_response_at' => $responses->max('responded_at'),
        ];

        return view('admin.order-responses.show', compact('order', 'responses', 'stats'));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $responses = OrderResponse::with(['user', 'order'])
            ->latest('responded_at')
            ->get();

        $fileName = 'order_responses_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $columns = [
            'Order Title',
            'Employee Name',
            'Employee Email',
            'Response',
            'Responded At',
        ];

        $callback = function () use ($responses, $columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($responses as $response) {
                fputcsv($file, [
                    $response->order?->title,
                    $response->user?->name,
                    $response->user?->email,
                    $response->response,
                    optional($response->responded_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
