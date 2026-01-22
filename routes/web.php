<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;

Route::middleware('guest')->group(
    function () {
        Route::get("/login", [AuthController::class, 'login'])->name('login');
        Route::post("/login", [AuthController::class, 'validateLogin'])->name('validateLogin');
        Route::get("/register", [AuthController::class, 'register'])->name('register');
        Route::post("/register", [AuthController::class, 'validateRegister'])->name('validateRegister');
    }
);

Route::middleware('auth')->group(
    function () {
        Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get("/", [DashboardController::class, 'index'])->name('home');
        Route::resource('employee', EmployeeController::class)->except('destroy');
        Route::resource('vendor', VendorController::class)->except('destroy');
        Route::resource('item', ItemController::class)->except('destroy');
    }
);
