<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;


use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login-proses', [AuthController::class, 'login'])->name('login.process');
Route::post('/register/store', [AuthController::class, 'store'])->name('register.store');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/booking', [PenyewaanController::class, 'createUser'])->name('booking');

Route::middleware('auth')->group(function () {

    Route::get('/penyewaan/show/{id}', [PenyewaanController::class, 'show'])->name('penyewaan.show');
    Route::get('/penyewaan/create', [PenyewaanController::class, 'create'])->name('penyewaan.create');
    Route::get('/penyewaan/edit/{id}', [PenyewaanController::class, 'edit'])->name('penyewaan.edit');
    Route::put('/penyewaan/update/{id}', [PenyewaanController::class, 'update'])->name('penyewaan.update');
    Route::post('/penyewaan', [PenyewaanController::class, 'store'])->name('penyewaan.store');
    Route::delete('/penyewaan/destroy/{id}', [PenyewaanController::class, 'destroy'])->name('penyewaan.destroy');
    Route::put('/penyewaan/update-status/{id}', [PenyewaanController::class, 'updateStatus'])->name('penyewaan.updateStatus');
    Route::put('/penyewaan/cancel/{id}', [PenyewaanController::class, 'cancel'])->name('penyewaan.cancel');
    // Route::resource('penyewaan', PenyewaanController::class);



    Route::middleware(['auth', 'Admin'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/lapangan', [LapanganController::class, 'index'])->name('lapangan.index');
        Route::get('/lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
        Route::post('/lapangan/store', [LapanganController::class, 'store'])->name('lapangan.store');
        Route::get('/lapangan/edit/{id}', [LapanganController::class, 'edit'])->name('lapangan.edit');
        Route::put('/lapangan/update/{id}', [LapanganController::class, 'update'])->name('lapangan.update');
        Route::delete('/lapangan/destroy/{id}', [LapanganController::class, 'destroy'])->name('lapangan.destroy');

        Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
        Route::delete('/pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

        Route::get('/penyewaan', [PenyewaanController::class, 'index'])->name('penyewaan.index');
        Route::get('/penyewaan/berhasil', [PenyewaanController::class, 'getSuccess'])->name('penyewaan.berhasil');
        Route::get('/penyewaan/berjalan', [PenyewaanController::class, 'getPlay'])->name('penyewaan.berjalan');
        Route::get('/penyewaan/menunggu', [PenyewaanController::class, 'getWait'])->name('penyewaan.menunggu');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
