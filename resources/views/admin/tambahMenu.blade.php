@extends('mainUser')

@section('title', '')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Tambah Menu Baru</h1>
        <p class="text-muted">Masukkan informasi menu yang ingin ditambahkan</p>
    </div>
@endsection

@section('content')

<section class="section dashboard">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('simpan.menu') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Menu</label>
                    <input type="text" name="nama_menu" class="form-control" placeholder="Masukkan nama menu" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi menu" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan harga menu" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Menu</label>
                    <input type="file" name="gambar" class="form-control" id="gambarInput">
                    <img id="previewGambar" src="#" alt="Preview Gambar" class="mt-2 rounded d-none" width="100">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('manajemen.menu') }}" class="btn btn-secondary">Kembali</a>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmSaveModal">Simpan Menu Baru</button>
                </div>

                {{-- Modal konfirmasi simpan --}}
                <div class="modal fade" id="confirmSaveModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-success">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title">Konfirmasi Simpan</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Apakah kamu yakin ingin menyimpan menu baru ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Ya, Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
</section>

<script>
    // Preview gambar sebelum upload
    document.getElementById('gambarInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewGambar');
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.classList.add('d-none');
        }
    });
</script>
@endsection
