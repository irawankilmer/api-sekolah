<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
  Route::get('/sys/login', 'login')->name('login');
  Route::post('/sys/login', 'store')->name('login.store');
  Route::post('/sys/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('sys')->group(function() {
        Route::name('sys.')->group(function() {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        });
    });
});