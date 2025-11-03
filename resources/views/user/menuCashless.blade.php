@extends('mainUser')

@section('title', 'Pembayaran Cashless')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Silahkan Scan Kode QR di bawah ini</h1>
    </div>
@endsection

@section('content')

<section class="section d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm border-0" style="max-width: 400px;">
        <div class="card-body text-center">
            <h5 class="card-title mb-3 fw-semibold">QRIS Pembayaran</h5>

            <!-- Gambar QR -->
            <img src="{{ asset('style/assets/img/QRIS.png') }}"
                 alt="QRIS"
                 class="img-fluid rounded"
                 style="width: 100%; height: auto; border-radius: 12px;">

            <p class="mt-3 text-muted small mb-3">
                Silakan scan untuk melanjutkan pembayaran.
            </p>

            <!-- Button -->
            <button type="button" class="btn btn-success w-100 mt-3" data-bs-toggle="modal" data-bs-target="#confirmModal">
                Konfirmasi Pembayaran
            </button>

            <!-- Modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center p-3">
                        <div class="modal-body">
                            <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                            <h5>Pembayaran Berhasil</h5>
                            <p class="text-muted">Transaksi QRIS telah diselesaikan.</p>
                            <form action="{{ route('konfirmasiCashless') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Tutup & Simpan Transaksi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


@endsection

<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}
</style>
