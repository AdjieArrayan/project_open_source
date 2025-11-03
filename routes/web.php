<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PenjualanController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard — semua user
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/menuPenjualan', [MenuController::class, 'index']);
});

// Hanya admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/management', [PenjualanController::class, 'index']);
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