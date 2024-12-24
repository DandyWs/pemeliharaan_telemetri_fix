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
       table{
        margin-top: 0%;
        margin-bottom: 10%;
        border-collapse: collapse;
        width: 100%;
       }
       table tr td, table tr th{
        border: 1px solid black;
        padding: 8px;
        font-size: 9pt;
       }
       .title {
        margin-top : 50px;
       }
    </style>
     <center>
        <div class="card">
            <div class="card-header text-center">
                <h2><strong>LAPORAN PEMELIHARAAN DAN</strong></h2>
                <h2><strong>KALIBRASI INTERNAL PERALATAN TELEMETRI GSM</strong></h2>
                </h2>
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
                            <th>Periode</th>
                            <th>Cuaca</th>
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
                                <td>{{ $item->periode }}</td>
                                <td>{{ $item->cuaca }}</td>
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
