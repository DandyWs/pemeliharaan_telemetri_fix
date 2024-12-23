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
              <br>
              <div class="row">
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
                                    <input type="hidden" name="detail_komponen_id[{{ $detail->id }}]" value="{{ $detail->id }}" />
                                    <input type="hidden" name="pemeliharaan2_id[{{ $detail->id }}]" value="{{ isset($pemeliharaan) ? $pemeliharaan->id : '' }}" />
                                    <input type="checkbox" name="cheked{{ $detail->id }}" {{ $cheked ? 'checked' : 'disabled' }} class="form-check-input" />
                                    <label class="form-check-label">{{ $detail->namadetail }}</label>
                                </div>
                            @endforeach
                            @error('komponen2_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
              </div>
            <a class="btn btn-md btn-primary" href="{{ url('/pemeliharaans') }}">Kembali</a>
        </div>
    </div>
</section>
@endsection