@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Selamat Datang di Cendol Nada</h1>
        <h1>Silahkan Pilih Menu Anda</h1><br>
    </div>
@endsection

@section('content')
<section class="section dashboard">
    <div class="row">

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="menu-card">
                <a href="konfirmasiPembelian" class="menu-link">
                    <div class="menu-image">
                        <img src="{{ asset('style/assets/img/cendol.png') }}" alt="Cendol Original">
                    </div>
                    <div class="menu-info">
                        <h6>Cendol Original</h6>
                        <p class="menu-price">Rp 6.000</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="menu-card">
                <a href="konfirmasiPembelian" class="menu-link">
                    <div class="menu-image">
                        <img src="{{ asset('style/assets/img/cendol.png') }}" alt="Cendol Original">
                    </div>
                    <div class="menu-info">
                        <h6>Cendol Original</h6>
                        <p class="menu-price">Rp 6.000</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="menu-card">
                <a href="konfirmasiPembelian" class="menu-link">
                    <div class="menu-image">
                        <img src="{{ asset('style/assets/img/cendol.png') }}" alt="Cendol Original">
                    </div>
                    <div class="menu-info">
                        <h6>Cendol Original</h6>
                        <p class="menu-price">Rp 6.000</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="menu-card">
                <a href="konfirmasiPembelian" class="menu-link">
                    <div class="menu-image">
                        <img src="{{ asset('style/assets/img/cendol.png') }}" alt="Cendol Original">
                    </div>
                    <div class="menu-info">
                        <h6>Cendol Original</h6>
                        <p class="menu-price">Rp 6.000</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="menu-card">
                <a href="konfirmasiPembelian" class="menu-link">
                    <div class="menu-image">
                        <img src="{{ asset('style/assets/img/cendol.png') }}" alt="Cendol Original">
                    </div>
                    <div class="menu-info">
                        <h6>Cendol Original</h6>
                        <p class="menu-price">Rp 6.000</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="menu-card">
                <a href="konfirmasiPembelian" class="menu-link">
                    <div class="menu-image">
                        <img src="{{ asset('style/assets/img/cendol.png') }}" alt="Cendol Original">
                    </div>
                    <div class="menu-info">
                        <h6>Cendol Original</h6>
                        <p class="menu-price">Rp 6.000</p>
                    </div>
                </a>
            </div>
        </div>

@endsection

    <style>
        .menu-card {
            border: none;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        }

        .menu-link {
            text-decoration: none;
            color: inherit;
        }

        .menu-image {
            width: 100%;
            height: 230px;
            overflow: hidden;
        }

        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .menu-card:hover img {
            transform: scale(1.05);
        }

        .menu-info {
            padding: 14px;
            text-align: center;
            background: #f9fafb;
        }

        .menu-info h6 {
            font-weight: 600;
            color: #2b2b2b;
            margin: 0;
        }

        .menu-price {
            margin-top: 6px;
            font-size: 15px;
            font-weight: 600;
            color: #0077b6;
        }

    </style>
