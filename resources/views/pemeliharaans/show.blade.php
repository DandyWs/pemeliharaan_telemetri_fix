@extends('layouts.template')

@section('content')
<section class="content">

    <!--Default box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Setting</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Tanggal Pemeliharaan : </b>{{$pemeliharaan->tanggal}}</li>
                <li class="list-group-item"><b>Waktu Mulai Pemeliharaan : </b>{{$pemeliharaan->waktu}}</li>
                <li class="list-group-item"><b>Periode Pemeliharaan : </b>{{$pemeliharaan->periode}}</li>
                <li class="list-group-item"><b>Cuaca : </b>{{$pemeliharaan->cuaca}}</li>
                <li class="list-group-item"><b>No Alat Ukur : </b>{{$pemeliharaan->no_alatUkur}}</li>
                <li class="list-group-item"><b>No GSM : </b>{{$pemeliharaan->no_GSM}}</li>
                <li class="list-group-item"><b>User : </b>{{$pemeliharaan->user->name}}</li>
                <li class="list-group-item"><b>Lokasi Stasiun : </b>{{$pemeliharaan->alatTelemetri->lokasiStasiun}}</li>
                <li class="list-group-item"><b>Jenis Peralatan : </b>{{$pemeliharaan->alatTelemetri->jenisAlat->namajenis}}</li>
                <li class="list-group-item"><b>Keterangan : </b>{{$pemeliharaan->keterangan ?? 'Pemeliharaan ' . $pemeliharaan->alatTelemetri->jenisAlat->namajenis}}</li>
            </ul>
            <div class="row">
                @foreach ($komponen as $komponen)
                <div class="col-md-6">
                    <h3 class="card-title">{{ $komponen->nama }}</h3>
                    {{-- @foreach ($komponen->detailKomponen as $detail)
                    @endforeach --}}
                </div>
                @endforeach
            </div>
            <a class="btn btn-md btn-primary" href="{{ url('/pemeliharaans') }}">Kembali</a>
        </div>
        
    </div>
       
      
    <!-- /.card -->

</section>
@endsection
