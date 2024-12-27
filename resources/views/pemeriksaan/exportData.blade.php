{{-- <!DOCTYPE html>
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
</html> --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/style/style.css">
    <title>Lampiran Laporan Pemeliharaan Telemetri</title>
</head>
<body>
    <style type="text/css">
        @page {
            size: portrait;
            /* margin: 20mm; Menambahkan margin jika diperlukan */
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
    {{-- <div style="position:absolute;top:750.108215px;left:82.290550px">
        <nobr>
            <table height="69.265137px" width="315.217987px" bordercolor="black" border="2">
                <tr>
                    <td height = "11.673584" width="122.751160" rowspan="1" colspan="2"></td>
                    <td height = "11.673584" width="113.662338" rowspan="1" colspan="2"></td>
                </tr>
                <tr>
                    <td height = "11.673462" width="62.551025" rowspan="1" colspan="1"></td>
                    <td height = "11.673462" width="60.200134" rowspan="1" colspan="1"></td>
                    <td height = "11.673462" width="60.230087" rowspan="1" colspan="1"></td>
                    <td height = "11.673462" width="53.432251" rowspan="1" colspan="1"></td>
                </tr>
                <tr>
                    <td height = "28.601807" width="62.551025" rowspan="1" colspan="1"></td>
                    <td height = "28.601807" width="60.200134" rowspan="1" colspan="1"></td>
                    <td height = "28.601807" width="60.230087" rowspan="1" colspan="1"></td>
                    <td height = "28.601807" width="53.432251" rowspan="1" colspan="1"></td>
                </tr>
            </table>
        </nobr>
    </div> --}}
    {{-- <div style="position:absolute;top:750.108215px;left:413.064026px">
        <nobr>
            <table height="69.418457px" width="315.220764px" bordercolor="black" border="2">
                <tr>
                    <td height = "11.673584" width="122.754150" rowspan="1" colspan="2"></td>
                    <td height = "11.673584" width="113.661407" rowspan="1" colspan="2"></td>
                </tr>
                <tr>
                    <td height = "11.673462" width="62.553040" rowspan="1" colspan="1"></td>
                    <td height = "11.673462" width="60.201111" rowspan="1" colspan="1"></td>
                    <td height = "11.673462" width="60.227112" rowspan="1" colspan="1"></td>
                    <td height = "11.673462" width="53.434296" rowspan="1" colspan="1"></td>
                </tr>
                <tr>
                    <td height = "28.716797" width="62.553040" rowspan="1" colspan="1"></td>
                    <td height = "28.716797" width="60.201111" rowspan="1" colspan="1"></td>
                    <td height = "28.716797" width="60.227112" rowspan="1" colspan="1"></td>
                    <td height = "28.716797" width="53.434296" rowspan="1" colspan="1"></td>
                </tr>
            </table>
        </nobr>
    </div> --}}
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
        <span style="position:absolute;top:1016.807739px;left:630.129639px">
        <nobr>Halaman 1/1 </nobr>
        </span>
        </span>
    </p>
    <div style="position:absolute;top:1009.471558px;left:703.565247px">
        <nobr><img height="22.000000" width="24.000000" src ="bgimg/bg00001.jpg"/></nobr>
    </div>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-weight:bold;color:#000000;">
            <span style="position:absolute;top:78.652100px;left:493.668518px">
                <nobr>Lampiran 9, Dok No. QI/DTI/02 </nobr>
            </span>
            <span style="position:absolute;top:90.816811px;left:493.201874px">
                <nobr>Formulir No.QI/DTI/02-9, Status “R8” </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-weight:bold;color:#000000;">
            <span style="position:absolute;top:123.478844px;left:216.248154px">
                <nobr>LAPORAN PEMELIHARAAN DAN KALIBRASI INTERNAL </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-weight:bold;color:#000000;">
            <span style="position:absolute;top:145.918045px;left:247.359268px">
                <nobr>PERALATAN TELEMETRI *( AWLR / ARR ) GSM </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:168.085281px;left:93.364471px">
                <nobr>Nama Stasiun Telemetri : ____________ Tanggal : ____________ </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:190.498611px;left:93.364471px">
                <nobr>Periode Pemeliharaan : ____________ Jam : BS_______| AS_______ </nobr>
            </span>
            <span style="position:absolute;top:212.911942px;left:93.364471px">
                <nobr>Pelaksana Pemeliharaan : ____________ No. Alat Ukur : ____________ </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:235.325272px;left:93.364471px">
                <nobr>Cuaca : ____________ No. GSM : ____________ </nobr>
            </span>
        </span>
    </p>
    <div style="position:absolute;top:254.578049px;left:74.977936px">
        <nobr>
            {{-- @foreach ($komponen as $item) --}}
            <div style="display: flex; flex-wrap: wrap;">
                @foreach ($komponen as $item)
                <div style="flex: 1 1 16.66%; padding: 10px;">
                    <table height="576.778198px" width="100%" bordercolor="black" border="2">
                        <tr>
                            <td height="78.824280" width="100%" rowspan="1" colspan="1">
                                <span style="font-family:Nimbus Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
                                    <p>
                                        <span style="position:relative;top:3.627441px;left:10.919820px">
                                            <nobr>{{ $item->nama}}</nobr>
                                        </span>
                                    </p>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                @endforeach
            </div>
            {{-- @endforeach --}}
        </nobr>
    </div>
    <p>
        <span style="font-family:Nimbus Roman;font-size:8.754052px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:834.590271px;left:99.279457px">
                <nobr>BS : Before Setting | AS : After Setting | * : Coret yang tidak perlu | : Centang yang diperiksa </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Times New Roman;font-size:11.672070px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:863.560242px;left:93.364449px">
                <nobr>Keterangan : ……………………………………………………………………………………… </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:902.095215px;left:169.423782px">
                <nobr>Mengetahui, Dibuat oleh </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Nimbus Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:916.881714px;left:145.318771px">
                <nobr>Ka. Tim Kalibrasi Divisi Pelaksana Kalibrasi </nobr>
            </span>
        </span>
    </p>
    <p>
        <span style="font-family:Times New Roman;font-size:9.687818px;font-style:normal;font-weight:normal;color:#000000;">
            <span style="position:absolute;top:988.750000px;left:138.940674px">
                <nobr>…………………………... ……………………….. </nobr>
            </span>
        </span>
    </p>
    <div style="position:absolute;top:832.043152px;left:423.956207px">
        <nobr>
            <img height="14.000000" width="14.000000" src ="bgimg/bg00002.jpg"/>
        </nobr>
    </div>
</body>
<script src="resources/js/vue.min.js"></script>
</html>
