<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Layanan - Hunter Garage</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">

    <h1>Daftar Layanan Bengkel Hunter Garage 🛠️</h1>
    <hr>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>No.</th>
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop untuk menampilkan setiap data dari database --}}
            @forelse ($layanan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_layanan }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada layanan yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>