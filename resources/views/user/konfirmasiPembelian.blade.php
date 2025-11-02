@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Tentukan Pesanan Anda</h1> <br>
    </div>
@endsection

@section('content')
<section class="section dashboard" style="min-height: 85vh;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-4 shadow-sm border-0 mx-auto" style="width: 100%; max-width: 1500px;">
                <div class="row g-0 align-items-center p-3">

                    <!-- Gambar -->
                    <div class="col-md-4 d-flex justify-content-center">
                        <img src="{{ asset('style/assets/img/cendol.png') }}"
                            class="img-fluid rounded"
                            alt="Cendol Original"
                            style="width: 400px; height: 400px; object-fit: cover; margin-left: 20px;">
                    </div>

                    <!-- Detail -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title fw-bold text-success">Cendol Original</h4>
                            <p class="card-text text-muted">
                                Cendol segar dengan santan dan gula merah pilihan.
                                Nikmati sensasi manis dan gurih yang menyegarkan setiap hari.
                            </p>

                            <!-- Pilihan Kemanisan -->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label fw-semibold">Tingkat Kemanisan</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="kemanisanSelect" style="max-width: 250px;">
                                        <option selected disabled>Pilih...</option>
                                        <option value="Manis">Manis</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Non-Gula">Non-Gula</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Counter -->
                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label fw-semibold">Jumlah Pesanan</label>
                                <div class="col-sm-8">
                                    <div class="input-group" style="width: 160px;">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeCount(-1)">-</button>
                                        <input type="text" id="counter" class="form-control text-center" value="1" readonly>
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeCount(1)">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label fw-semibold">Total Harga</label>
                                <div class="col-sm-8 d-flex align-items-center">
                                <p class="mb-0 fw-bold fs-5 text-primary" id="totalHarga">Rp 6.000</p>
                                </div>
                            </div>

                            <!-- Tombol dengan modal -->
                            <div class="d-flex justify-content-center mt-5">
                                <button type="button" class="btn btn-success px-5 py-2" data-bs-toggle="modal" data-bs-target="#konfirmasiModal" onclick="updateModal()">
                                    Beli Sekarang
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                <div class="text-center mb-3">
                    <h6 class="fw-bold">Cendol Original</h6>
                    <a href="menuPembayaran">
                    <img src="{{ asset('style/assets/img/cendol.png') }}"
                        alt="Cendol Original"
                        class="img-fluid rounded"
                        style="width: 120px; height: 120px; object-fit: cover;">
                    </a>
                </div>

                <table class="table table-borderless small">
                    <tr>
                    <td class="text-start">Tingkat Kemanisan</td>
                    <td class="text-end"><span id="modalKemanisan">-</span></td>
                    </tr>
                    <tr>
                    <td class="text-start">Jumlah</td>
                    <td class="text-end"><span id="modalJumlah">1</span></td>
                    </tr>
                    <tr class="border-top">
                    <td class="text-start fw-semibold">Total Harga</td>
                    <td class="text-end fw-bold text-success" id="modalTotal">Rp 6.000</span></td>
                    </tr>
                </table>

                <p class="text-center mt-3 mb-0">Apakah kamu yakin ingin melanjutkan pembelian ini?</p>
                </div>

                <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success">Ya, Beli</button>
                </div>
            </div>
            </div>
        </div>

    </div>

    <script>
        let count = 1;
        const pricePerItem = 6000;

        function formatRupiah(angka) {
            return "Rp " + angka.toLocaleString('id-ID');
        }

        function changeCount(amount) {
            count += amount;
            if (count < 1) count = 1;
            document.getElementById('counter').value = count;
            updateTotal();
        }

        function updateTotal() {
            const total = count * pricePerItem;
            document.getElementById('totalHarga').textContent = formatRupiah(total);
        }

        function updateModal() {
            const kemanisanSelect = document.getElementById('kemanisanSelect');
            const kemanisan = kemanisanSelect.value ? kemanisanSelect.value : '-';
            const total = count * pricePerItem;

            document.getElementById('modalJumlah').textContent = count;
            document.getElementById('modalKemanisan').textContent = kemanisan;
            document.getElementById('modalTotal').textContent = formatRupiah(total);
        }
    </script>
</section>
@endsection

<style>
    .card {
        width: 100%;
        max-width: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 25px;
    }

    .card-title {
        font-size: 1.5rem;
        color: #2b2b2b;
    }

    .card-text {
        font-size: 0.95rem;
    }

    .btn {
    border-radius: 8px;
    font-size: 1rem;
    }

    .d-flex.justify-content-center {
        margin-top: 30px;
        margin-bottom: 15px;
    }

</style>
