# ⚙️ Dokumentasi Pengembang - Aplikasi CendolNada

Aplikasi **CendolNada** adalah sistem penjualan berbasis web yang dikembangkan menggunakan **Laravel Framework**, dengan fokus pada fitur transaksi, manajemen menu, dan pembayaran cashless (QRIS).

---

## 🧱 1. Spesifikasi Teknis

| Komponen | Versi / Teknologi |
|-----------|------------------|
| Bahasa Pemrograman | PHP 8.3.13 |
| Framework | Laravel 11 |
| Database | MySQL (hanya untuk data transaksi dan menu) |
| Template Engine | Blade |
| CSS Framework | Bootstrap 5 |
| Web Server | Apache / Laravel Artisan |
| Dependency Manager | Composer |
| Versi PHP Package Manager | Composer 2.8.2 |
| Sistem Operasi Pengujian | Windows 11 |

---

## 📂 2. Struktur Direktori Utama
```
.
project_open_source/
├── app/
│ ├── Http/
│ │ ├── Controllers/
| | | ├── Admin/
| | | | ├── RekapExportController
| | | ├── AuthController
| | | ├── Controller
| | | ├── DashboardController
| | | ├── ManajemenPenjualanController
| | | ├── ManajemenRoleController
| | | ├── MenuController
| | | └── PenjualanController
│ │ ├── Middleware/
| | | ├── AdminMiddleware
| | | └── RoleMiddleware
│ ├── Models/ 
│ │ ├── Menu
| | ├── Transaction
| | ├── TransactionDetail
| | ├── User
│
├── resources/
│ ├── views/
│ │ ├── admin/ 
| | | ├── editMenu.blade
| | | ├── manajemenAkun.blade
| | | ├── manajemenMenu.blade
| | | ├── manajemenPenjualan.blade
| | | ├── tambahMenu.blade
| | | └── UploadQRIS.blade
│ │ ├── auth/ 
| | | ├── login.blade
| | | ├── register.blade
│ │ ├── export/ 
| | | ├── rekap.blade
│ │ ├── user/ 
| | | ├── dashboard.blade
| | | ├── konfirmasiPembelian.blade
| | | ├── menuCash.blade
| | | ├── menuCashless.blade
| | | ├── menuPembayaran.blade
| | | └── menuPenjualan.blade
│ └── ├── mainUser.blade.php # Template utama
|
├── routes/
│ ├── web.php # Rute utama aplikasi
│
├── database/
│ ├── migrations/
| | ├── 0001_01_01_000000_create_users_table
| | ├── 0001_01_01_000001_create_menus_table
| | ├── 0001_01_01_000002_create_transaction_table
| | ├── 2025_11_02_075257_create_transaction_details_table
│ ├── seeders/ # Struktur tabel database
| | ├── DatabaseSeeder
| | ├── MenuSeeder
| | ├── TransactionDetailSeeder
| | ├── TransactionSeeder
| | └── UserSeeder
│
└── composer.json # File dependency Composer
```

---

## 🛠️ 3. Instalasi & Konfigurasi

### Langkah 1 - Clone Repository
    git clone https://github.com/AdjieArrayan/project_open_source.git 
    cd project_open_source 

### Langkah 2 - Install Dependency
    composer install 

### Langkah 3 - Konfigurasi .env

    Salin file contoh:

    | copy .env.example, ubah menjadi .env |

    Edit isi file .env agar sesuai:

    APP_NAME=CendolNada
    APP_ENV=local
    APP_KEY=
    APP_DEBUG=true
    APP_URL=http://localhost:8000

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cendolnada
    DB_USERNAME=root
    DB_PASSWORD=

### Langkah 4 - Generate Key
    php artisan key:generate

### Langkah 5 - Migrasi Database
    php artisan migrate

### Langkah 6 - Jalankan Server
    php artisan serve

    Akses aplikasi di browser:
    👉 http://localhost:8000

## 🧩 4. Fitur Utama

    🔐 Login Multi Role (Admin & User)

    🛍️ CRUD Menu Penjualan

    📊 Rekap Harian & Bulanan Penjualan

    💳 Upload & Tampilkan QRIS Tanpa Database

    ⚙️ Manajemen Role & Pengguna

    🖼️ Tampilan Responsive dengan Bootstrap 5

## 👨‍💻 5. Kontributor

| Nama                    | Peran                          |
| ----------------------- | ------------------------------ |
| **Adjie Arrayan**       |      FullStack Developer       |
| **Rasyid Iskandar**     |             UI/UX              |
| **Suci Dwi Pratiwi**    |         System Analyst         |
| **Hanum Surya H.**      |         System Analyst         |
| **Vian Haryadi**        |             UI/UX              |
| **Fergi Ar Farid Afif** |             UI/UX              |

## 📄 6. Lisensi

Proyek ini bersifat open source dan dapat digunakan untuk kepentingan pembelajaran dengan mencantumkan sumber.

    © 2025 - Aplikasi CendolNada
    Dikembangkan untuk Memenuhi Tugas Mata Kuliah Tekhnologi Open Source dan terbaru
