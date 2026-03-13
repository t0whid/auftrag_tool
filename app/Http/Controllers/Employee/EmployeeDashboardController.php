<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmployeeDashboardController extends Controller
{
    public function index(): View
    {
        $activeOrder = Order::where('is_active', true)->latest()->first();

        $myResponse = null;

        if ($activeOrder) {
            $myResponse = OrderResponse::where('order_id', $activeOrder->id)
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('employee.dashboard', compact('activeOrder', 'myResponse'));
    }
}