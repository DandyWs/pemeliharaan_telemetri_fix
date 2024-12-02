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
                      <h6><p class="mb-md-6">
                          Selamat datang di aplikasi Form Pemeliharaan Jasa Tirta I</p></h6>
                  </div>
                </div>
            </div>
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <b><h1>Dashboard Form Pemeliharaan Jasa Tirta I</h1></b>
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
                          <h3 class="card-title"><i class="nav-icon fas fa-home"></i> Telemetri</h3>
                        </div>
                <div class="card-body">
                <section class="content">

                <!-- Default box -->
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        @if (Auth::user()->role == 'admin')
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>{{ $hitungUser }}</h3>
                            <p>User</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-users fa-2x"></i>
                          </div>
                          <a href="{{ url('/user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        @elseif (Auth::user()->role == 'mekanik')
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>{{ $hitungJenis }}</h3>
                            <p>Jenis Alat</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-users fa-2x"></i>
                          </div>
                          <a href="{{ url('/jenisalat') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        @else
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>{{ $hitungPem }}</h3>
                            <p>Pemeliharaan Today</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-users fa-2x"></i>
                          </div>
                          <a href="{{ url('/pemeliharaans') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        @endif
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        @if (Auth::user()->role == 'manager')
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3>{{ $hitungPemKet}}</h3>
                            <p>Pemeliharaan Menunggu Konfirmasi</p>
                          </div>
                          <div class="icon">
                            <i class="nav-icon fas fa-solid fa fa-hammer"></i>
                          </div>
                          <a href="{{ url('/pemeliharaans') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        @else
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3>{{ $hitungKomponen }}</h3>
                            <p>Komponen</p>
                          </div>
                          <div class="icon">
                            <i class="nav-icon fas fa-solid fa fa-puzzle-piece"></i>
                          </div>
                          <a href="{{ url('/komponen') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        @endif
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3>{{ $hitungPemeliharaan }}</h3>

                            <p>Jumlah Form Pemeliharaan</p>
                          </div>
                          <div class="icon">
                            <i class="nav-icon fas fa-solid fa fa-pen"></i>
                          </div>
                          <a href="{{ url('/pemeliharaans') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                          <div class="inner">
                            <h3>{{ $hitungAlat }}</h3>

                            <p>Jumlah Alat</p>
                          </div>
                          <div class="icon">
                            <i class="nav-icon fas fa-solid fa fa-toolbox"></i>
                          </div>
                          <a href="{{ url('/alat') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <b>Data Form Pemeliharaan</b>
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
                                      <th>No.</th>
                                      <th>Waktu Pemeliharaan</th>
                                      <th>Periode</th>
                                      <th>Cuaca</th>
                                      <th>User</th>
                                      <th>Peralatan Telemetri</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if ($transaksi ->count() > 0)
                                      @foreach ($transaksi as $i => $k)
                                        <tr>
                                          <td>{{++$i}}</td>
                                          <td>{{$k->tanggal}}</td>
                                          <td>{{$k->periode}}</td>
                                          <td>{{$k->cuaca}}</td>
                                          <td>{{$k->user->name}}</td>
                                          <td>{{$k->alatTelemetri->lokasiStasiun}}</td>
                                          @if($k->keterangan != NULL)
                                            <td>{{$k->keterangan}}</td>
                                          @else
                                            <td>Menunggu Konfirmasi</td>
                                          @endif
                                          {{-- <td>{{$k->konfirmasi}}</td> --}}
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
                    </div>
                </section>
                </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
@endsection
