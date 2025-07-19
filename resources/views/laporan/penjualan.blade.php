<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $laporan->nama_laporan }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        h2 { text-align: center; margin-bottom: 5px; }
        .report-info { margin-bottom: 20px; font-size: 11px; }
        .report-info p { margin: 2px 0; }
        tfoot tr td { font-weight: bold; background-color: #f9f9f9; }
    </style>
</head>
<body>
    @php
        // Menghitung total sebelum tabel dirender
        $totalPendapatan = 0;
        $totalItem = 0;
        foreach ($pesanans as $pesanan) {
            // Asumsi harga ada di model Produk
            $harga = $pesanan->produk?->harga ?? 0;
            $totalPendapatan += $pesanan->jumlah * $harga;
            $totalItem += $pesanan->jumlah;
        }
    @endphp

    <h2>{{ $laporan->nama_laporan }}</h2>
    <div class="report-info">
        <p><strong>Jenis Laporan:</strong> {{ $laporan->jenisLaporan->nama_jenislaporan }}</p>
        <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($laporan->tanggal_mulai)->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::parse($laporan->tanggal_selesai)->isoFormat('D MMMM YYYY') }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::parse($laporan->tanggal_cetak)->isoFormat('D MMMM YYYY') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>Tgl. Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Nama Produk</th>
                <th class="text-center">Jml</th>
                {{-- <th class="text-right">Harga Satuan</th>
                <th class="text-right">Subtotal</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse($pesanans as $index => $pesanan)
                @php
                    // Asumsi harga diambil dari relasi produk
                    $hargaSatuan = $pesanan->produk?->harga ?? 0;
                    $subtotal = $pesanan->jumlah * $hargaSatuan;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->isoFormat('D MMM YYYY') }}</td>
                    <td>{{ $pesanan->nama_pemesan }}</td>
                    <td>{{ $pesanan->produk?->nama_produk ?? 'Produk Dihapus' }}</td>
                    <td class="text-center">{{ $pesanan->jumlah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data pesanan pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Keseluruhan</strong></td>
                <td class="text-center"><strong>{{ number_format($totalItem, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>