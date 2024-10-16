<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('auth.login');
});

// Rute untuk Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Rute untuk Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Categories
    Route::resource('categories', CategoryController::class);

    // Rute untuk Posts
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';
