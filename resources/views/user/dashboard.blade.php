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
                <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Total Penjualan</h5>

                <!-- Tombol 3 titik -->
                <div class="dropdown">
                    <button class="btn btn-light btn-sm border-0" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item {{ $periode == 'hari' ? 'active fw-bold' : '' }}"
                        href="{{ route('dashboard', ['periode' => 'hari']) }}">
                        Hari Ini
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $periode == 'minggu' ? 'active fw-bold' : '' }}"
                        href="{{ route('dashboard', ['periode' => 'minggu']) }}">
                        7 Hari Terakhir
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $periode == 'dua_minggu' ? 'active fw-bold' : '' }}"
                        href="{{ route('dashboard', ['periode' => 'dua_minggu']) }}">
                        14 Hari Terakhir
                        </a>
                    </li>
                    </ul>
                </div>
                </div>

                <div class="d-flex align-items-center mt-3">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:50px; height:50px;">
                    <i class="bi bi-cash-stack text-success fs-4"></i>
                </div>
                <div class="ps-3">
                    <h6>Rp {{ number_format($totalPeriode, 0, ',', '.') }}</h6>
                    @if ($persentasePeningkatan >= 0)
                    <span class="text-success small pt-1 fw-bold">+{{ number_format($persentasePeningkatan, 1) }}%</span>
                    @else
                    <span class="text-danger small pt-1 fw-bold">{{ number_format($persentasePeningkatan, 1) }}%</span>
                    @endif
                    <span class="text-muted small pt-2 ps-1">
                    dari {{ $labelPeriode == 'Hari Ini' ? 'kemarin' : 'periode sebelumnya' }}
                    </span>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- End Total Penjualan -->

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
                  <h6>{{ $transaksiHariIni }}</h6>
                  <span class="text-success small pt-1 fw-bold">+5</span>
                  <span class="text-muted small pt-2 ps-1">transaksi baru</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Transaksi Hari Ini -->

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
                    @if($produkTerlaris)
                    <h6>{{ $produkTerlaris->menu->nama_menu }}</h6>
                    <span class="text-muted small pt-2 ps-1">{{ $produkTerlaris->total_terjual }} penjualan</span>
                  @else
                    <h6>-</h6>
                    <span class="text-muted small pt-2 ps-1">Belum ada data</span>
                  @endif
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
                  <h6>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h6>
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
            <h5 class="card-title">Penjualan Terbaru
                <small class="text-muted">(menampilkan {{ $penjualanTerbaru->count() }} data)</small>
            </h5>


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
                @forelse($penjualanTerbaru as $item)
                  <tr>
                    <td>{{ \Carbon\Carbon::parse($item->transaction->tanggal_transaksi)->format('Y-m-d') }}</td>
                    <td>{{ $item->menu->nama_menu }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center">Belum ada data penjualan</td>
                  </tr>
                @endforelse
            </tbody>
          </table>

        </div>
      </div><!-- End Aktivitas -->

    </section>

  </main><!-- End #main -->

@endsection
