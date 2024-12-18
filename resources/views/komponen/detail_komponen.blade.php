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
                {{-- <li class="list-group-item"><b>Id Komponen : </b>{{$komponen->id}}</li> --}}
                <li class="list-group-item"><b>Nama : </b>{{$komponen->nama}}</li>
                {{-- <li class="list-group-item"><b>Alamat : </b>{{$komponen->alamat}}</li>
                <li class="list-group-item"><b>No. Telepon : </b>{{$komponen->phone}}</li> --}}
                <a class="btn btn-md btn-primary" href="{{ url('/komponen') }}">Kembali</a>
            </ul>
        </div>
        
    </div>
       
      
    <!-- /.card -->

    </section>
@endsection