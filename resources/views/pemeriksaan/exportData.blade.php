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
                <h3><strong>LAPORAN PEMERIKSAAN{{ $id }}</strong></h3>
                <h3><strong>KALIBRASI INTERNAL PERALATAN TELEMETRI GSM</strong></h3>

                <br>
            </div>
    </center>
<div class="container mt-2">
    <div class="row justify-content-center align-items-center">
        <div class="card">

            <div class="card-body">

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>waktu</th>
                            <th>Periode</th>
                            <th>Cuaca</th>
                            <th>no_alatUkur</th>
                            <th>no_GSM</th>
                            <th>Jenis Alat</th>
                            <th>Lokasi Stasiun</th>
                            <th>Pelaksana</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td> <!-- Menambahkan Waktu -->
                            <td>{{ $item->periode }}</td>
                            <td>{{ $item->cuaca }}</td>
                            <td>{{ $item->no_alatUkur }}</td> <!-- Menambahkan No Alat Ukur -->
                            <td>{{ $item->no_GSM }}</td> <!-- Menambahkan No GSM -->
                            <td>{{ $item->alatTelemetri->jenisAlat->namajenis }}</td>
                            <td>{{ $item->alatTelemetri->lokasiStasiun }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->status ? 'Confirmed' : 'Not Confirmed' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="signature">
                    <p>Disahkan oleh,</p>
                    <br><br><br>
                    <p>_______________________</p>
                    <p>Nama Pemeriksa</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
