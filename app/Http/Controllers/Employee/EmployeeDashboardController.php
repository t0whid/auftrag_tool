<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderResponse;
use Illuminate\Http\JsonResponse;
use App\Models\OrderAttachment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmployeeDashboardController extends Controller
{
    public function index(): View|JsonResponse
    {
        $activeOrders = Order::query()
            ->where('is_active', true)
            ->withCount('attachments')
            ->orderByDesc('created_at')
            ->paginate(10);

        if (request()->ajax()) {
            $html = view('employee.partials._order_cards', [
                'activeOrders' => $activeOrders,
            ])->render();

            return response()->json([
                'html' => $html,
                'next_page_url' => $activeOrders->nextPageUrl(),
            ]);
        }

        return view('employee.dashboard', compact('activeOrders'));
    }

    public function show(Order $order): View
    {
        abort_unless($order->is_active, 404);

        $order->load('attachments');

        $myResponse = OrderResponse::query()
            ->where('order_id', $order->id)
            ->where('user_id', Auth::id())
            ->first();

        return view('employee.orders.show', compact('order', 'myResponse'));
    }

    public function viewAttachment(Order $order, OrderAttachment $attachment)
    {
        abort_unless($order->is_active, 404);

        if ((int) $attachment->order_id !== (int) $order->id) {
            abort(404);
        }

        $absolutePath = base_path($attachment->file_path);

        if (! is_file($absolutePath)) {
            abort(404);
        }

        $mimeType = $attachment->file_type ?: File::mimeType($absolutePath) ?: 'application/octet-stream';

        return Response::file($absolutePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $attachment->file_name . '"',
        ]);
    }
}
