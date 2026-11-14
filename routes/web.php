<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimeLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for Clients
Route::middleware('auth')->group(function () {
Route::resource('clients', ClientController::class);
Route::resource('deals', DealController::class);
Route::resource('leads', LeadsController::class);
Route::get('/time-logs/export', [ TimeLogController::class, 'export']);
Route::resource('time-logs', TimeLogController::class);
Route::resource('leave',LeaveController::class);
Route::patch('/leave/{leave}/status', [LeaveController::class, 'updateStatus']);



Route::post('/leads/{id}/convert', [ LeadsController::class, 'convert']);



Route::post('/deals/{deal}/comments', [CommentController::class, 'store']);
Route::post('/deals/{deal}/tasks', [TaskController::class, 'store']);


// Attendance Routes 
Route:: get('/attendance',[AttendanceController::class, 'index'])->name('attendance.index');
Route:: post('/attendance/check-in',[AttendanceController::class, 'checkIn'])->name('attendance.checkIn');
Route:: post('/attendance/check-out',[AttendanceController::class, 'checkOut'])->name('attendance.checkOut');
Route::get('/settings', [ SettingController::class, 'setting']);



});
require __DIR__.'/auth.php';
