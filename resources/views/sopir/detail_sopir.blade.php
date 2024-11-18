@extends('layouts.template')

@section('content')
<section class="content">

    <!--Default box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DATA SOPIR</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Id Sopir : </b>{{$sopir->id_sopir}}</li>
                <li class="list-group-item"><b>Nama : </b>{{$sopir->nama}}</li>
                <li class="list-group-item"><b>Alamat : </b>{{$sopir->alamat}}</li>
                <li class="list-group-item"><b>No. Telepon : </b>{{$sopir->phone}}</li>
                <a class="btn btn-md btn-primary" href="{{ url('/sopir') }}">Kembali</a>
            </ul>
        </div>
        
    </div>
       
      
    <!-- /.card -->

    </section>
@endsection