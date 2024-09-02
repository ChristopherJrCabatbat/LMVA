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

require __DIR__ . '/auth.php';


// Admin Routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    // Dashboard Controller
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboardSearch', [AdminController::class, 'dashboardSearch'])->name('dashboardSearch');
    Route::get('/dashboardAdd', [AdminController::class, 'dashboardAdd'])->name('dashboardAdd');
    Route::post('/dashboardStore', [AdminController::class, 'dashboardStore'])->name('dashboardStore');

    // Accounts Controller
    Route::get('/accounts', [AdminController::class, 'accounts'])->name('accounts');
    Route::get('/accountsStaffSearch', [AdminController::class, 'accountsStaffSearch'])->name('accountsStaffSearch');
    Route::get('/accountsUserSearch', [AdminController::class, 'accountsUserSearch'])->name('accountsUserSearch');
    Route::get('/accountsAddStaff', [AdminController::class, 'accountsAddStaff'])->name('accountsAddStaff');
    Route::post('/accountsAddStaffStore', [AdminController::class, 'accountsAddStaffStore'])->name('accountsAddStaffStore');
    Route::get('/accountsAddUser', [AdminController::class, 'accountsAddUser'])->name('accountsAddUser');
    Route::post('/accountsAddUserStore', [AdminController::class, 'accountsAddUserStore'])->name('accountsAddUserStore');

    Route::get('accountsUserShow/{id}', [AdminController::class, 'accountsUserShow'])->name('accountsUserShow');
    Route::get('accountsStaffShow/{id}', [AdminController::class, 'accountsStaffShow'])->name('accountsStaffShow');
    Route::get('accountsEdit/{id}/edit', [AdminController::class, 'accountsEdit'])->name('accountsEdit');
    Route::put('accountsUpdate/{id}', [AdminController::class, 'accountsUpdate'])->name('accountsUpdate');
    Route::delete('/accountDestroy/{id}', [AdminController::class, 'accountDestroy'])->name('accountDestroy');


    // Derm Controller
    Route::get('/derm', [AdminController::class, 'derm'])->name('derm');
    Route::get('/dermSearch', [AdminController::class, 'dermSearch'])->name('dermSearch');
    Route::get('/dermAdd', [AdminController::class, 'dermAdd'])->name('dermAdd');
    Route::post('/dermStore', [AdminController::class, 'dermStore'])->name('dermStore');
    Route::get('/dermShow/{derm}', [AdminController::class, 'dermShow'])->name('dermShow');


    // Reports Controller
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});


// Staff Routes
Route::group([
    'prefix' => 'staff',
    'as' => 'staff.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    Route::get('/patientRecord', [StaffController::class, 'patientRecord'])->name('patientRecord');
    Route::post('/patientRecordCategorize', [StaffController::class, 'patientRecordCategorize'])->name('patientRecordCategorize');

    Route::get('/derm', [StaffController::class, 'scan'])->name('derm');
    Route::get('/dermShow/{derm}', [StaffController::class, 'scanShow'])->name('dermShow');

    Route::get('/inquiry', [StaffController::class, 'inquiry'])->name('inquiry');
    Route::get('/inquiryRespond/{id}', [StaffController::class, 'inquiryRespond'])->name('inquiryRespond');
    Route::post('/inquiryRespondStore/{id}', [StaffController::class, 'inquiryRespondStore'])->name('inquiryRespondStore');
});


// User Routes
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth', 'verified', 'login'],
], function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboardResponse/{id}', [UserController::class, 'dashboardResponse'])->name('dashboardResponse');

    // Inquiry Routes
    Route::get('/inquire', [UserController::class, 'inquire'])->name('inquire');
    Route::get('/inquireAdd', [UserController::class, 'inquireAdd'])->name('inquireAdd');
    Route::post('/inquireStore', [UserController::class, 'inquireStore'])->name('inquireStore');

    Route::get('/numberInquiries', [UserController::class, 'numberInquiries'])->name('numberInquiries');
    Route::get('/numberInquiriesHistory/{id}', [UserController::class, 'numberInquiriesHistory'])->name('numberInquiriesHistory');
});
