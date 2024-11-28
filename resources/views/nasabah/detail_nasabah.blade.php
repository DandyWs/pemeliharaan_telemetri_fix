@extends('layouts.template')

@section('content')
<section class="content">

    <!--Default box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DATA USER</h3>

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
                <li class="list-group-item"><b>Id User : </b>{{$nasabah->id}}</li>
                <li class="list-group-item"><b>Nama : </b>{{$nasabah->name}}</li>
                <li class="list-group-item"><b>Email : </b>{{$nasabah->email}}</li>
                <li class="list-group-item"><b>Role : </b>{{$nasabah->role}}</li>
                <a class="btn btn-md btn-primary" href="{{ url('/nasabah') }}">Kembali</a>
            </ul>
        </div>

    </div>


    <!-- /.card -->

    </section>
@endsection
