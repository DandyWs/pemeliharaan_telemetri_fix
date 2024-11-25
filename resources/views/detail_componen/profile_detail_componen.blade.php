@extends('layouts.template')

@section('content')
<section class="content">

    <!--Default box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Komponen</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                {{-- <li class="list-group-item"><b>Id Detail_componen : </b>{{$detail_componen->id}}</li> --}}
                <li class="list-group-item"><b>Nama detail : </b>{{$detail_componen->namadetail}}</li>
                <li class="list-group-item"><b>Nama Komponen : </b>{{$detail_componen->komponen2->nama}}</li>
                {{-- <li class="list-group-item"><b>Alamat : </b>{{$detail_componen->alamat}}</li>
                <li class="list-group-item"><b>No. Telepon : </b>{{$detail_componen->phone}}</li> --}}
                <a class="btn btn-md btn-primary" href="{{ url('/detail_componen') }}">Kembali</a>
            </ul>
        </div>
        
    </div>
       
      
    <!-- /.card -->

    </section>
@endsection