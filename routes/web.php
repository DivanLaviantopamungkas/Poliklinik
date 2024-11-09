<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeriksaKontroller;
use App\Http\Controllers\RegisterController;
// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Rute-rute yang hanya bisa diakses oleh pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Data Pasien
    Route::get('/data-pasien', [PasienController::class, 'index'])->name('data.pasien');
    Route::get('/data-pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/data-pasien/store', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/data-pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('/data-pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/data-pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    // Data Dokter
    Route::get('/data-dokter', [DokterController::class, 'index'])->name('data.dokter');
    Route::get('/data-dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/data-dokter/store', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/data-dokter/{id}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter-pasien/{id}', [DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/data-dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');

    // Periksa
    Route::get('/periksa', [PeriksaKontroller::class, 'index'])->name('periksa');
    Route::get('/periksa/create', [PeriksaKontroller::class, 'create'])->name('periksa.create');
    Route::post('/periksa/store', [PeriksaKontroller::class, 'store'])->name('periksa.store');
    Route::get('/periksa/{id}/edit', [PeriksaKontroller::class, 'edit'])->name('periksa.edit');
    Route::put('/periksa/{id}', [PeriksaKontroller::class, 'update'])->name('periksa.update');
    Route::delete('/periksa/{id}', [PeriksaKontroller::class, 'destroy'])->name('periksa.destroy');
});
