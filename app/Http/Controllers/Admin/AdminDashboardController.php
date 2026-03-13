<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $employeeCount = User::where('role', 'employee')->count();
        $activeEmployeeCount = User::where('role', 'employee')->where('status', true)->count();
        $inactiveEmployeeCount = User::where('role', 'employee')->where('status', false)->count();

        return view('admin.dashboard', compact(
            'employeeCount',
            'activeEmployeeCount',
            'inactiveEmployeeCount'
        ));
    }
}