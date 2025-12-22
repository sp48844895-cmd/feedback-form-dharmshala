<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;

// Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public feedback form page (accessible to all)
Route::get('/', [FeedbackController::class, 'index'])->name('feedback.index');

// Store feedback (public)
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Admin routes (protected - admin only)
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [FeedbackController::class, 'list'])->name('admin.list');
    Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show'])->name('admin.feedback.show');
    Route::get('/report', [FeedbackController::class, 'report'])->name('report');
});
