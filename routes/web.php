<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderResponseController as AdminOrderResponseController;

use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\OrderResponseController;

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('employees', EmployeeController::class)->parameters([
        'employees' => 'employee'
    ]);
    Route::resource('orders', OrderController::class);
    Route::get('/order-responses', [AdminOrderResponseController::class, 'index'])->name('order-responses.index');
    Route::get('/order-responses/{order}', [AdminOrderResponseController::class, 'show'])->name('order-responses.show');
});

Route::middleware(['auth', 'employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
    Route::post('/orders/{order}/response', [OrderResponseController::class, 'store'])->name('orders.response.store');
});
