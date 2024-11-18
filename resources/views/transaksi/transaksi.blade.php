@extends('layouts.template')

@section('content')
<section class="content">
  <div >
    {{Breadcrumbs::render('transaksi')}}
  </div>
    <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Daftar Transaksi</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('transaksi/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a>
              <form class="form" method="GET" action="{{ url('transaksi') }}" class="col-md-4" style="padding: 0">
                <div class="form-group w-100 mb-3">
                    <input type="search" name="cari" class="form-control w-75 d-inline"  placeholder="Masukkan keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                </div>
              </form>
            </div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id Jadwal</th>
                  <th>Jenis Sampah</th>
                  <th>Berat</th>
                  <th>Harga</th>
                  <th style="width: 150px">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($transaksi ->count() > 0)
                  @foreach ($transaksi as $i => $k)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$k->jadwal->id_jadwal}}</td>
                      <td>{{$k->sampah->jenis_sampah}}</td>
                      <td>{{$k->berat}}</td>
                      <td>Rp{{$k->harga}},00</td>
                      <td>
                        <a href="{{url('/transaksi/'. $k->id.'/edit')}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>

                        <form class="d-inline-block" method="POST" action="{{url('/transaksi/'.$k->id)}}" onsubmit="return confirm('Yakin hapus data?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-solid fa-trash"></i></button>
                        </form>

                        <a href="{{url('/transaksi/'. $k->id)}}"class="btn btn-sm btn-primary d-inline-block"><i class="fas fa fa-info-circle"></i></a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="6" class="text-center">Data tidak ada</td>
                  </tr>
                @endif
              </tbody>
            </table>
           
          </div>
        </div>
    </div>
</section>
    
@endsection