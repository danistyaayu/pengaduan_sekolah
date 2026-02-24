<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Route;

// Login routes
Route::get('/login/admin', [LoginController::class, 'showAdminLogin'])->name('login.admin');
Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('login.admin.store');

Route::get('/login/siswa', [LoginController::class, 'showSiswaLogin'])->name('login.siswa');
Route::post('/login/siswa', [LoginController::class, 'siswaLogin'])->name('login.siswa.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Change password route
Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('change-password');
Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');
Route::post('/siswa/change-password', [ChangePasswordController::class, 'update'])->name('siswa.change-password.update');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Aspirasi
    Route::get('/aspirasi', [AspirasiController::class, 'adminIndex'])->name('admin.aspirasi.index');
    Route::get('/aspirasi/{id}', [AspirasiController::class, 'adminShow'])->name('admin.aspirasi.show');
    Route::post('/aspirasi/{id}/status', [AspirasiController::class, 'adminUpdateStatus'])->name('admin.aspirasi.status');
    Route::post('/aspirasi/{id}/reply', [AspirasiController::class, 'adminReply'])->name('admin.aspirasi.reply');
    
    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('admin.students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('admin.students.store');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('admin.students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');
    Route::post('/students/{id}/reset-password', [StudentController::class, 'resetPassword'])->name('admin.students.reset-password');
    Route::post('/students/{id}/toggle-active', [StudentController::class, 'toggleActive'])->name('admin.students.toggle-active');
});

// Siswa routes
Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    
    // Aspirasi
    Route::get('/aspirasi', [AspirasiController::class, 'siswaIndex'])->name('siswa.aspirasi.index');
    Route::get('/aspirasi/create', [AspirasiController::class, 'siswaCreate'])->name('siswa.aspirasi.create');
    Route::post('/aspirasi', [AspirasiController::class, 'siswaStore'])->name('siswa.aspirasi.store');
    Route::get('/aspirasi/{id}', [AspirasiController::class, 'siswaShow'])->name('siswa.aspirasi.show');
    Route::post('/aspirasi/{id}/reply', [AspirasiController::class, 'siswaReply'])->name('siswa.aspirasi.reply');
});