📘 Dokumentasi Pengguna - CendolNada

🏠 Pendahuluan

Aplikasi CendolNada merupakan sistem penjualan dan pembayaran digital berbasis web yang dikembangkan menggunakan Laravel.
Tujuannya adalah untuk memudahkan pengguna (admin dan user) dalam melakukan transaksi penjualan, mengelola data menu, serta mendukung sistem pembayaran cashless melalui QRIS.

Panduan ini ditujukan untuk pengguna umum dan admin agar dapat menggunakan aplikasi dengan mudah.

---

## 👤 1.  Jenis Pengguna

Aplikasi ini memiliki dua jenis pengguna utama:

| Jenis Pengguna | Hak Akses                                                              |
| -------------- | ---------------------------------------------------------------------- |
| **Admin**      | Dapat mengelola data menu, pengguna, dan QRIS                          |
| **User**       | Dapat melihat menu penjualan, melakukan transaksi, dan pembayaran QRIS |


---

## 🔑 2. Cara Masuk ke Sistem

    Buka browser, lalu akses alamat aplikasi, misalnya:
    👉 http://localhost:8000

    Masukkan email dan password pada form login.

    Klik tombol Login.

    Jika berhasil, pengguna akan diarahkan ke halaman Dashboard.

    💡 Jika login gagal, pastikan email dan password sudah benar.


---

## 3. 🧭 Navigasi Utama

Setelah login, pengguna akan melihat sidebar di sisi kiri layar.
Berikut daftar menu yang tersedia:

| Menu                                     | Fungsi                                 |
| ---------------------------------------- | -------------------------------------- |
| **Dashboard**                            | Menampilkan ringkasan sistem           |
| **List Menu**                            | Menampilkan daftar menu penjualan      |
| **Manajemen Penjualan** *(khusus admin)* | Menambah, mengedit, dan menghapus menu |
| **Manajemen Role** *(khusus admin)*      | Mengelola hak akses pengguna           |
| **Manajemen Menu** *(khusus admin)*      | Mengelola kategori menu                |
| **Log Out**                              | Keluar dari sistem                     |


## 4. 🍹 Fitur Utama

### 1. Menampilkan Daftar Menu

    Akses menu List Menu di sidebar.

    Semua menu penjualan akan muncul dalam bentuk kartu (card) dengan gambar, nama, dan harga.

    Pengguna dapat memilih menu untuk dibeli atau melihat detailnya.

### 2. Menambah Menu Penjualan (Admin)

    Masuk ke Manajemen Penjualan.

    Klik tombol Tambah Menu.

    Isi data berikut:

        Nama Menu

        Harga

        Deskripsi

        Upload Gambar Menu

    Klik Simpan untuk menambahkan menu.

    ✅ Menu yang baru akan langsung muncul di daftar menu.

### 3. Mengedit atau Menghapus Menu (Admin)

    Di halaman Manajemen Penjualan, cari menu yang ingin diubah.

    Klik Edit untuk memperbarui data, lalu simpan perubahan.

    Klik Hapus untuk menghapus menu dari daftar.

### 4. Upload Gambar QRIS (Admin)

    Masuk ke Manajemen Penjualan.

    Di bagian bawah, klik tombol Upload QRIS.

    Pilih file gambar QRIS (format PNG atau JPG).

    Setelah diunggah, gambar QRIS lama akan otomatis diganti oleh gambar baru.

    💡 Hanya satu gambar QRIS yang disimpan, untuk menjaga kesederhanaan sistem.

### 5. Pembayaran Cashless via QRIS (User)

    Pilih menu yang ingin dibeli.

    Klik tombol Beli / Bayar QRIS.

    Sistem akan menampilkan halaman QRIS Pembayaran.

    Scan kode QR menggunakan aplikasi pembayaran (Dana, OVO, GoPay, dsb).

    Klik tombol Konfirmasi Pembayaran setelah transaksi selesai.

    Muncul notifikasi bahwa transaksi berhasil.

### 6. Logout dari Sistem

    Klik Log Out di sidebar.

    Sistem akan mengarahkan pengguna ke halaman login.

    Semua sesi pengguna akan berakhir secara otomatis.

## 🧩 5. Halaman-Halaman Utama

| Halaman                 | Deskripsi                                   |
| ----------------------- | ------------------------------------------- |
| **Dashboard**           | Menampilkan ringkasan dan statistik singkat |
| **List Menu**           | Menampilkan seluruh menu yang tersedia      |
| **Manajemen Penjualan** | Tempat admin mengatur data menu dan QRIS    |
| **Pembayaran Cashless** | Menampilkan kode QRIS untuk transaksi       |
| **Login / Logout**      | Akses masuk dan keluar sistem               |

## ⚙️ 6. Tips Penggunaan

    Gunakan gambar berukuran kecil (< 1MB) untuk QRIS agar loading cepat.

    Pastikan browser mendukung JavaScript dan cookies aktif.

    Logout setiap kali selesai menggunakan aplikasi untuk keamanan.

    Gunakan peran Admin hanya untuk keperluan manajemen, bukan transaksi harian.

## 📄 7. Catatan Akhir

    Dokumentasi ini ditulis untuk membantu pengguna memahami fungsi setiap fitur dalam aplikasi CendolNada.
    Panduan ini dapat dikembangkan lebih lanjut jika sistem mendapatkan pembaruan fitur atau tampilan