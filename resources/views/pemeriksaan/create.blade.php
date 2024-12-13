@extends('layouts.template')

@section('content')

<section class="content">
    <div class="card">
        <div class="card-header text-center">
            <h2><strong>LAPORAN PEMELIHARAAN DAN</strong></h2>
            <h2><strong>KALIBRASI INTERNAL PERALATAN TELEMETRI GSM</strong></h2>
            </h2>
            <br>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
            @csrf
            {!!(isset($spr))? method_field('PUT') : '' !!}

            <div class="row">
              <div class="form-group col-md-6">
                <label>Nama Stasiun -- Jenis Alat</label>
                <input type="text"  class="form-control" value="{{ $pemeliharaan->alatTelemetri->lokasiStasiun }} -- {{ $pemeliharaan->alatTelemetri->jenisAlat->namajenis }}" readonly />
                <input type="hidden" name="pemeliharaan2_id" value="{{ $pemeliharaan->id }}">
              </div>
              <div class="form-group col-md-6">
                <label>Tanggal Pemeliharaan</label>
                    <input type="text"  class="form-control" value="{{ $pemeliharaan->tanggal }}" readonly />
              </div>
              <div class="form-group col-md-6">
                <label>Periode Pemeliharaan</label>
                    <input type="text" class="form-control" value="{{ $pemeliharaan->periode }}" readonly />
              </div>
              <div class="form-group col-md-6">
                <label>Waktu Pemeliharaan</label>
                    <input type="text"  class="form-control" value="{{ $pemeliharaan->waktu }}" readonly />
              </div>
              <div class="form-group col-md-6">
                <label>Pelaksana Pemeliharaan</label>
                <input type="text"  class="form-control" value="{{ $pemeliharaan->user->name }}" readonly />
              </div>
              <div class="form-group col-md-6">
                <label>Cuaca</label>
                    <input type="text"  class="form-control" value="{{ $pemeliharaan->cuaca }}" readonly />
              </div>
              <div class="form-group col-md-6">
                <label>No Alat Ukur</label>
                    <input type="text"  class="form-control" value="{{ $pemeliharaan->no_alatUkur }}" readonly />
              </div>
              <div class="form-group col-md-6">
                <label>No GSM</label>
                    <input type="text"  class="form-control" value="{{ $pemeliharaan->no_GSM }}" readonly />
              </div>
            </div>
            <h2 class=" card-header text-center"><strong>PEMERIKSAAN LAPORAN PEMELIHARAAN</strong></h2>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>User Pemeriksa</label>
                    <input type="text"  class="form-control" value="{{ Auth::user()->name }}" readonly />
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </div>

                <div class="form-group col-md-6">
                    <label>Catatan</label>
                    <textarea
                      name="catatan"
                      class="form-control @error('catatan') is-invalid @enderror"
                      required
                    >{{ old('catatan', isset($spr) ? $spr->catatan : '') }}</textarea>
                    @error('catatan')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12 text-center">
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