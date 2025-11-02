@extends('mainUser')

@section('title', 'Dashboard')

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
            <img src="{{ asset('style/assets/img/QRIS.png') }}"
                 alt="QRIS"
                 class="img-fluid rounded"
                 style="width: 100%; height: auto; border-radius: 12px;">
            <p class="mt-3 text-muted small mb-0">Silakan scan untuk melanjutkan pembayaran.</p>
        </div>
    </div>
</section>

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
