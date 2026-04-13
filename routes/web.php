<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepalaKeluargaAuthController;
use App\Http\Controllers\KepalaKeluargaController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User Management Routes
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

// User Dashboard Route (untuk user regular)
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware('auth')->name('dashboard');

// Kepala Keluarga Routes (Session-based)
Route::prefix('keluarga')->group(function () {
    Route::get('/login', [KepalaKeluargaAuthController::class, 'login'])->name('keluarga.login');
    Route::post('/authenticate', [KepalaKeluargaAuthController::class, 'authenticate'])->name('keluarga.authenticate');
});

Route::middleware('kepala_keluarga')->prefix('keluarga')->group(function () {
    Route::get('/dashboard', [KepalaKeluargaController::class, 'dashboard'])->name('keluarga.dashboard');
    Route::get('/anggota', [KepalaKeluargaController::class, 'anggota'])->name('keluarga.anggota');
    Route::get('/riwayat', [KepalaKeluargaController::class, 'riwayat'])->name('keluarga.riwayat');
    Route::post('/logout', [KepalaKeluargaAuthController::class, 'logout'])->name('keluarga.logout');
});
