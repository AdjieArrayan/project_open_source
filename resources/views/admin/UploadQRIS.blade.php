@extends('mainUser')

@section('title', '')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Upload QRIS</h1>
        <p class="text-muted">Unggah kode QRIS untuk pembayaran cashless</p> <br>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card shadow-sm border-0" style="max-width: 600px; margin:auto;">
        <div class="card-body text-center">
            <h5 class="card-title fw-semibold">QRIS Anda</h5>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($fileExists)
            <img src="{{ asset('uploads/qris/QRIS.png') }}?v={{ time() }}"
                alt="QRIS"
                class="img-fluid rounded mb-3"
                style="width: 100%; border-radius: 12px;">
            @else
                <img src="{{ asset('style/assets/img/QRIS.png') }}"
                    alt="QRIS Default"
                    class="img-fluid rounded mb-3"
                    style="width: 100%; border-radius: 12px;">
            @endif


            <form action="{{ route('store.qris') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="mb-3">
                    <input type="file" name="qris_image" class="form-control" accept="image/*" required>
                    @error('qris_image')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-upload me-2"></i>Upload QRIS Baru
                </button>
            </form>
        </div>
    </div>
</main>
</section>
@endsection