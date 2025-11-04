@extends('mainUser')

@section('title', 'Menu Penjualan')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle text-center">
        <h1>Selamat Datang di Cendol Nada</h1>
        <h1>Silahkan Pilih Menu Anda</h1><br>
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
    <div class="row">
        @forelse($menus as $menu)
            <div class="col-xxl-4 col-md-6 mb-4">
                <div class="menu-card selectable"
                     data-id="{{ $menu->id }}"
                     data-nama="{{ $menu->nama_menu }}"
                     data-harga="{{ $menu->harga }}">
                    <div class="menu-image">
                        @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                        @else
                            <img src="{{ asset('style/assets/img/lilith.png') }}" alt="No Image">
                        @endif
                    </div>
                    <div class="menu-info">
                        <h6>{{ $menu->nama_menu }}</h6>
                        <p class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada menu tersedia</p>
            </div>
        @endforelse
    </div>
</section>

<!-- Bottom Bar (muncul saat ada produk dipilih) -->
<div id="selectedBadge" class="bottom-bar">
    <span id="selectedCount">0 produk dipilih</span>
    <button class="btn btn-success rounded-pill px-4" id="btnBuy" disabled>Beli Sekarang</button>
</div>

<!-- Form tersembunyi -->
<form id="formPembelian" action="{{ route('konfirmasiPembelian') }}" method="POST">
    @csrf
    <input type="hidden" name="menus" id="menusInput">
</form>

<style>
    /* --- Card menu --- */
    .menu-card {
        border: none;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        cursor: pointer;
    }
    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }
    .menu-card.selected {
        border: 2px solid #28a745;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.4);
    }
    .menu-image {
        width: 100%;
        height: 230px;
        overflow: hidden;
    }
    .menu-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .menu-card:hover img {
        transform: scale(1.05);
    }
    .menu-info {
        padding: 14px;
        text-align: center;
        background: #f9fafb;
    }
    .menu-info h6 {
        font-weight: 600;
        color: #2b2b2b;
        margin: 0;
    }
    .menu-price {
        margin-top: 6px;
        font-size: 15px;
        font-weight: 600;
        color: #0077b6;
    }

    /* --- Bottom bar --- */
    .bottom-bar {
        position: fixed;
        bottom: 0;
        background: #fff;
        border-radius: 16px 16px 0 0;
        box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.15);
        padding: 14px 20px;
        transition: all 0.3s ease;
        transform: translateY(100%);
        opacity: 0;
        z-index: 1050;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 16px;
    }

    .bottom-bar.show {
        transform: translateY(0);
        opacity: 1;
    }

    .bottom-bar span {
        font-weight: 600;
        color: #333;
    }

    @media (max-width: 768px) {
        .bottom-bar {
            left: 0 !important;
            width: 100% !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.querySelector('.sidebar'); // Elemen sidebar utama
        const bottomBar = document.getElementById('selectedBadge');
        const cards = document.querySelectorAll('.menu-card.selectable');
        const countSpan = document.getElementById('selectedCount');
        const buyButton = document.getElementById('btnBuy');
        const menusInput = document.getElementById('menusInput');
        const formPembelian = document.getElementById('formPembelian');
        const toggleBtn = document.querySelector('.toggle-sidebar-btn'); // tombol untuk collapse sidebar
        let selectedMenus = [];

        // Fungsi untuk update posisi bottom bar
        function updateBottomBarPosition() {
            if (!sidebar) return;

            const sidebarWidth = sidebar.offsetWidth;
            const isCollapsed = sidebar.classList.contains('collapsed') || sidebar.offsetWidth < 150;

            if (isCollapsed) {
                bottomBar.style.left = '0';
                bottomBar.style.width = '100%';
            } else {
                bottomBar.style.left = `${sidebarWidth}px`;
                bottomBar.style.width = `calc(100% - ${sidebarWidth}px)`;
            }
        }

        // Jalankan pertama kali & setiap resize
        updateBottomBarPosition();
        window.addEventListener('resize', updateBottomBarPosition);

        // Update posisi setelah sidebar ditoggle
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                setTimeout(updateBottomBarPosition, 300);
            });
        }

        // Logika pemilihan menu
        cards.forEach(card => {
            card.addEventListener('click', () => {
                const id = card.dataset.id;
                const nama = card.dataset.nama;
                const harga = card.dataset.harga;

                if (card.classList.contains('selected')) {
                    card.classList.remove('selected');
                    selectedMenus = selectedMenus.filter(item => item.id !== id);
                } else {
                    card.classList.add('selected');
                    selectedMenus.push({ id, nama, harga });
                }

                countSpan.textContent = `${selectedMenus.length} produk dipilih`;
                bottomBar.classList.toggle('show', selectedMenus.length > 0);
                buyButton.disabled = selectedMenus.length === 0;

                updateBottomBarPosition();
            });
        });

        // Tombol beli sekarang
        buyButton.addEventListener('click', () => {
            menusInput.value = JSON.stringify(selectedMenus);
            formPembelian.submit();
        });
    });
</script>
@endsection
