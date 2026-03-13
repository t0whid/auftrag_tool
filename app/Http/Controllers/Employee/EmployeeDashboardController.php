<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class EmployeeDashboardController extends Controller
{
    public function index(): View
    {
        $activeOrder = Order::where('is_active', true)->latest()->first();

        return view('employee.dashboard', compact('activeOrder'));
    }
}