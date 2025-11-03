<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari dropdown (default: minggu)
        $periode = $request->get('periode', 'minggu'); // nilai: 'hari', 'minggu', 'dua_minggu'

        $today = Carbon::today();
        $oneWeekAgo = Carbon::today()->subDays(7);
        $twoWeeksAgo = Carbon::today()->subDays(14);

        // Total semua penjualan (sepanjang waktu)
        $totalPenjualan = Transaction::sum('total_harga');

        // Jumlah transaksi hari ini
        $transaksiHariIni = Transaction::whereDate('tanggal_transaksi', $today)->count();

        // Pendapatan bulan ini
        $pendapatanBulanIni = Transaction::whereMonth('tanggal_transaksi', Carbon::now()->month)
            ->whereYear('tanggal_transaksi', Carbon::now()->year)
            ->sum('total_harga');

        // Tentukan total berdasarkan filter periode
        if ($periode === 'hari') {
            $totalPeriode = Transaction::whereDate('tanggal_transaksi', $today)->sum('total_harga');
            $labelPeriode = 'Hari Ini';
            $totalLalu = Transaction::whereDate('tanggal_transaksi', $today->subDay())->sum('total_harga');
        } elseif ($periode === 'dua_minggu') {
            $totalPeriode = Transaction::whereBetween('tanggal_transaksi', [$twoWeeksAgo, $today])
                ->sum('total_harga');
            $labelPeriode = '2 Minggu Terakhir';
            $totalLalu = Transaction::whereBetween('tanggal_transaksi', [$twoWeeksAgo->subDays(14), $twoWeeksAgo])
                ->sum('total_harga');
        } else {
            // Default: Minggu Ini
            $totalPeriode = Transaction::whereBetween('tanggal_transaksi', [$oneWeekAgo, $today])
                ->sum('total_harga');
            $labelPeriode = 'Minggu Ini';
            $totalLalu = Transaction::whereBetween('tanggal_transaksi', [$twoWeeksAgo, $oneWeekAgo])
                ->sum('total_harga');
        }

        // Hitung persentase peningkatan
        $persentasePeningkatan = 0;
        if ($totalLalu > 0) {
            $persentasePeningkatan = (($totalPeriode - $totalLalu) / $totalLalu) * 100;
        }

        // Produk terlaris
        $produkTerlaris = TransactionDetail::select('menu_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('menu_id')
            ->orderByDesc('total_terjual')
            ->with('menu')
            ->first();

        // Penjualan terbaru
        $limit = request('limit', default: 20);

        $penjualanTerbaru = TransactionDetail::with(['menu', 'transaction'])
                            ->orderByDesc('created_at')
                            ->take($limit)
                            ->get();

        return view('user.dashboard', compact(
            'totalPenjualan',
            'transaksiHariIni',
            'pendapatanBulanIni',
            'produkTerlaris',
            'penjualanTerbaru',
            'totalPeriode',
            'labelPeriode',
            'persentasePeningkatan',
            'periode'
        ));
    }
}
