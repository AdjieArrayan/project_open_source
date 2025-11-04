@extends('mainUser')

@section('title', '')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Edit Menu</h1>
        <p class="text-muted">Perbarui informasi menu yang sudah ada</p>
    </div>
@endsection

@section('content')

<section class="section dashboard">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('update.menu', $menu->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Menu</label>
                    <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required>{{ $menu->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga</label>
                    <input type="number" name="harga" value="{{ $menu->harga }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Menu</label>
                    <input type="file" name="gambar" class="form-control">
                    @if($menu->gambar)
                        <img src="{{ asset('storage/'.$menu->gambar) }}" width="100" class="mt-2 rounded">
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('manajemen.menu') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</main>
</section>
@endsection
