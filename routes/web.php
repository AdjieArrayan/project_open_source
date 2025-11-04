<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ManajemenPenjualanController;
use App\Http\Controllers\ManajemenRoleController;
use App\Http\Controllers\Admin\RekapExportController;
// Auth Routes

    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard — semua user
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/menu-penjualan', [PenjualanController::class, 'index'])->name('menuPenjualan');
        Route::post('/konfirmasi-pembelian', [PenjualanController::class, 'konfirmasiPembelian'])->name('konfirmasiPembelian');
        Route::post('/menu-pembayaran', [PenjualanController::class, 'menuPembayaran'])->name('menuPembayaran');
        Route::post('/menu-cash', [PenjualanController::class, 'menuCash'])->name('menuCash');
        Route::post('/menu-cashless', [PenjualanController::class, 'menuCashless'])->name('menuCashless');
        Route::post('/konfirmasi-cashless', [PenjualanController::class, 'konfirmasiCashless'])->name('konfirmasiCashless');
});

// Hanya untuk admin

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/manajemen-penjualan', [ManajemenPenjualanController::class, 'index'])->name('manajemen.penjualan');
    Route::get('/rekap/harian', [RekapExportController::class, 'exportHarian'])->name('rekap.harian');
    Route::get('/rekap/bulanan', [RekapExportController::class, 'exportBulanan'])->name('rekap.bulanan');

    Route::get('/manajemen-role', [ManajemenRoleController::class, 'index'])->name('manajemen.role');
    Route::post('/manajemen-role/update/{id}', [ManajemenRoleController::class, 'update'])->name('admin.role.update');
    Route::delete('/manajemen-role/delete/{id}', [ManajemenRoleController::class, 'destroy'])->name('admin.role.delete');

});






//Route Login

    // Route::get('/login', function () {
    //     return view('auth/login');
    // });

    // Route::get('/register', function () {
    //     return view('auth/register');
    // });

//Buat Admin

    // Route::get('/manajemenPenjualan', function () {
    //     return view('admin/manajemenPenjualan');
    // });

//Buat User/Karyawan

    // Route::get('/', function () {
    //    return view('mainUser');
    // });

    // Route::get('/dashboard', function () {
    //    return view('user/dashboard');
    // });

    // Route::get('/menuPenjualan', function () {
    //     return view('user/menuPenjualan');
    // });

    // Route::get('/menuPenjualan2', function () {
    //     return view('user/menuPenjualan2');
    // });

    // Route::get('/konfirmasiPembelian', function () {
    //     return view('user/konfirmasiPembelian');
    // });

    // Route::get('/menuPembayaran', function () {
    //     return view('user/menuPembayaran');
    // });

    // Route::get('/menuCashless', function () {
    //     return view('user/menuCashless');
    // });

    // Route::get('/menuCash', function () {
    //     return view('user/menuCash');
    // });