@extends('mainUser')

@section('title', 'Manajemen Role')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Manajemen Role</h1>
        <p class="text-muted">Kelola hak akses dan data pengguna</p>
        <br>
    </div>
@endsection

@section('content')

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
                            <th>Email</th>
                            <th>Role</th>
                            <th>Password (Opsional)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            {{-- Form Update --}}
                            <form action="{{ route('admin.role.update', $user->id) }}" method="POST" class="update-form">
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
                                    <button type="button" class="btn btn-sm btn-success w-100 mb-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmSaveModal"
                                        data-form-id="{{ $user->id }}">
                                        Simpan
                                    </button>
                            </form>

                            {{-- Form Delete --}}
                            <form action="{{ route('admin.role.delete', $user->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"
                                    data-form-id="{{ $user->id }}">
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
</section>

{{-- === Modal Konfirmasi Simpan === --}}
<div class="modal fade" id="confirmSaveModal" tabindex="-1" aria-labelledby="confirmSaveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="confirmSaveModalLabel">Konfirmasi Simpan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menyimpan perubahan untuk user ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="confirmSaveBtn">Ya, Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- === Modal Konfirmasi Hapus === --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus user ini? Data yang dihapus tidak bisa dikembalikan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let formIdToSubmit = null;

        // Saat tombol simpan ditekan → simpan ID form
        document.querySelectorAll('[data-bs-target="#confirmSaveModal"]').forEach(button => {
            button.addEventListener('click', () => {
                formIdToSubmit = button.getAttribute('data-form-id');
            });
        });

        // Saat tombol hapus ditekan → simpan ID form
        document.querySelectorAll('[data-bs-target="#confirmDeleteModal"]').forEach(button => {
            button.addEventListener('click', () => {
                formIdToSubmit = button.getAttribute('data-form-id');
            });
        });

        // Tombol konfirmasi simpan
        document.getElementById('confirmSaveBtn').addEventListener('click', function () {
            if (formIdToSubmit) {
                document.querySelector(`form[action*="/update/${formIdToSubmit}"]`).submit();
            }
        });

        // Tombol konfirmasi hapus
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (formIdToSubmit) {
                document.querySelector(`form[action*="/delete/${formIdToSubmit}"]`).submit();
            }
        });
    });
</script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 695ff00fc8d74ed3d45b4c2880871e041b8e6c8a
