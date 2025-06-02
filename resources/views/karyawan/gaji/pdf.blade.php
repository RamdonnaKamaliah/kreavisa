<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Gaji - {{ $gaji->user->nama_lengkap }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .info { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total { font-weight: bold; background-color: #e6f7ff; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Detail Rekap Gaji</div>
        <div>Periode: {{ $gaji->tanggal }}</div>
    </div>

    <div class="info">
        <div><strong>Nama Karyawan:</strong> {{ $gaji->user->nama_lengkap }}</div>
        <div><strong>Jabatan:</strong> {{ $gaji->user->jabatan->nama_jabatan }}</div>
        <div><strong>Tipe Pembayaran:</strong> {{ $gaji->tipe_pembayaran }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Komponen</th>
                <th class="text-right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td class="text-right">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td class="text-right">Rp {{ number_format($gaji->bonus, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td class="text-right">- Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>TOTAL GAJI</td>
                <td class="text-right">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div>Dicetak pada: {{ date('d-m-Y H:i:s') }}</div>
    </div>
</body>
</html>