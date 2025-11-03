<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class PenjualanController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('user.menuPenjualan', compact('menus'));
    }

    public function konfirmasiPembelian(Request $request)
    {
        $menusData = json_decode($request->menus, true);

        if (!$menusData || !is_array($menusData)) {
            return redirect()
                ->route('menuPenjualan')
                ->with('error', 'Tidak ada menu yang dipilih.');
        }

        $menuIds = collect($menusData)->pluck('id')->toArray();
        $selectedMenus = Menu::whereIn('id', $menuIds)->get();

        return view('user.konfirmasiPembelian', compact('selectedMenus'));
    }

    /**
     * Menangani kiriman dari konfirmasiPembelian (formBeliSemua)
     * dan menampilkan halaman menuPembayaran.
     */
    public function menuPembayaran(Request $request)
    {
        // Ambil JSON data dari form konfirmasi pembelian
        $menusData = json_decode($request->menus, true);

        if (!$menusData || !is_array($menusData)) {
            return redirect()
                ->route('menuPenjualan')
                ->with('error', 'Data pembelian tidak valid.');
        }

        // Hitung total keseluruhan
        $totalKeseluruhan = collect($menusData)->sum('subtotal');

        // Simpan sementara ke session biar bisa diakses oleh halaman berikutnya
        $request->session()->put('transaksi_sementara', [
            'menus' => $menusData,
            'total' => $totalKeseluruhan,
        ]);

        // Kirim ke halaman view menuPembayaran
        return view('user.menuPembayaran', [
            'menus' => $menusData,
            'total' => $totalKeseluruhan,
        ]);
    }

    public function menuCash(Request $request)
    {
        $pembelian = $request->session()->get('transaksi_sementara');

        if (!$pembelian) {
            return redirect()
                ->route('menuPenjualan')
                ->with('error', 'Data transaksi tidak ditemukan.');
        }

        $menus = $pembelian['menus'];
        $total = $pembelian['total'];

        // Ambil data menu dari DB berdasarkan ID
        $menuIds = collect($menus)->pluck('id');
        $menuData = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

        // Simpan ke tabel transaksi
        $transaksi = Transaction::create([
            'user_id' => Auth::id(),
            'total_harga' => $total,
            'metode_pembayaran' => 'Cash',
            'tanggal_transaksi' => Carbon::now(),
        ]);

        // Simpan detail transaksi
        foreach ($menus as &$item) {
            $menu = $menuData[$item['id']];
            $item['nama_menu'] = $menu->nama_menu; // tambahkan nama ke data

            TransactionDetail::create([
                'transaction_id' => $transaksi->id,
                'menu_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        // Hapus session sementara
        $request->session()->forget('transaksi_sementara');

        // Kirim ke view
        return view('user.menuCash', [
            'transaksi' => $transaksi,
            'menus' => $menus,
            'total' => $total,
        ]);
    }

    public function menuCashless(Request $request)
    {
        $pembelian = $request->session()->get('transaksi_sementara');

        if (!$pembelian) {
            return redirect()->route('menuPenjualan')
                ->with('error', 'Data transaksi tidak ditemukan.');
        }

        $menus = $pembelian['menus'];
        $total = $pembelian['total'];

        return view('user.menuCashless', compact('menus', 'total'));
    }

    public function konfirmasiCashless(Request $request)
    {
        $pembelian = $request->session()->get('transaksi_sementara');

        if (!$pembelian) {
            return redirect()->route('menuPenjualan')
                ->with('error', 'Data transaksi tidak ditemukan.');
        }

        $menus = $pembelian['menus'];
        $total = $pembelian['total'];

        // Simpan ke tabel transaksi
        $transaksi = Transaction::create([
            'user_id' => Auth::id(),
            'total_harga' => $total,
            'metode_pembayaran' => 'QRIS',
            'tanggal_transaksi' => Carbon::now(),
        ]);

        // Simpan detail transaksi
        foreach ($menus as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaksi->id,
                'menu_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        // Hapus session
        $request->session()->forget('transaksi_sementara');

        // Tampilkan halaman struk (atau modal sukses)
        return redirect()->route('menuPenjualan')->with('success', 'Pembayaran QRIS berhasil disimpan.');
    }


}
