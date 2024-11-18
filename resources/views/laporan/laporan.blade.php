@extends('layouts.template')

@section('content')
<section class="content">
  <div >
    {{Breadcrumbs::render('transaksi')}}
  </div>
  <div class="form-group text-left"><a href="{{url('/grafik_penjualan/')}}" class="btn btn-sm btn-success">Lihat Grafik</a></div>


 <div class="card">
  <div class="card-body">
    <form action="{{ route('laporan.cetak') }}" method="POST">
      @csrf
      <div class="input-group mb-3 mt-2">
        <label style="padding-right: 30px" class="mb-3" for="tanggal_awal">Tanggal Awal:</label>
        <input class="form-control" type="date" id="tanggal_awal" name="tanggal_awal">
      </div>
      <div class="input-group mb-3 mt-2">
        <label style="padding-right: 27px" class="mb-3" for="tanggal_akhir">Tanggal Akhir:</label>
        <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir">
      </div>
      <button class="btn btn-sm btn-primary btn-block" type="submit">Cetak Laporan PDF    <i class="fa fa-print" aria-hidden="true"></i></button>
  </form>
  
  </div>

 </div>
  
</section>
    
@endsection