<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tagihan Pasien</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Tagihan Pasien: {{ $pasien->nama }}</h2>
    <p><strong>Tanggal Kunjungan:</strong> {{ $kunjungan->tanggal_kunjungan }}</p>

    <h4>Tindakan Medis</h4>
    <table>
        <tr>
            <th>Nama Tindakan</th>
            <th>Harga</th>
        </tr>
        @foreach ($tindakan as $item)
            <tr>
                <td>{{ $item->name_actions }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <h4>Obat-obatan</h4>
    <table>
        <tr>
            <th>Nama Obat</th>
            <th>Harga</th>
        </tr>
        @foreach ($obat as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
</body>
</html>
