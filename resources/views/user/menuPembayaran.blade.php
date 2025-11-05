@extends('mainUser')

@section('title', '')

@section('breadcrumbs')
<main id="main" class="main">
  <div class="pagetitle text-center">
    <h1>Pilih Metode Pembayaran</h1>
    <p class="text-muted fs-5">Total yang harus dibayar: <span class="fw-bold text-success">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
    <br>
  </div>
@endsection

@section('content')
<section class="section">
  <div class="row">

    <!-- Card Cashless -->
    <div class="col-lg-6">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title mb-3">Cashless</h5>
          <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
            <form action="{{ route('menuCashless') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-link">
                <i class="bi bi-credit-card-2-front-fill text-primary" style="font-size: 8rem;"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Card Cash -->
    <div class="col-lg-6">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title mb-3">Cash</h5>
          <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
            <form action="{{ route('menuCash') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-link">
                <i class="bi bi-cash-stack text-success" style="font-size: 8rem;"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
</section>
@endsection
