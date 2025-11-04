@extends('mainUser')

@section('title', '')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Manajemen Menu</h1>
        <p class="text-muted">Kelola daftar menu yang tersedia</p>
        <br>
    </div>
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
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                <h5 class="card-title mb-0">Daftar Menu</h5>
                <a href="{{ route('tambah.menu') }}" class="btn btn-success">
                    + Tambah Menu
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Menu</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $index => $menu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/'.$menu->gambar) }}" width="60" height="60" class="rounded">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $menu->nama_menu }}</td>
                            <td>{{ Str::limit($menu->deskripsi, 40) }}</td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('edit.menu', $menu->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                                <form id="delete-form-{{ $menu->id }}"  action="{{ route('hapus.menu', $menu->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal"
                                        data-form-id="{{ $menu->id }}">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</section>

{{-- Modal konfirmasi hapus --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus menu ini? Data tidak dapat dikembalikan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let formToDelete = null;

        // Ketika tombol Hapus di baris diklik — simpan referensi form (atau id)
        document.querySelectorAll('[data-bs-target="#confirmDeleteModal"]').forEach(function(button) {
            button.addEventListener('click', function () {
                const id = button.getAttribute('data-form-id');
                // Cari form by id yang sudah kita pasang di template
                formToDelete = document.getElementById('delete-form-' + id);
            });
        });

        // Tombol konfirmasi modal: submit form yang sudah disimpan
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function () {
                if (formToDelete) {
                    formToDelete.submit();
                } else {
                    // fallback debugging: coba cari form by attribute
                    console.warn('Tidak menemukan form delete yang akan disubmit.');
                }
            });
        }
    });
    </script>

@endsection
