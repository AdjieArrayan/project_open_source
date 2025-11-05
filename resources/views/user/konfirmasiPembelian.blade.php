@extends('mainUser')

@section('title', '')

@section('breadcrumbs')
<main id="main" class="main">
  <div class="pagetitle text-center">
    <h1>Tentukan Pesanan Anda</h1>
    <br>
  </div>
@endsection

@section('content')
<section class="section dashboard" style="min-height: 85vh;">
  <div class="row justify-content-center">
    @foreach($selectedMenus as $menu)
    <div class="col-12 mb-4">
      <div class="card shadow-sm border-0 mx-auto" style="width: 100%; max-width: 1500px;">
        <div class="row g-0 align-items-center p-3">
          <!-- Gambar -->
          <div class="col-md-4 d-flex justify-content-center">
            <img src="{{ asset('storage/' . $menu->gambar) }}"
                 class="img-fluid rounded"
                 alt="{{ $menu->nama_menu }}"
                 style="width: 400px; height: 400px; object-fit: cover; margin-left: 20px;">
          </div>

          <!-- Detail -->
          <div class="col-md-8">
            <div class="card-body">
              <h4 class="card-title fw-bold text-success">{{ $menu->nama_menu }}</h4>
              <p class="card-text text-muted">{{ $menu->deskripsi }}</p>

              <!-- Pilihan Kemanisan -->
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label fw-semibold">Tingkat Kemanisan</label>
                <div class="col-sm-8">
                  <select class="form-select kemanisanSelect" data-id="{{ $menu->id }}" style="max-width: 250px;">
                    <option value="" selected disabled hidden>Pilih...</option>
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
                    <button class="btn btn-outline-secondary" type="button" onclick="changeCount({{ $menu->id }}, -1, {{ $menu->harga }})">-</button>
                    <input type="text" id="counter-{{ $menu->id }}" class="form-control text-center" value="1" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="changeCount({{ $menu->id }}, 1, {{ $menu->harga }})">+</button>
                  </div>
                </div>
              </div>

              <!-- Total Harga -->
              <div class="row mb-4">
                <label class="col-sm-4 col-form-label fw-semibold">Total Harga</label>
                <div class="col-sm-8 d-flex align-items-center">
                  <p class="mb-0 fw-bold fs-5 text-primary" id="totalHarga-{{ $menu->id }}" data-harga="{{ $menu->harga }}">
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Tombol Beli Semua -->
  <div class="text-center mt-4">
    <button type="button" class="btn btn-success px-5 py-2" data-bs-toggle="modal" data-bs-target="#modalBeliSemua" onclick="updateModalSemua()">
      Beli Semua
    </button>
  </div>

  <!-- Modal Konfirmasi Semua -->
  <div class="modal fade" id="modalBeliSemua" tabindex="-1" aria-labelledby="modalBeliSemuaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-success">Konfirmasi Pembelian Semua Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="modal-body">
          <table class="table table-striped align-middle text-center">
            <thead>
              <tr>
                <th>Menu</th>
                <th>Kemanisan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="modalTableBody">
              <!-- Isi dinamis via JS -->
            </tbody>
            <tfoot>
              <tr class="table-success">
                <th colspan="3" class="text-end">Total Keseluruhan:</th>
                <th id="modalTotalSemua" class="text-success fs-5 text-end">Rp 0</th>
              </tr>
            </tfoot>
          </table>
          <p class="text-center mt-3 mb-0">Apakah kamu yakin ingin membeli semua item ini?</p>
        </div>

        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

          <form id="formBeliSemua" action="{{ route('menuPembayaran') }}" method="POST">
            @csrf
            <input type="hidden" name="menus" id="menusInput">
            <button type="submit" class="btn btn-success">Ya, Beli Semua</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Script (ganti bagian script lama dengan ini) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
      // object penyimpanan: { menuId: { jumlah, kemanisan, harga } }
      const dataPembelian = {};

      // Ambil semua menu yang ada di halaman berdasarkan elemen totalHarga yang punya data-harga
      document.querySelectorAll('[id^="totalHarga-"]').forEach(el => {
        // id berupa totalHarga-<id>
        const parts = el.id.split('-');
        const id = parts[1];
        const harga = parseInt(el.dataset.harga || 0);

        dataPembelian[id] = {
          jumlah: 1,
          kemanisan: '-', // default
          harga: harga
        };

        // pastikan counter tampil 1
        const counter = document.getElementById(`counter-${id}`);
        if (counter) counter.value = 1;

        // pastikan totalHarga tampil benar (pakai format)
        el.textContent = formatRupiah(harga);
      });

      // helper format
      function formatRupiah(angka) {
        return "Rp " + angka.toLocaleString('id-ID');
      }

      // changeCount dipanggil dari tombol -/+ di setiap card
      window.changeCount = function (id, delta) {
        id = String(id);
        if (!dataPembelian[id]) {
          // safety: jika belum ada, coba dapatkan harga dari DOM
          const el = document.getElementById(`totalHarga-${id}`);
          const harga = el ? parseInt(el.dataset.harga || 0) : 0;
          dataPembelian[id] = { jumlah: 1, kemanisan: '-', harga: harga };
        }
        dataPembelian[id].jumlah = Math.max(1, (dataPembelian[id].jumlah || 1) + delta);

        // update counter input
        const counterEl = document.getElementById(`counter-${id}`);
        if (counterEl) counterEl.value = dataPembelian[id].jumlah;

        // update total per item (tampilkan)
        const totalEl = document.getElementById(`totalHarga-${id}`);
        if (totalEl) {
          const total = dataPembelian[id].jumlah * dataPembelian[id].harga;
          totalEl.textContent = formatRupiah(total);
        }
      };

      // simpan kemanisan tiap select (event delegation)
      document.querySelectorAll('.kemanisanSelect').forEach(select => {
        select.addEventListener('change', function (e) {
          const id = String(e.target.dataset.id);
          if (!dataPembelian[id]) {
            const el = document.getElementById(`totalHarga-${id}`);
            const harga = el ? parseInt(el.dataset.harga || 0) : 0;
            dataPembelian[id] = { jumlah: 1, kemanisan: '-', harga: harga };
          }
          dataPembelian[id].kemanisan = e.target.value || '-';
        });
      });

      // fungsi untuk mengisi modal "Beli Semua"
// fungsi untuk mengisi modal "Beli Semua"
window.updateModalSemua = function () {
  const tbody = document.getElementById('modalTableBody');
  if (!tbody) return;
  tbody.innerHTML = '';

  let totalKeseluruhan = 0;
  const dataKirim = [];

  const menus = @json($selectedMenus);

  menus.forEach(menu => {
    const id = String(menu.id);
    const nama = menu.nama_menu;
    const info = dataPembelian[id] || { jumlah: 1, kemanisan: '-', harga: menu.harga };
    const subtotal = (info.jumlah || 1) * (info.harga || menu.harga);
    totalKeseluruhan += subtotal;

    tbody.insertAdjacentHTML('beforeend', `
      <tr>
        <td>${escapeHtml(nama)}</td>
        <td>${escapeHtml(info.kemanisan || '-')}</td>
        <td>${info.jumlah}</td>
        <td>${formatRupiah(subtotal)}</td>
      </tr>
    `);

    dataKirim.push({
  id: id,
  kemanisan: info.kemanisan || '-',
  jumlah: info.jumlah || 1,
  subtotal: subtotal,
  harga: info.harga, // optional
});

  });

  const totalEl = document.getElementById('modalTotalSemua');
  if (totalEl) totalEl.textContent = formatRupiah(totalKeseluruhan);

  const menusInput = document.getElementById('menusInput');
  if (menusInput) menusInput.value = JSON.stringify(dataKirim);
};


      // small helper untuk mencegah XSS pada nama (karena kita memasukkan nama via JS)
      function escapeHtml(unsafe) {
        return String(unsafe)
          .replace(/&/g, "&amp;")
          .replace(/</g, "&lt;")
          .replace(/>/g, "&gt;")
          .replace(/"/g, "&quot;")
          .replace(/'/g, "&#039;");
      }
    });
    </script>

</main>
</section>
@endsection
