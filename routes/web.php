<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

    Route::get('/dashboard', [LoginController::class, 'admin']);

});


// Staff Routes
Route::group([
    'prefix' => 'staff', 'as' => 'staff.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    Route::get('/dashboard', [LoginController::class, 'staff']);

});


// User Routes
Route::group([
    'prefix' => 'user', 'as' => 'user.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    Route::get('/dashboard', [LoginController::class, 'user']);    
    Route::get('/inquire', [LoginController::class, 'inquire']);

});
