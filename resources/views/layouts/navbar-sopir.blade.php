<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
      <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
          <div class="dropdown">
              <div class="mt-1 d-flex" role="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="profile rounded-circle mr-2">
                      @if (Auth::user()->role == "admin")
                          <img src="assets/dist/img/profile.png" class="" alt="User Image" width="40px">
                      @elseif(Auth::user()->role == "nasabah")
                        @if (empty($nasabah->foto))
                            <img src="assets/dist/img/profile.png" class="" alt="User Image" width="40px">
                        @else
                            <img src="{{asset('storage/nasabahprofile/'.$nasabah->foto)}}" class="elevation-2 img-fluid img-thumbnail rounded-circle" width="40px" alt="User Image">
                        @endif
                      @else
                        @if (empty($sopir->foto))
                            <img src="assets/dist/img/profile.png" class="" alt="User Image" width="40px">
                        @else
                          <img src="{{asset('storage/sopirprofile/'.$sopir->foto)}}" class="elevation-2 img-fluid img-thumbnail rounded-circle" width="40px" alt="User Image">
                        @endif
                     @endif
                  </div>
              </div>
              <div class="dropdown-menu dropdown-menu-right fade" style="min-width: 0; border: none; padding: 0;">
                  <a class="dropdown-item btn btn-success" data-toggle="modal" data-target="#detailModal">
                      <i class="fas fa-info-circle mr-2"></i> Detail
                  </a>
                  @if (Auth::user()->role == "admin")
                    <a class="dropdown-item btn btn-success" data-toggle="modal" data-target="" style="pointer-events: none; cursor: default; opacity: 0.5;">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>                    
                    @elseif (Auth::user()->role == "nasabah")
                    <a class="dropdown-item btn btn-success" data-toggle="modal" data-target="#editModalNasabah{{ $nasabah->id }}">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    @else
                    <a class="dropdown-item btn btn-success" data-toggle="modal" data-target="#editModalSopir{{ $sopir->id }}">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    @endif
                  <a class="dropdown-item btn btn-success" href="{{ url('/logout') }}">
                      <i class="fas fa-sign-out-alt mr-2"></i> Logout
                  </a>
              </div>              
          </div>
      </li>
  </ul>
  </nav>
  
  <!-- Modal Detail-->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail
                    {{ auth()->user()->name }}
                </h5>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="image-preview">
                        @if (Auth::user()->role == "admin")
                            <img src="assets/dist/img/profile.png" class="rounded-circle" width="100px" alt="User Image">
                        @elseif(Auth::user()->role == "nasabah")
                            @if (empty($nasabah->foto))
                                <img src="assets/dist/img/profile.png" class="" alt="User Image" width="100px">
                            @else
                                <img src="{{asset('storage/nasabahprofile/'.$nasabah->foto)}}" class="img-thumbnail" alt="User Image">
                            @endif
                        @else
                            @if (empty($sopir->foto))
                                <img src="assets/dist/img/profile.png" class="" alt="User Image" width="40px">
                            @else
                                <img src="{{asset('storage/sopirprofile/'.$sopir->foto)}}" class="elevation-2 img-fluid img-thumbnail rounded-circle" width="40px" alt="User Image">
                            @endif
                        @endif
                    </div>
                </div>
                @if (Auth::user()->role == "admin")
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Nama</b>
                          <span>
                            {{ auth()->user()->name }}
                          </span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Email</b>
                          <span>
                            {{ auth()->user()->email }}
                          </span>
                      </div>
                  </li>
                </ul>
                @elseif (Auth::user()->role == "sopir")
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Nama</b>
                          <span>
                            {{ Auth::user()->sopir->nama }}
                          </span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Email</b>
                          <span>
                            {{ Auth::user()->sopir->email }}
                          </span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Alamat</b>
                          <span>
                            {{ Auth::user()->sopir->alamat }}
                          </span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Nomor Handphone</b>
                          <span>
                            {{Auth::user()->sopir->phone}}
                          </span>
                      </div>
                  </li>
                </ul>
                @else
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Nama</b>
                          <span>
                            {{ $nasabah->nama }}
                          </span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Email</b>
                          <span>
                            {{ $nasabah->email }}
                          </span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Alamat</b>
                          <span>
                            {{ $nasabah->alamat }}
                          </span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-center">
                          <b>Nomor Handphone</b>
                          <span>
                            {{ $nasabah->phone }}
                          </span>
                      </div>
                  </li>
              </ul>
              @endif
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm btn-danger" data-dismiss="modal">Tutup</button>            
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModalSopir{{ $sopir->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalSopirLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalSopirLabel"><strong>Edit Sopir </strong>{{ $sopir->nama }}</h5>
        </div>
        <div class="modal-body">
          <form id="editForm{{$sopir->id}}" method="POST" action="{{ url('/jadwalsopir')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">ID Sopir</label>
                  <input readonly="text" class="form-control @error('id_sopir') is-invalid @enderror" id="id_sopir" name="id_sopir" value="{{ $sopir->id_sopir }}">
                  @error('id_sopir')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $sopir->nama }}" placeholder="Masukkan Nama">
                  @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="name">Alamat</label>
                  <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{  $sopir->alamat }}" placeholder="Masukkan Alamat">
                  @error('alamat')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $sopir->email }}" placeholder="Masukkan Email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="name">Nomor Handphone</label>
                  <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $sopir->phone }}" placeholder="Masukkan Nomor Handphone">
                  @error('phone')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm btn-danger" data-dismiss="modal">Batal</button> 
            <button type="submit" class="btn btn-primary btn-sm btn-success" form="editForm{{ $sopir->id }}">{{ __('Ubah') }}</button>
        </div>
      </div>                              
    </div>
  </div>

