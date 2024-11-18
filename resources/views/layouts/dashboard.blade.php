@extends ('layouts.template')

@section('content')
    
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <h6 class="alert alert-success">{{ session('message')}},</h6>
            @endif
            <div class="card">
                <div class="card-header border-0">
            <div class="me-md-3 me-xl-5">
                <h6><p class="mb-md-6">Selamat Datang Admin Bank Sampah</p></h6>
            </div>
            </div>
        </div>
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <b><h1>Dashboard Bank Sampah Malang</h1></b>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div>
              </div>

                <div class="card-header border-0">
                    <!-- Main content -->
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title"><i class="nav-icon fas fa-home"></i> Dashboard</h3>
                        </div>
                        <div class="card-body">
                <section class="content">

                <!-- Default box -->
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>{{ $hitungNasabah }}</h3>
                            <p>Nasabah</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-users fa-2x"></i>
                          </div>
                          <a href="{{ url('/nasabah') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3>{{ $hitungSopir }}</h3>
                            <p>Sopir</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-truck"></i>
                          </div>
                          <a href="{{ url('/sopir') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3>{{ $hitungSampah }}</h3>
            
                            <p>Jenis Sampah</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-trash"></i>
                          </div>
                          <a href="{{ url('/sampah') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                          <div class="inner">
                            <h3>{{ $hitungJadwal }}</h3>
            
                            <p>Jadwal</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <a href="{{ url('/jadwal') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <b>Data Transaksi Bank Sampah</b>
                        </div>
                        <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
                            <form class="form" method="GET" action="{{ url('transaksi') }}" class="col-md-4" style="padding: 0">
                              <div class="form-group w-100 mb-3">
                              </div>
                            </form>

                            <div class="card-body">
                             
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Id Jadwal</th>
                                      <th>Nama Nasabah</th>
                                      <th>Nama Sopir</th>
                                      <th>Tanggal Ambil</th>
                                      <th>Konfirmasi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if ($transaksi ->count() > 0)
                                      @foreach ($transaksi as $i => $k)
                                        <tr>
                                          <td>{{++$i}}</td>
                                          <td>{{$k->id_jadwal}}</td>
                                          <td>{{$k->nasabah->nama}}</td>
                                          <td>{{$k->sopir->id_sopir ?? "Sopir tidak ada"}}</td>
                                          @if($k->tanggal_pengambilan != NULL)
                                            <td>{{$k->tanggal_pengambilan}}</td>
                                          @else
                                            <td>Menunggu Konfirmasi</td>
                                          @endif
                                          <td>{{$k->konfirmasi}}</td>
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