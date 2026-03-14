<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderResponseController as AdminOrderResponseController;
use App\Http\Controllers\Employee\OrderResponseController;

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Root / Login
|--------------------------------------------------------------------------
*/
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin + Super Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('employees', EmployeeController::class)->parameters([
        'employees' => 'employee',
    ]);

    Route::resource('orders', OrderController::class);

    Route::get('/order-responses/export', [AdminOrderResponseController::class, 'exportCsv'])
        ->name('order-responses.export');

    Route::get('/order-responses', [AdminOrderResponseController::class, 'index'])
        ->name('order-responses.index');

    Route::get('/order-responses/{order}', [AdminOrderResponseController::class, 'show'])
        ->name('order-responses.show');

    Route::get('/my-password', [AdminUserController::class, 'myPasswordForm'])->name('my-password.form');
    Route::put('/my-password', [AdminUserController::class, 'updateMyPassword'])->name('my-password.update');
});

/*
|--------------------------------------------------------------------------
| Super Admin Only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admins', [AdminUserController::class, 'index'])->name('admin-users.index');
    Route::get('/admins/create', [AdminUserController::class, 'create'])->name('admin-users.create');
    Route::post('/admins', [AdminUserController::class, 'store'])->name('admin-users.store');

    Route::get('/admins/{admin_user}/edit', [AdminUserController::class, 'edit'])->name('admin-users.edit');
    Route::put('/admins/{admin_user}', [AdminUserController::class, 'update'])->name('admin-users.update');

    Route::get('/admins/{admin_user}/password', [AdminUserController::class, 'passwordForm'])->name('admin-users.password.form');
    Route::put('/admins/{admin_user}/password', [AdminUserController::class, 'updatePassword'])->name('admin-users.password.update');

    Route::delete('/admins/{admin_user}', [AdminUserController::class, 'destroy'])->name('admin-users.destroy');
});

/*
|--------------------------------------------------------------------------
| Employee Actions Only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'employee'])->name('employee.')->group(function () {
    Route::post('/orders/{order}/response', [OrderResponseController::class, 'store'])
        ->name('orders.response.store');
});