<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('register','register')->name('register');
    Route::Post('register','registerSave')->name('register.save');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerSave'])->name('register.save');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AuthController::class, 'admin'])->name('admin');
    Route::get('/home', [AuthController::class, 'home'])->name('home');
});

Route::get('/employees', [AuthController::class, 'index'])->name('employee');
Route::get('/employees/{id}', [AuthController::class, 'show']);
Route::post('/employees', [AuthController::class, 'store']);
Route::put('/employees/{id}', [AuthController::class, 'update']);
Route::delete('/employees/{id}', [AuthController::class, 'destroy'])->name('employees.destroy');

Route::get('/leave-request', [AuthController::class, 'leaveform'])->name('leave');
Route::post('/leave-request', [AuthController::class, 'leavestore'])->name('leave-store');

Route::get('/admin/leave-requests', [AuthController::class, 'viewAll'])->name('admin.leave-requests');
Route::post('/admin/leave-requests/{id}', [AuthController::class, 'updateStatus'])->name('admin.leave-requests.update');
