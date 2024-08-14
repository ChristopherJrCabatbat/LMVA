<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// route::get('admin/dashboard', [LoginController::class, 'admin'])->middleware(['auth', 'login']);

// route::get('staff/dashboard', [LoginController::class, 'staff'])->middleware(['auth', 'login']);

Route::middleware(['auth', 'login'])->group(function () {
    Route::get('admin/dashboard', [LoginController::class, 'admin']);
    Route::get('staff/dashboard', [LoginController::class, 'staff']);
    Route::get('user/dashboard', [LoginController::class, 'user']);
});