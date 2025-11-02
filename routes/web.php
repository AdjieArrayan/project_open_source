<?php

use Illuminate\Support\Facades\Route;

//Route Login

    Route::get('/login', function () {
        return view('auth/login');
    });

    Route::get('/register', function () {
        return view('auth/register');
    });

//Buat Admin

//Buat User/Karyawan

    Route::get('/', function () {
        return view('mainUser');
    });

    Route::get('/dashboard', function () {
        return view('user/dashboard');
    });

    Route::get('/menuPenjualan', function () {
        return view('user/menuPenjualan');
    });

    Route::get('/menuPenjualan2', function () {
        return view('user/menuPenjualan2');
    });

    Route::get('/konfirmasiPembelian', function () {
        return view('user/konfirmasiPembelian');
    });

    Route::get('/menuPembayaran', function () {
        return view('user/menuPembayaran');
    });

    Route::get('/menuCashless', function () {
        return view('user/menuCashless');
    });

    Route::get('/menuCash', function () {
        return view('user/menuCash');
    });