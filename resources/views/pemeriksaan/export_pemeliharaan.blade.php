<!DOCTYPE html>
<html>
<head>
    <title>Export Pemeliharaan Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Pemeliharaan</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Lokasi Stasiun</th>
                <th>Periode</th>
                <th>Cuaca</th>
                <th>Jenis Alat</th>
                <th>Keterangan</th>


                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal}}</td>
                    <td>{{ $item->waktu }}</td>
                    <td>{{ $item->lokasiStasiun }}</td>
                    <td>{{ $item->periode }}</td>
                    <td>{{ $item->cuaca }}</td>
                    <td>{{ $item->namajenis }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <!-- Add more table data as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>