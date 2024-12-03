@extends('layouts.template')

@section('content')

<section class="content">
    <div class="card">
    <div class="card-header text-center">
            <h2><strong>PEMERIKSAAN LAPORAN PEMELIHARAAN</strong></h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
            @csrf
            {!!(isset($spr))? method_field('PUT') : '' !!}

            
            <div class="row">
                <div class="form-group col-md-6">
                <label>Pilih Pemeliharaan</label>
                <select
                  name="pemeliharaan2_id"
                  class="form-control @error('pemeliharaan2_id') is-invalid @enderror"
                  required
                >
                  <option value="">Pilih Tanggal dan Lokasi Stasiun</option>
                  @foreach( $pemeliharaan as $pemeliharaan)
                  <option value="{{ $pemeliharaan->id }}" {{ old('pemeliharaan2_id', isset($spr) && $spr->pemeliharaan2_id == $pemeliharaan->id) ? 'selected' : '' }}>
                    {{ $pemeliharaan->tanggal }} -- {{ $pemeliharaan->alatTelemetri->lokasiStasiun }}
                  </option>
                  @endforeach
                </select>
                @error('pemeliharaan2_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
                </div>
                
                <div class="form-group col-md-6">
                    <label>Pilih User Pemeriksa</label>
                    <select
                      name="user_id"
                      class="form-control @error('user_id') is-invalid @enderror"
                      required
                    >
                      <option value="">Pilih User</option>
                      @foreach( $user as $user)
                      <option value="{{ $user->id }}" {{ old('pemeliharaan2_id', isset($spr) && $spr->user_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                      </option>
                      @endforeach
                    </select>
                    @error('user_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="form-group col-md-6">
                    <label>TTD</label>
                    @if (!$pemeriksaan->hasBeenSigned())
                        <form action="{{ $pemeliharaan->getSignatureRoute() }}" method="POST">
                            @csrf
                            <div style="text-align: center">
                                <x-creagia-signature-pad />
                            </div>
                        </form>
                        <script src="{{ asset('vendor/sign-pad/sign-pad.min.js') }}"></script>
                    @endif
                </div> --}}
            </div>
            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/pemeriksaan') }}">Kembali</a>
            </div>
          </form>
        </div>
      </div>
</section>

@endsection