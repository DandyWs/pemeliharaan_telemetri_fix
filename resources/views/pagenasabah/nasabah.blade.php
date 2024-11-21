@extends('layouts.sidebar_nasabah')

@section('content')
<section class="content">
  <div >
    {{Breadcrumbs::render('jadwalnasabah')}}
  </div>
  <?php
                  
  $total = 0;
  $jumlah = 0;

  if ($jadwal->count() > 0) {
      foreach ($jadwal as $i => $k) {
          // Calculate the total
          if ($k->konfirmasi == 'Selesai') {
                  $total += $k->harga;
          }
      }
  }
  
  ?>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="saldo">
      <div class="row justify-content-end">
        <div class="col-lg-12 col-3">
          <div class="small-box bg-success">
            <div class="inner text-center">
              <h5>Anda telah menyetorkan sampah senilai <b>Rp {{ number_format($total, 0, ',','.') }},00</b></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="card">
      <div class="container-fluid">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Riwayat Transaksi </b></h3>
          </div>
          <br>
          <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('jadwalnasabah/create')}}" class="btn -btn sm btn-success my-2">Mulai Setor</a>
            </div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id Jadwal</th>
                  <th>Nama Sopir</th>
                  <th>Tanggal Ambil</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($jadwal ->count() > 0)
                  @foreach ($transaksi as $i => $k)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{$k->id_jadwal}}</td>
                        <td>{{$k->sopir->nama ?? "Tidak ada sopir"}}</td>
                        @if($k->tanggal_pengambilan == NULL) 
                          <td>Menunggu Konfirmasi</td>
                        @else  
                          <td>{{$k->tanggal_pengambilan}}</td>
                        @endif
                        <td>
                        <?php
                          $cetak = 0;
                        ?>
                          @foreach($jadwal as $j => $z)
                            @if($z->id_transaksibaru == $k->id_jadwal)
                              <?php
                                $cetak += $z->harga;
                              ?>
                            @endif
                          @endforeach
                          Rp {{ number_format($cetak, 0, ',','.') }}
                        </td>
                        <td>{{$k->konfirmasi}}</td>
                        <td>
                          <div class="pr-1">
                            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailModalTransaksi{{$k->id}}"><i class="fas fa fa-info-circle"></i></a>
                          </div>
                        </td>
                      </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="8" class="text-center">Data tidak ada</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
    </div>
</section>

@foreach ($transaksi as $trs)
<!-- Modal Detail-->
<div class="modal fade" id="detailModalTransaksi{{$trs->id}}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{$trs->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detailModalLabel {{$trs->id}}">Detail Transaksi
                <b>{{ $trs->id_jadwal }}</b>
              </h5>
          </div>
          <div class="modal-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                  @if($trs->konfirmasi == 'Dibatalkan')
                      <li class="small-box bg-danger inner text-center" style="padding : 10px"><b>DIBATALKAN</b></li>
                  @elseif($trs->konfirmasi == 'Selesai')
                      <li class="small-box bg-success inner text-center" style="padding : 10px"><b>SELESAI</b></li>
                  @else
                      <li class="small-box bg-warning inner text-center" style="padding : 10px"><b>{{$trs->konfirmasi}}</b></li>
                  @endif
              </li>
              <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                  Tanggal Ambil
                  <span>
                    @if($trs->tanggal_pengambilan != NULL)
                      {{ $trs->tanggal_pengambilan }}
                    @else 
                      <p>-</p>
                    @endif
                  </span>
                </div>
              </li>
              <li class="list-group-item">
                <div class="align-items-center">
                  DAFTAR SETORAN SAMPAH<br>
                        <table class="table table-borderless">
                            <?php
                                $total = 0;
                                $no = 1;
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
                            @foreach ($jadwal as $k => $i)
                              @if($i->id_transaksibaru == $trs->id_jadwal)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$i->sampah->jenis_sampah}}</td>
                                    <td>{{$i->berat}}</td> 
                                    <td>Rp {{ number_format($i->harga, 0, ',','.') }}</td> <?php $total += $i->harga; ?>
                                </tr>
                              @else
                                <?
                                  continue;
                                ?>
                              @endif
                            @endforeach
                          
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"> <b> Total </b></td>
                                <td><b>Rp {{ number_format($total, 0, ',','.') }},00</b></td>
                            </tr>
                        </tfoot>
                        </table>
                </div>
              </li>
            </ul>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm btn-danger" data-dismiss="modal">Tutup</button>            
            </div>
          </div>
      </div>
  </div>
</div>
@endforeach
                    
@endsection