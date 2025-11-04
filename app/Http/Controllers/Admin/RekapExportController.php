<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;

class RekapExportController extends Controller
{
    public function exportHarian()
    {
        $startDate = Carbon::now()->subDays(30);

        // === 1️⃣ Ambil data pendapatan per hari ===
        $data = DB::table('transactions')
            ->select(
                DB::raw('DATE(tanggal_transaksi) as tanggal'),
                DB::raw('SUM(total_harga) as pendapatan'),
                DB::raw('COUNT(id) as total_transaksi')
            )
            ->where('tanggal_transaksi', '>=', $startDate)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // === 2️⃣ Ambil menu terlaris per hari ===
        $menuTerlaris = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
            ->select(
                DB::raw('DATE(transactions.tanggal_transaksi) as tanggal'),
                DB::raw('menus.nama_menu as menu_nama'),
                DB::raw('SUM(transaction_details.jumlah) as total_terjual')
            )
            ->where('transactions.tanggal_transaksi', '>=', $startDate)
            ->groupBy('tanggal', 'menu_nama')
            ->orderBy('tanggal')
            ->get()
            ->groupBy('tanggal')
            ->map(function ($items) {
                $top = $items->sortByDesc('total_terjual')->first();
                return $top ? $top->menu_nama : '-';
            });

        // === 3️⃣ Data rekap 30 hari terakhir ===
        $rekapTotal = [
            'total_pendapatan' => $data->sum('pendapatan'),
            'total_transaksi' => $data->sum('total_transaksi'),
            'tanggal_tertinggi' => optional($data->sortByDesc('pendapatan')->first())->tanggal ?? '-',
            'menu_terlaris' => $menuTerlaris->count() ? $menuTerlaris->mode()[0] ?? '-' : '-',
        ];

        // === 4️⃣ Mulai bikin Excel ===
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rekap Harian');

        // === Header Rekap Singkat ===
        $sheet->setCellValue('A1', 'Rekap');
        $sheet->setCellValue('B1', 'Harian');

        $sheet->setCellValue('A3', 'Pendapatan Tertinggi');
        $sheet->setCellValue('B3', $rekapTotal['tanggal_tertinggi'] != '-' ? Carbon::parse($rekapTotal['tanggal_tertinggi'])->format('d M Y') : '-');
        $sheet->setCellValue('C3', 'Menu Terlaris');
        $sheet->setCellValue('D3', $rekapTotal['menu_terlaris']);
        $sheet->setCellValue('E3', 'Total Transaksi');
        $sheet->setCellValue('F3', $rekapTotal['total_transaksi']);
        $sheet->setCellValue('G3', 'Total Pendapatan');
        $sheet->setCellValue('H3', 'Rp. ' . number_format($rekapTotal['total_pendapatan'], 0, ',', '.'));


        $sheet->getStyle('A3:A6')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'C6EFCE']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_MEDIUM]
            ]
        ]);
        $sheet->getStyle('B3:B6')->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_MEDIUM]
            ]
        ]);

        // === Header Data Harian ===
        $startRow = 6;
        $sheet->setCellValue('A' . $startRow, 'Tanggal');
        $sheet->setCellValue('B' . $startRow, 'Menu Terlaris');
        $sheet->setCellValue('C' . $startRow, 'Total Transaksi');
        $sheet->setCellValue('D' . $startRow, 'Total Pendapatan');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '28A745']
            ],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ];
        $sheet->getStyle("A{$startRow}:D{$startRow}")->applyFromArray($headerStyle);

        // === Isi Data ===
        $row = $startRow + 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, Carbon::parse($item->tanggal)->format('d M Y'));
            $sheet->setCellValue('B' . $row, $menuTerlaris[$item->tanggal] ?? '-');
            $sheet->setCellValue('C' . $row, $item->total_transaksi);
            $sheet->setCellValue('D' . $row, $item->pendapatan);
            $row++;
        }

        // Auto size & border
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getStyle("A{$startRow}:D" . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // === Chart ===
        if ($data->count() > 1) {
            $chartLabel = [
                new DataSeriesValues('String', "'Rekap Harian'!\$D\${$startRow}", null, 1)
            ];

            $xAxisTickValues = [
                new DataSeriesValues('String', "'Rekap Harian'!\$A\$" . ($startRow + 1) . ":\$A\$" . ($row - 1))
            ];

            $dataSeriesValues = [
                new DataSeriesValues('Number', "'Rekap Harian'!\$D\$" . ($startRow + 1) . ":\$D\$" . ($row - 1))
            ];

            $series = new DataSeries(
                DataSeries::TYPE_BARCHART,
                DataSeries::GROUPING_CLUSTERED,
                range(0, count($dataSeriesValues) - 1),
                $chartLabel,
                $xAxisTickValues,
                $dataSeriesValues
            );
            $series->setPlotDirection(DataSeries::DIRECTION_COL);
            $plotArea = new PlotArea(null, [$series]);
            $legend = new Legend(Legend::POSITION_RIGHT, null, false);
            $title = new Title('Pendapatan Harian (30 Hari Terakhir)');

            $chart = new Chart('chart1', $title, $legend, $plotArea);
            $chart->setTopLeftPosition('F6');
            $chart->setBottomRightPosition('N25');
            $sheet->addChart($chart);
        }

        // === Simpan File ===
        $fileName = 'Rekap_Harian_' . Carbon::now()->format('d_m_Y') . '.xlsx';
        $filePath = storage_path('app/public/' . $fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportBulanan()
    {
        $startDate = Carbon::now()->subMonths(12);

        // === 1️⃣ Ambil data pendapatan per bulan ===
        $data = DB::table('transactions')
            ->select(
                DB::raw('YEAR(tanggal_transaksi) as tahun'),
                DB::raw('MONTH(tanggal_transaksi) as bulan'),
                DB::raw('SUM(total_harga) as pendapatan'),
                DB::raw('COUNT(id) as total_transaksi')
            )
            ->where('tanggal_transaksi', '>=', $startDate)
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get()
            ->map(function ($item) {
                $item->periode = Carbon::create($item->tahun, $item->bulan)->translatedFormat('F Y');
                return $item;
            });

        // === 2️⃣ Ambil menu terlaris per bulan ===
        $menuTerlaris = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
            ->select(
                DB::raw('YEAR(transactions.tanggal_transaksi) as tahun'),
                DB::raw('MONTH(transactions.tanggal_transaksi) as bulan'),
                DB::raw('menus.nama_menu as menu_nama'),
                DB::raw('SUM(transaction_details.jumlah) as total_terjual')
            )
            ->where('transactions.tanggal_transaksi', '>=', $startDate)
            ->groupBy('tahun', 'bulan', 'menu_nama')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get()
            ->groupBy(fn($item) => $item->tahun . '-' . $item->bulan)
            ->map(function ($items) {
                $top = $items->sortByDesc('total_terjual')->first();
                return $top ? $top->menu_nama : '-';
            });

        // === 3️⃣ Data rekap 12 bulan terakhir ===
        $rekapTotal = [
            'total_pendapatan' => $data->sum('pendapatan'),
            'total_transaksi' => $data->sum('total_transaksi'),
            'periode_tertinggi' => optional($data->sortByDesc('pendapatan')->first())->periode ?? '-',
            'menu_terlaris' => $menuTerlaris->count() ? $menuTerlaris->mode()[0] ?? '-' : '-',
        ];

        // === 4️⃣ Mulai bikin Excel ===
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rekap Bulanan');

        // === Header Rekap ===
        $sheet->setCellValue('A1', 'Rekap Penjualan Bulanan');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // === Rekap Singkat (vertikal) ===
        $sheet->setCellValue('A3', 'Periode Pendapatan Tertinggi');
        $sheet->setCellValue('B3', $rekapTotal['periode_tertinggi']);
        $sheet->setCellValue('A4', 'Menu Terlaris');
        $sheet->setCellValue('B4', $rekapTotal['menu_terlaris']);
        $sheet->setCellValue('A5', 'Total Transaksi');
        $sheet->setCellValue('B5', $rekapTotal['total_transaksi']);
        $sheet->setCellValue('A6', 'Total Pendapatan');
        $sheet->setCellValue('B6', 'Rp. ' . number_format($rekapTotal['total_pendapatan'], 0, ',', '.'));

        // Style header hijau
        $sheet->getStyle('A3:A6')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'C6EFCE']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_MEDIUM]
            ]
        ]);
        $sheet->getStyle('B3:B6')->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_MEDIUM]
            ]
        ]);

        // === Header Data Bulanan ===
        $startRow = 9;
        $sheet->setCellValue('A' . $startRow, 'Periode');
        $sheet->setCellValue('B' . $startRow, 'Menu Terlaris');
        $sheet->setCellValue('C' . $startRow, 'Total Transaksi');
        $sheet->setCellValue('D' . $startRow, 'Total Pendapatan');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '28A745']
            ],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ];
        $sheet->getStyle("A{$startRow}:D{$startRow}")->applyFromArray($headerStyle);

        // === Isi Data ===
        $row = $startRow + 1;
        foreach ($data as $item) {
            $key = $item->tahun . '-' . $item->bulan;
            $sheet->setCellValue('A' . $row, $item->periode);
            $sheet->setCellValue('B' . $row, $menuTerlaris[$key] ?? '-');
            $sheet->setCellValue('C' . $row, $item->total_transaksi);
            $sheet->setCellValue('D' . $row, $item->pendapatan);
            $row++;
        }

        // Auto size & border
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getStyle("A{$startRow}:D" . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // === Chart ===
        if ($data->count() > 1) {
            $chartLabel = [
                new DataSeriesValues('String', "'Rekap Bulanan'!\$D\${$startRow}", null, 1)
            ];

            $xAxisTickValues = [
                new DataSeriesValues('String', "'Rekap Bulanan'!\$A\$" . ($startRow + 1) . ":\$A\$" . ($row - 1))
            ];

            $dataSeriesValues = [
                new DataSeriesValues('Number', "'Rekap Bulanan'!\$D\$" . ($startRow + 1) . ":\$D\$" . ($row - 1))
            ];

            $series = new DataSeries(
                DataSeries::TYPE_BARCHART,
                DataSeries::GROUPING_CLUSTERED,
                range(0, count($dataSeriesValues) - 1),
                $chartLabel,
                $xAxisTickValues,
                $dataSeriesValues
            );
            $series->setPlotDirection(DataSeries::DIRECTION_COL);
            $plotArea = new PlotArea(null, [$series]);
            $legend = new Legend(Legend::POSITION_RIGHT, null, false);
            $title = new Title('Pendapatan Bulanan (12 Bulan Terakhir)');

            $chart = new Chart('chart2', $title, $legend, $plotArea);
            $chart->setTopLeftPosition('F9');
            $chart->setBottomRightPosition('N25');
            $sheet->addChart($chart);
        }

        // === Simpan File ===
        $fileName = 'Rekap_Bulanan_' . Carbon::now()->format('d_m_Y') . '.xlsx';
        $filePath = storage_path('app/public/' . $fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
<<<<<<< HEAD
}

=======
}
>>>>>>> 695ff00fc8d74ed3d45b4c2880871e041b8e6c8a
