@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Pilih Metode Pembayaran</h1> <br>
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
                        <a href="menuCashless">
                            <i class="bi bi-credit-card-2-front-fill text-primary" style="font-size: 8rem;"></i>
                        </a>
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
                        <a href="menuCash">
                            <i class="bi bi-cash-stack text-success" style="font-size: 8rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection