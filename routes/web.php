<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
Route::post('/leads/{id}/convert', [ LeadsController::class, 'convert']);



Route::post('/deals/{deal}/comments', [CommentController::class, 'store']);
Route::post('/deals/{deal}/tasks', [TaskController::class, 'store']);



});
require __DIR__.'/auth.php';
