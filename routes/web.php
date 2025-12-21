<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Admin + Staff)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard (role-based view handled inside blade/controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile (Laravel Breeze requirement)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | Customer Management (PDF REQUIRED)
    |--------------------------------------------------------------------------
    */
    Route::resource('customers', CustomerController::class);

    /*
    |--------------------------------------------------------------------------
    | Order Management (PDF REQUIRED)
    |--------------------------------------------------------------------------
    */
    Route::resource('orders', OrderController::class)->except(['destroy']);

    /*
    |--------------------------------------------------------------------------
    | Export Routes (CSV and PDF)
    |--------------------------------------------------------------------------
    */
    Route::get('/export/customers/csv', [ExportController::class, 'exportCustomersCsv'])->name('export.customers.csv');
    Route::get('/export/customers/pdf', [ExportController::class, 'exportCustomersPdf'])->name('export.customers.pdf');
    Route::get('/export/orders/csv', [ExportController::class, 'exportOrdersCsv'])->name('export.orders.csv');
    Route::get('/export/orders/pdf', [ExportController::class, 'exportOrdersPdf'])->name('export.orders.pdf');
});

/*
|--------------------------------------------------------------------------
| Admin Only Routes (RBAC – PDF REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin can delete orders
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
        ->name('orders.destroy');

    // User Management (Admin Only)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login / Register / Password Reset)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
