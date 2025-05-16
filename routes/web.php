<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/sys/login', [AuthController::class, 'login'])->name('login');
Route::post('/sys/login', [AuthController::class, 'store'])->name('login.store');

Route::middleware(['auth'])->group(function () {
    Route::prefix('sys')->group(function() {
        Route::name('sys.')->group(function() {
            Route::get('/', function() {
                return 'Dashboard';
            })->name('dashboard');
        });
    });
});