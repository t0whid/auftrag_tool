<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderResponseController extends Controller
{
    public function store(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'response' => ['required', 'in:yes,maybe,no'],
        ]);

        if (! $order->is_active) {
            return back()->with('error', __('This order is no longer active.'));
        }

        OrderResponse::updateOrCreate(
            [
                'order_id' => $order->id,
                'user_id' => Auth::id(),
            ],
            [
                'response' => $validated['response'],
                'responded_at' => now(),
            ]
        );

        return back()->with('success', __('Your response has been saved.'));
    }
}