<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;

Route::middleware('guest')->group(
    function () {
        Route::get("/login", [AuthController::class, 'login'])->name('login');
        Route::post("/login", [AuthController::class, 'validateLogin'])->name('validateLogin');
        Route::get("/register", [AuthController::class, 'register'])->name('register');
        Route::post("/register", [AuthController::class, 'validateRegister'])->name('validateRegister');
        Route::get('/logout', [AuthController::class, 'logout']);
    }
);

Route::middleware('auth')->group(
    function () {
        Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get("/", [DashboardController::class, 'index'])->name('home');
        Route::resource('employee', EmployeeController::class)->except('destroy');
        Route::resource('vendor', VendorController::class)->except('destroy');
        Route::resource('item', ItemController::class)->except('destroy');
        Route::resource('stock', StockController::class)->only('index');
        Route::resource('invoice', InvoiceController::class)->only('index', 'create', 'store');
    }
);
