<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(FrontController::class)->group(function() {
  Route::get('/', 'index')->name('home');
});

Route::middleware(RedirectIfAuthenticated::class)->group(function() {
  Route::controller(AuthController::class)->group(function() {
    Route::get('/sys/login', 'login')->name('login');
    Route::post('/sys/login', 'store')->name('login.store');
  });
});

Route::middleware(['auth'])->group(function () {
  Route::prefix('sys')->group(function() {
    Route::name('sys.')->group(function() {
      Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

      Route::controller(CategoryController::class)->group(function() {
        Route::get('/kategori', 'index')->name('kategori');
      });

      Route::controller(TagController::class)->group(function() {
        Route::get('/tag', 'index')->name('tag');
        Route::post('/tag', 'store')->name('tag.store');
        Route::delete('/tag/{id}', 'destroy')->name('tag.destroy');
      });
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  });
});