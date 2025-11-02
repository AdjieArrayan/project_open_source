@extends('mainUser')

@section('title', 'Pembayaran Cash')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Berikut Pesanan Anda</h1>
    </div>
@endsection

@section('content')
<section class="section d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 150px);">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body text-center">

            <!-- Logo -->
            <img src="{{ asset('style/assets/img/lilith.png') }}" alt="Logo" class="mb-2" style="width: 60px; height: 60px; object-fit: contain;">

            <h5 class="card-title fw-bold mb-2 text-success">CendolNada</h5>
            <p class="text-muted mb-3" style="font-size: 14px;">Jl. Mawar No. 12, Karawang</p>
            <hr>

            <p class="text-muted" style="font-size: 13px;">{{ date('d M Y, H:i') }}</p>
            <div class="text-start">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td>Cendol Original</td>
                            <td class="text-center">4x</td>
                            <td class="text-end">Rp 24.000</td>
                        </tr>
                        <tr>
                            <td>Es Lemon Segar</td>
                            <td class="text-center">1x</td>
                            <td class="text-end">Rp 10.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total</strong>
                <strong>Rp 34.000</strong>
            </div>
            <p class="mt-1 text-muted" style="font-size: 13px;">Metode: Cash</p>

            <button type="button" class="btn btn-success w-100 mt-3" data-bs-toggle="modal" data-bs-target="#successModal">
                Konfirmasi Pembayaran
            </button>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
            <div class="modal-body">
                <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                <h5>Pembayaran Berhasil</h5>
                <p class="text-muted">Transaksi telah diselesaikan.</p>
                <a href="menuPenjualan">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
