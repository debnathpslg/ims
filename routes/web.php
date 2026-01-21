<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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
        Route::resource('employee', EmployeeController::class)->only('index', 'create', 'store', 'show');
    }
);
