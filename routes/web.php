<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('start.home');
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


// Admin Routes
Route::group([
    'prefix' => 'admin', 'as' => 'admin.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/accounts', [AdminController::class, 'accounts']);
    Route::get('/derm', [AdminController::class, 'derm']);
    Route::get('/reports', [AdminController::class, 'reports']);

});


// Staff Routes
Route::group([
    'prefix' => 'staff', 'as' => 'staff.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    Route::get('/patientRecord', [StaffController::class, 'patientRecord']);
    Route::get('/scan', [StaffController::class, 'scan']);
    Route::get('/inquiry', [StaffController::class, 'inquiry']);

});


// User Routes
Route::group([
    'prefix' => 'user', 'as' => 'user.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    Route::get('/dashboard', [UserController::class, 'dashboard']);    
    Route::get('/inquire', [UserController::class, 'inquire']);
    Route::get('/numberInquiries', [UserController::class, 'numberInquiries']);

});
