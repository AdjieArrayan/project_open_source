@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
        </div><!-- End Page Title -->

@endsection

@section('content')

<div class="loading-page">
      <div class="img-container">
        <img src="{{ asset('/style/assets/img/lilith.png') }}" alt="Pengingat Obat" />
      </div><br>
      <div class="name-container">
        <div class="logo-name">Penyegar Dahaga Anda</div>
      </div>
</div>

<section class="section dashboard">
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
                  <h6>245 Transaksi</h6>
                  <span class="text-muted small pt-2 ps-1">Sepanjang bulan ini</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Transaksi -->

        <div class="col-lg-4 col-md-6">
          <div class="card info-card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Total Pendapatan</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                  <i class="bi bi-currency-dollar text-success fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>Rp 12.540.000</h6>
                  <span class="text-muted small pt-2 ps-1">Bulan November</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Pendapatan -->

        <div class="col-lg-4 col-md-6">
          <div class="card info-card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Produk Terjual</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                  <i class="bi bi-box-seam text-success fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>657 Item</h6>
                  <span class="text-muted small pt-2 ps-1">Total produk terjual</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Produk Terjual -->

      </div><!-- End Summary Row -->


      <!-- Tabel Penjualan Terakhir -->
      <div class="card recent-sales overflow-auto shadow-sm">
        <div class="card-body">
          <h5 class="card-title">10 Penjualan Terakhir</h5>

          <table class="table table-borderless datatable">
            <thead class="table-success">
              <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Metode Pembayaran</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2025-11-01</td>
                <td>Es Cendol Original</td>
                <td>3</td>
                <td>Rp 15.000</td>
                <td>Cash</td>
              </tr>
              <tr>
                <td>2025-11-01</td>
                <td>Cendol Durian</td>
                <td>2</td>
                <td>Rp 20.000</td>
                <td>QRIS</td>
              </tr>
              <tr>
                <td>2025-10-31</td>
                <td>Es Dawet</td>
                <td>5</td>
                <td>Rp 25.000</td>
                <td>Cash</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div><!-- End Tabel -->


      <!-- Rekap Penjualan -->
      <div class="card shadow-sm mt-4">
        <div class="card-body">
          <h5 class="card-title">Rekap Penjualan</h5>
          <p class="text-muted small">Pilih jenis rekap untuk diunduh:</p>

          <div class="d-flex flex-wrap gap-3">
            <button class="btn btn-success">
              <i class="bi bi-calendar-day me-2"></i>Rekap Harian
            </button>
            <button class="btn btn-success">
              <i class="bi bi-calendar3 me-2"></i>Rekap Bulanan
            </button>
            <button class="btn btn-outline-success">
              <i class="bi bi-download me-2"></i>Unduh Rekap (.xlsx)
            </button>
          </div>
        </div>
      </div><!-- End Rekap -->

    </section>

  </main><!-- End #main -->

@endsection
