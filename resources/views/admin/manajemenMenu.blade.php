@extends('mainUser')

@section('title', 'Manajemen Penjualan')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Manajemen Role</h1>
            <p class="text-muted">Kelola hak akses dan data pengguna</p>
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

    <section class="section dashboard">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Daftar Pengguna</h5>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-success text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Deskripi</th>
                                <th>Role</th>
                                <th>Password (Opsional)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                            <tr>
                                {{-- Form Update --}}
                                <form action="{{ route('admin.role.update', $user->id) }}" method="POST">
                                    @csrf
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><input type="text" name="name" value="{{ $user->name }}" class="form-control" required></td>
                                    <td><input type="email" name="email" value="{{ $user->email }}" class="form-control" required></td>
                                    <td>
                                        <select name="role" class="form-select" required>
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="btn btn-sm btn-success mb-1 w-100">Simpan</button>
                                </form>

                                {{-- Form Delete (harus di luar form update) --}}
                                <form action="{{ route('admin.role.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Hapus</button>
                                </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
