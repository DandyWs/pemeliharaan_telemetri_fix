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
                  <option value="">Pilih Pemeliharaan</option>
                  @foreach( $pemeliharaan as $pemeliharaan)
                  <option value="{{ $pemeliharaan->id }}" {{ old('id', isset($spr) && $spr->pemeliharaan2_id == $pemeliharaan->id) ? 'selected' : '' }}>
                    {{ $pemeliharaan->tanggal }}
                  </option>
                  @endforeach
                </select>
                @error('pemeliharaan2_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
                </div>
                  <div class="form-group col-md-6">
                    <label>Data Pemeliharaan</label>
                    <ul>
                          <li>Tanggal : {{ $pemeliharaan->tanggal }}</li>
                          <li>Waktu   : {{ $pemeliharaan->waktu }}</li>
                          <li>Periode : {{ $pemeliharaan->periode }}</li>
                    </ul>
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
                      <option value="{{ $user->id }}" {{ old('user_id', isset($spr) && $spr->user_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                      </option>
                      @endforeach
                    </select>
                    @error('user_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Keterangan</label>
                    <textarea
                      name="catatan"
                      class="form-control @error('catatan') is-invalid @enderror"
                      required
                    >{{ old('catatan', isset($spr) ? $spr->keterangan : '') }}</textarea>
                    @error('catatan')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                  <label>Tanda Tangan</label>
                  <div id="signature-pad" class="signature-pad">
                  <div class="signature-pad--body">
                    <canvas id="myCanvas" width="300" height="300" style="border: 1px solid #000;"></canvas>
                  </div>
                  <div class="signature-pad--footer">
                    <button type="button" class="btn btn-sm btn-secondary" id="clear-signature">Hapus</button>
                  </div>
                  </div>
                  <input type="hidden" name="ttd" id="signature">
                  @error('ttd')
                  <span class="error invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>

            </div>
            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/pemeriksaan') }}">Kembali</a>
            </div>
          </form>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          var canvas = document.querySelector("#signature-pad canvas");
          var signaturePad = new SignaturePad(canvas);

          document.getElementById('clear-signature').addEventListener('click', function () {
            signaturePad.clear();
          });

          document.querySelector('form').addEventListener('submit', function () {
            if (!signaturePad.isEmpty()) {
              document.getElementById('signature').value = signaturePad.toDataURL();
            }
          });
        });
      </script>
</section>

@endsection