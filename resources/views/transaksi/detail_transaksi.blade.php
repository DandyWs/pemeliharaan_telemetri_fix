@extends('layouts.template')

@section('content')
<section class="content">

    <!--Default box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DETAIL TRANSAKSI</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widge="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widge="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Id Jadwal    : </b>{{$trs->jadwal->id_jadwal}}</li>
                <br>

                <li class="list-group-item"><b>Jenis Sampah   : </b>{{$trs->sampah->jenis_sampah}} </li>
                    <li class="list-group-item"><b>Harga / kg</b>     : {{$trs->sampah->harga}}</li>
                <br>

                <li class="list-group-item"><b>Berat Setoran :  </b>{{$trs->berat}}</li>
                <li class="list-group-item"><b>Total :  </b>Rp {{ number_format($trs->harga, 0, ',','.') }},00</li>
            </ul>
            <a class="btn btn-success mt-3" href="{{ url('/transaksi') }}">Kembali</a>
        </div>
        
    </div>
       
      
    <!-- /.card -->

    </section>
@endsection