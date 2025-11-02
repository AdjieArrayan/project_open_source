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
      <div class="row">

        <!-- Total Penjualan -->
        <div class="col-lg-3 col-md-6">
          <div class="card info-card sales-card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Total Penjualan</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                  <i class="bi bi-cash-stack text-success fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>Rp 2.450.000</h6>
                  <span class="text-success small pt-1 fw-bold">+12%</span>
                  <span class="text-muted small pt-2 ps-1">dari minggu lalu</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Penjualan -->

        <!-- Transaksi Hari Ini -->
        <div class="col-lg-3 col-md-6">
          <div class="card info-card revenue-card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Transaksi Hari Ini</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                  <i class="bi bi-cart-check text-success fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>32</h6>
                  <span class="text-success small pt-1 fw-bold">+5</span>
                  <span class="text-muted small pt-2 ps-1">transaksi baru</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Transaksi Hari Ini -->

        <!-- Produk Terlaris -->
        <div class="col-lg-3 col-md-6">
          <div class="card info-card customers-card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Produk Terlaris</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                  <i class="bi bi-star-fill text-success fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>Cendol Original</h6>
                  <span class="text-muted small pt-2 ps-1">120 penjualan</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Produk Terlaris -->

        <!-- Pendapatan Bulan Ini -->
        <div class="col-lg-3 col-md-6">
          <div class="card info-card customers-card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Pendapatan Bulan Ini</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                  <i class="bi bi-graph-up text-success fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>Rp 7.800.000</h6>
                  <span class="text-muted small pt-2 ps-1">update terakhir hari ini</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Pendapatan Bulan Ini -->

      </div><!-- End Summary Row -->

      <!-- Aktivitas / Penjualan Terbaru -->
      <div class="card recent-sales overflow-auto shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Penjualan Terbaru</h5>

          <table class="table table-borderless datatable">
            <thead class="table-success">
              <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total Harga</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2025-11-01</td>
                <td>Cendol Original</td>
                <td>3</td>
                <td>Rp 15.000</td>
              </tr>
              <tr>
                <td>2025-11-01</td>
                <td>Es Dawet</td>
                <td>2</td>
                <td>Rp 10.000</td>
              </tr>
              <tr>
                <td>2025-10-31</td>
                <td>Cendol Durian</td>
                <td>5</td>
                <td>Rp 40.000</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div><!-- End Aktivitas -->

    </section>

  </main><!-- End #main -->

@endsection
