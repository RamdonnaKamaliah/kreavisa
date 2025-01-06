<!-- resources/views/karyawan/absen.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi</title>
</head>
<body>
    <h1>Data Absensi</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Waktu Absen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absen as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->waktu_absen }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
