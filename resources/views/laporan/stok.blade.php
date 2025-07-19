<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $laporan->nama_laporan }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px;}
        .info { margin-bottom: 20px; }
        .info p { margin: 0; }
    </style>
</head>
<body>
    <h2>{{ $laporan->nama_laporan }}</h2>
    <div class="info">
        <p><strong>Jenis Laporan:</strong> {{ $laporan->jenisLaporan->nama_jenislaporan }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::parse($laporan->tanggal_cetak)->isoFormat('D MMMM YYYY') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Stok Saat Ini</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produks as $index => $produk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ number_format($produk->stok?->jumlah ?? 0) }}</td>                
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Tidak ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>