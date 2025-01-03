<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Lampiran Laporan Pemeriksaan Telemetri</title>
</head>
<body>
    <style type="text/css">
    @page {
        size: landscape;
        margin: 20mm; /* Menambahkan margin jika diperlukan */
    }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-left: -60px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: center;
        }
       .title {
        margin-top : 10px;
       }
        .signature {
            margin-top: 20px;
            text-align: right;
        }
    </style>
     <center>
        <div class="card">
            <div class="card-header text-center">
                <h3><strong>LAPORAN PEMELIHARAAN DAN</strong></h3>
                <h3><strong>KALIBRASI INTERNAL PERALATAN TELEMETRI GSM</strong></h3>

                <br>
            </div>
    </center>
<div class="container mt-2 align-items-center">
    <div class="card text-center">
        <center>
            <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
                <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 5px;">No</th>
                    <th style="border: 1px solid black; padding: 5px;">Tanggal</th>
                    <th style="border: 1px solid black; padding: 5px;">Waktu</th>
                    <th style="border: 1px solid black; padding: 5px;">Periode</th>
                    <th style="border: 1px solid black; padding: 5px;">Cuaca</th>
                    <th style="border: 1px solid black; padding: 5px;">Alat Ukur</th>
                    <th style="border: 1px solid black; padding: 5px;">GSM</th>
                    <th style="border: 1px solid black; padding: 5px;">Jenis Alat</th>
                    <th style="border: 1px solid black; padding: 5px;">Lokasi Stasiun</th>
                    <th style="border: 1px solid black; padding: 5px;">Pelaksana</th>
                    <th style="border: 1px solid black; padding: 5px;">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $index => $item)
                <tr>
                    <td style="border: 1px solid black; padding: 5px;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->tanggal }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->waktu }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->periode }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->cuaca }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->no_alatUkur }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->no_GSM }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->namajenis }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->lokasiStasiun }}</td>
                    <td style="border: 1px solid black; padding: 5px; nowrap">{{ $item->name }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->ttd ? 'Confirmed' : 'Not Confirmed' }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        <center>
    </div>
</div>
</body>
</html>
