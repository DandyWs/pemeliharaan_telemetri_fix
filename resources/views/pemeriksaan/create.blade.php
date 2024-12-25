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
                <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->alatTelemetri->lokasiStasiun }} -- {{ $pemeliharaan->alatTelemetri->jenisAlat->namajenis }}</p>
              <input type="hidden" name="pemeliharaan2_id" value="{{ $pemeliharaan->id }}">
              </div>
              <div class="form-group col-md-6">
              <label>Tanggal Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->tanggal }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Periode Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->periode }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Waktu Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->waktu }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Pelaksana Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->user->name }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Cuaca</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->cuaca }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>No Alat Ukur</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->no_alatUkur }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>No GSM</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->no_GSM }}</p>
              </div>
            </div>
            {{-- <div class="row"> --}}
              @foreach ($komponen as $komp)
                  <div class="form-group col-md-6"> 
                      <label>{{ $komp->nama }}</label>
                      @foreach ($detailKomponen->where('komponen2_id', $komp->id) as $detail)
                          @php
                              $cheked = false;
                              if (in_array($detail->id, $formKomponen)) {
                                  $cheked = true;
                              }
                          @endphp
                          <div class="form-check">
                              <input type="hidden"  value="{{ $detail->id }}" />
                              <input type="hidden"  value="{{ isset($pemeliharaan) ? $pemeliharaan->id : '' }}" />
                              <input type="checkbox" {{ $detail->id }}" {{ $cheked ? 'checked' : 'disabled' }} class="form-check-input" />
                              <label class="form-check-label">{{ $detail->namadetail }}</label>
                          </div>
                      @endforeach
                      @error('komponen2_id')
                          <span class="error invalid-feedback">{{ $message }}</span>
                      @enderror
                  </div>
              @endforeach
            </div>
            <h2 class=" card-header text-center"><strong>PEMERIKSAAN LAPORAN PEMELIHARAAN</strong></h2>
            <div class="row">
              <div class="form-group col-md-6">
                <label>User Pemeriksa</label>
                <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ Auth::user()->name }}</p>
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
                  <div id="sig" class="kbw-signature">
                  </div>
                  <input type="text" id="signature64" name="ttd" style="display: none">
                  <div class="signature-pad--footer">
                  <button type="button" class="btn btn-sm btn-secondary" id="clear">Hapus</button>

                  </div>
                </div>
                @error('ttd')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>

            </div>
            <div class="form-group mt-3">
              <button name="submit" class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/pemeriksaan') }}">Kembali</a>
            </div>
            </form>
        </div>
      </div>

      <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
</section>

@endsection