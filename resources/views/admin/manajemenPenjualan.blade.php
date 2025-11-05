@extends('mainUser')

@section('title', '')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Manajemen Penjualan</h1>
        <p class="text-muted">Pantau performa penjualan harian dan bulanan</p> <br>
    </div>
@endsection

@section('content')
<section class="section dashboard">

    <!-- Ringkasan Cepat -->
    <div class="row mb-4">

        <div class="col-lg-4 col-md-6">
            <div class="card info-card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                            <i class="bi bi-receipt text-success fs-4"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $totalTransaksi }} Transaksi</h6>
                            <span class="text-muted small">Sepanjang waktu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card info-card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                            <i class="bi bi-currency-dollar text-success fs-4"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                            <span class="text-muted small">Sepanjang waktu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card info-card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Produk Terjual</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                            <i class="bi bi-box-seam text-success fs-4"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $totalProdukTerjual }} Item</h6>
                            <span class="text-muted small">Total seluruh waktu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabel 10 Transaksi Terakhir -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">10 Penjualan Terakhir</h5>

            <table class="table table-borderless align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualanTerakhir as $trx)
                        @foreach ($trx->details as $detail)
                            <tr>
                                <td>{{ $trx->tanggal_transaksi->format('d M Y') }}</td>
                                <td>{{ $detail->menu->nama_menu ?? '-' }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                <td>{{ strtoupper($trx->metode_pembayaran) }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="card-title">Tambahkan Menu QRIS Anda</h5>
            <p class="text-muted small">Upload Foto QRISmu untuk menambahkan metode pembayaran cashless.</p>

            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('upload.qris') }}" class="btn btn-success">
                    <i class="bi bi-qr-code me-2"></i>Upload QRIS
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="card-title">Rekap Penjualan</h5>
            <p class="text-muted small">Klik tombol di bawah untuk melihat rekap.</p>

            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('rekap.harian') }}" class="btn btn-success">
                  <i class="bi bi-calendar-day me-2"></i>Rekap Harian
                </a>
                <a href="{{ route('rekap.bulanan') }}" class="btn btn-success">
                  <i class="bi bi-calendar3 me-2"></i>Rekap Bulanan
                </a>
              </div>


            <div id="hasilRekap" class="p-3 border rounded bg-light d-none">
                <h6 class="fw-bold text-success">Hasil Rekap:</h6>
                <p id="rekapText" class="mb-0"></p>
            </div>
        </div>
    </div>
</main>
</section>
@endsection
