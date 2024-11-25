<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Lampiran Laporan Pemeliharaan Telemetri</title>
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
        <h4 class="title">LAPORAN PEMELIHARAAN PERALATAN</h4>
        <h4 class="sub-title">TELEMETRI WQMS GSM </h4><br><br>
    </center>
<div class="container mt-2">
    <div class="row justify-content-center align-items-center">
        <div class="card">
       
            <div class="card-body">
           
                    <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pemeliharaan</th>
                            <th>Waktu Mulai</th>
                            <th>Periode</th>
                            <th>Cuaca</th>
                            <th>No Alat Ukur</th>
                            <th>No GSM</th>
                            <th>User</th>
                            <th>Peralatan Telemetri</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemeliharaans as $pemeliharaan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pemeliharaan->waktuMulaiPemeliharan }}</td>
                            <td>{{ $pemeliharaan->periodePemeliharaan }}</td>
                            <td>{{ $pemeliharaan->cuaca }}</td>
                            <td>{{ $pemeliharaan->no_AlatUkur }}</td>
                            <td>{{ $pemeliharaan->no_GSM }}</td>
                            <td>{{ optional($pemeliharaan->user)->name }}</td>
                            <td>{{ optional($pemeliharaan->peralatanTelemetri)->namaAlat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>
</body>
</html>
