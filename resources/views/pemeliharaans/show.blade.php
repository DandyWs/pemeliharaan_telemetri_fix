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
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Lokasi Stasiun : </b>{{$pemeliharaan->alatTelemetri->lokasiStasiun}}</li>
                        <li class="list-group-item"><b>Jenis Peralatan : </b>{{$pemeliharaan->alatTelemetri->jenisAlat->namajenis}}</li>
                        <li class="list-group-item"><b>Tanggal Pemeliharaan : </b>{{$pemeliharaan->tanggal}}</li>
                        <li class="list-group-item"><b>Waktu Mulai Pemeliharaan : </b>{{$pemeliharaan->waktu}}</li>
                        <li class="list-group-item"><b>Periode Pemeliharaan : </b>{{$pemeliharaan->periode}}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Cuaca : </b>{{$pemeliharaan->cuaca}}</li>
                        <li class="list-group-item"><b>No Alat Ukur : </b>{{$pemeliharaan->no_alatUkur}}</li>
                        <li class="list-group-item"><b>No GSM : </b>{{$pemeliharaan->no_GSM}}</li>
                        <li class="list-group-item"><b>User : </b>{{$pemeliharaan->user->name}}</li>
                        <li class="list-group-item"><b>Keterangan : </b>{{$pemeliharaan->keterangan ?? 'Pemeliharaan ' . $pemeliharaan->alatTelemetri->jenisAlat->namajenis}}</li>
                    </ul>
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