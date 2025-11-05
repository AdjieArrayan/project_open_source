<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManajemenPenjualanController extends Controller
{
    public function index()
    {
        // Ringkasan utama
        $totalTransaksi = Transaction::count();
        $totalPendapatan = Transaction::sum('total_harga');
        $totalProdukTerjual = TransactionDetail::sum('jumlah');

        // 10 transaksi terakhir
        $penjualanTerakhir = Transaction::with(['details.menu'])
            ->orderByDesc('tanggal_transaksi')
            ->take(10)
            ->get();

        return view('admin.manajemenPenjualan', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalProdukTerjual',
            'penjualanTerakhir'
        ));
    }

    public function rekapHarian()
    {
        $today = Carbon::today();

        $rekap = Transaction::whereDate('tanggal_transaksi', $today)
            ->selectRaw('COUNT(*) as total_transaksi, SUM(total_harga) as total_pendapatan')
            ->first();

        $produkTerjual = TransactionDetail::whereDate('created_at', $today)->sum('jumlah');

        return response()->json([
            'tanggal' => $today->format('d M Y'),
            'total_transaksi' => $rekap->total_transaksi ?? 0,
            'total_pendapatan' => $rekap->total_pendapatan ?? 0,
            'produk_terjual' => $produkTerjual ?? 0
        ]);
    }

    public function rekapBulanan()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $rekap = Transaction::whereMonth('tanggal_transaksi', $month)
            ->whereYear('tanggal_transaksi', $year)
            ->selectRaw('COUNT(*) as total_transaksi, SUM(total_harga) as total_pendapatan')
            ->first();

        $produkTerjual = TransactionDetail::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('jumlah');

        return response()->json([
            'bulan' => Carbon::now()->translatedFormat('F Y'),
            'total_transaksi' => $rekap->total_transaksi ?? 0,
            'total_pendapatan' => $rekap->total_pendapatan ?? 0,
            'produk_terjual' => $produkTerjual ?? 0
        ]);
    }

    public function showQrisUpload()
    {
        $qrisPath = public_path('uploads/qris/QRIS.png');

        // Kalau file belum ada, biar nanti tampil gambar default
        $fileExists = file_exists($qrisPath);

        $qrisImage = $fileExists ? asset('uploads/qris/QRIS.png') . '?v=' . time() // tambahkan cache-buster
        : asset('style/assets/img/QRIS.png'); // default

        return view('admin.uploadQris', compact('fileExists'));
    }

    public function uploadQris(Request $request)
    {
        $request->validate([
            'qris_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $uploadPath = public_path('uploads/qris');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Hapus file lama
        $files = glob($uploadPath . '/*');
        foreach ($files as $file) {
            if (is_file($file)) unlink($file);
        }

        // Upload file baru
        $file = $request->file('qris_image');
        $file->move($uploadPath, 'QRIS.png');

        return redirect()->route('manajemen.penjualan')->with('success', 'QRIS berhasil diperbarui!');
    }

}