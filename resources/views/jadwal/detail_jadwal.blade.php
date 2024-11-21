@extends('layouts.template')

@section('content')
<section class="content">
    <!--Default box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DETAIL JADWAL</h3>

        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @if($jdw->konfirmasi == 'Dibatalkan')
                    <li class="small-box bg-danger inner text-center" style="padding : 10px"><b>DIBATALKAN</b></li>
                @elseif($jdw->konfirmasi == 'Selesai')
                    <li class="small-box bg-success inner text-center" style="padding : 10px"><b>SELESAI</b></li>
                @else
                    <li class="small-box bg-warning inner text-center" style="padding : 10px"><b>{{$jdw->konfirmasi}}</li>
                @endif
                <li class="list-group-item"><b>Id Jadwal    : </b>{{$jdw->id_jadwal}}</li>
                @if ($jdw->tanggal_pengambilan == NULL)
                    <li class="list-group-item"><b>Tanggal Pengambilan </b>         : - </li>
                @else
                    <li class="list-group-item"><b>Tanggal Pengambilan </b>         : {{$jdw->tanggal_pengambilan}}</li>
                @endif
                <br>
                    <li class="list-group-item"><b>Id Nasabah   : </b>{{$jdw->nasabah->id_nasabah}} </li>
                    <li class="list-group-item"><b>Nama Nasabah</b>     : {{$jdw->nasabah->nama}}</li>
                    <li class="list-group-item"><b>Alamat Nasabah</b>   : {{$jdw->nasabah->alamat}}</li>
                    <li class="list-group-item"><b>Nomor HP Nasabah </b>         : {{$jdw->nasabah->phone}}</li>
                <br>
                @if($jdw->id_sopir == NULL)
                    <li class="list-group-item"><b>SOPIR BELUM DITAMBAHKAN</b></li>
                @else
                    <li class="list-group-item"><b>Id Sopir : </b>{{$jdw->sopir->id_sopir}}</li>
                    <li class="list-group-item"><b>Nama Sopir</b>     : {{$jdw->sopir->nama}}</li>
                    <li class="list-group-item"><b>Nomor HP Sopir </b>         : {{$jdw->sopir->phone}}</li>
                @endif
                <br>
                    <li class="list-group-item"><b>DAFTAR SETORAN SAMPAH</b><br>
                        <table class="table table-bordered table-striped">
                            <?php
                                $total = 0;
                            ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Sampah</th>
                                <th>Berat</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trs as $k => $i)
                            <tr>
                                <td>{{++$k}}</td>
                                <td>{{$i->sampah->jenis_sampah}}</td>
                                <td>{{$i->berat}}</td> 
                                <td>{{$i->harga}}</td> <?php $total += $i->harga; ?>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"> Total </td>
                                <td><b>Rp {{ number_format($total, 0, ',','.') }},00</b></td>
                            </tr>
                        </tfoot>
                        </table>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-sm btn-primary" href="{{ url('/jadwal') }}">Kembali</a>
                    </li>
            </ul>
        </div>
    </div>
    </section>
@endsection