<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderResponse;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $employeeCount = User::where('role', 'employee')->count();

        $activeEmployeeCount = User::where('role', 'employee')
            ->where('status', true)
            ->count();

        $inactiveEmployeeCount = User::where('role', 'employee')
            ->where('status', false)
            ->count();

        $orderCount = Order::count();
        $activeOrderCount = Order::where('is_active', true)->count();
        $inactiveOrderCount = Order::where('is_active', false)->count();

        $responseCount = OrderResponse::count();
        $yesResponseCount = OrderResponse::where('response', OrderResponse::RESPONSE_YES)->count();
        $maybeResponseCount = OrderResponse::where('response', OrderResponse::RESPONSE_MAYBE)->count();
        $noResponseCount = OrderResponse::where('response', OrderResponse::RESPONSE_NO)->count();

        $latestActiveOrder = Order::with('creator')
            ->where('is_active', true)
            ->latest('start_date')
            ->latest('id')
            ->first();

        $recentOrders = Order::with('creator')
            ->latest()
            ->take(5)
            ->get();

        $recentResponses = OrderResponse::with(['user', 'order'])
            ->latest('responded_at')
            ->latest('id')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'employeeCount',
            'activeEmployeeCount',
            'inactiveEmployeeCount',
            'orderCount',
            'activeOrderCount',
            'inactiveOrderCount',
            'responseCount',
            'yesResponseCount',
            'maybeResponseCount',
            'noResponseCount',
            'latestActiveOrder',
            'recentOrders',
            'recentResponses'
        ));
    }
}