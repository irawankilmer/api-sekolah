<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function() {
    return 'Login';
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('sys')->group(function() {
        Route::name('sys.')->group(function() {
            Route::get('/', function() {
                return 'Dashboard';
            })->name('dashboard');
        });
    });
});