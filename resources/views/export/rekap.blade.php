<table>
    <thead>
        <tr>
            <th colspan="3" style="text-align:center; font-weight:bold; font-size:16px;">
                {{ $title }}
            </th>
        </tr>
        <tr>
            <th>Tanggal / Bulan</th>
            <th>Total Pendapatan</th>
            <th>Produk Terfavorit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekapData as $row)
            <tr>
                <td>
                    {{ $row->tanggal ?? \Carbon\Carbon::createFromFormat('Y-m', $row->bulan)->translatedFormat('F Y') }}
                </td>
                <td>Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}</td>
                <td>{{ $favorit[$row->tanggal ?? $row->bulan]->nama_menu ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>