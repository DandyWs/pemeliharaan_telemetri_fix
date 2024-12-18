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
          <form action="{{ isset($pemeliharaan) ? $url_form : url('/pemeliharaans') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {!!(isset($pemeliharaan))? method_field('PUT') : '' !!}

            <div class="row">
              <div class="form-group col-md-6">
                <label>Nama Stasiun -- Jenis Alat</label>
                <select
                  name="alat_telemetri_id"
                  class="form-control @error('alat_telemetri_id') is-invalid @enderror"
                  required
                >
                  <option value="">Pilih Peralatan Telemetri</option>
                  @foreach( $alat as $alat)
                  <option value="{{ $alat->id }}" {{ old('alat_telemetri_id', isset($pemeliharaan) && $pemeliharaan->alat_telemetri_id == $alat->id) ? 'selected' : '' }}>
                    {{ $alat->lokasiStasiun }} -- {{ $alat->jenisAlat->namajenis }}
                  </option>
                  @endforeach
                </select>
                @error('alat_telemetri_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Tanggal Pemeliharaan</label>
                {{-- <input
                  type="date"
                  name="tanggal"
                  class="form-control @error('tanggal') is-invalid @enderror"
                  value="{{ old('tanggal', isset($pemeliharaan) ? optional($pemeliharaan->tanggal)->format('Y-m-d') : '') }}"
                  required
                /> --}}
                <input type="date" name="tanggal" class="form-control" value="{{ isset($pemeliharaan) ? $pemeliharaan->tanggal : old('tanggal') }}">
                @error('tanggal')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
              <label>Periode Pemeliharaan</label>
                <input type="text" name="periode" class="form-control @error('periode') is-invalid @enderror" value="{{ old('periode', isset($pemeliharaan) ? $pemeliharaan->periode : '') }}" placeholder="Periode" required />
                @error('periode')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
              <label>Waktu Mulai Pemeliharaan</label>
              <input type="time" name="waktu" class="form-control" value="{{ isset($pemeliharaan) ? $pemeliharaan->waktu : old('waktu') }}">
                @error('waktu')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
              <label>Pelaksana Pemeliharaan</label>
                <input
                type="hidden"
                name="user_id"
                value="{{ Auth::user()->id }}"
                />
                <input
                type="text"
                class="form-control"
                value="{{ Auth::user()->name }}"
                readonly
                />
                @error('user_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
              <label>Cuaca</label>
                <input
                  type="text"
                  name="cuaca"
                  class="form-control @error('cuaca') is-invalid @enderror"
                  value="{{ old('cuaca', isset($pemeliharaan) ? $pemeliharaan->cuaca : '') }}"
                  placeholder="Cuaca"
                  required
                />
                @error('cuaca')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group col-md-6">
              <label>No Alat Ukur</label>
                <input
                  type="text"
                  name="no_alatUkur"
                  class="form-control @error('no_alatUkur') is-invalid @enderror"
                  value="{{ old('no_alatUkur', isset($pemeliharaan) ? $pemeliharaan->no_alatUkur : '') }}"
                  placeholder="No Alat Ukur"
                  required
                />
                @error('no_alatUkur')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
              <label>No GSM</label>
                <input
                  type="text"
                  name="no_GSM"
                  class="form-control @error('no_GSM') is-invalid @enderror"
                  value="{{ old('no_GSM', isset($pemeliharaan) ? $pemeliharaan->no_GSM : '') }}"
                  placeholder="No GSM"
                  required
                />
                @error('no_GSM')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
            @foreach ($komponen as $komp)
            <div class="form-group col-md-6">
              <label>
                {{ $komp->nama }}
              </label>
              @foreach ($detailKomponen->where('komponen2_id', $komp->id) as $detail)
                <div class="form-check">
                    <input
                    type="hidden"
                    name="detail_komponen_id[{{ $detail->id }}]"
                    value="{{ $detail->id }}"
                    />
                    <input
                    type="hidden"
                    name="pemeliharaan2_id[{{ $detail->id }}]"
                    value="{{ isset($pemeliharaan) ? $pemeliharaan->id : '' }}"
                    />
                    <input
                    type="hidden"
                    name="cheked[{{ $detail->id }}]"
                    value="0"
                    />
                    <input
                    type="checkbox"
                    name="cheked[{{ $detail->id }}]"
                    value="1"
                    class="form-check-input"
                    {{ old('cheked' . $detail->id, isset($pemeliharaan) && $pemeliharaan->formKomponen->where('komponen2_id', $detail->id)->first()->cheked) ? 'checked' : '' }}
                    />
                  {{-- <input
                    type="checkbox"
                    name="komponen2_id"
                    value="{{ $detail->id }}"
                    class="form-check-input"
                    {{ in_array($detail->id, old('komponen2_id', isset($pemeliharaan) ? $pemeliharaan->komponen->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                  /> --}}
                  <label class="form-check-label">{{ $detail->namadetail }}</label>
                </div>
              @endforeach
              @error('komponen2_id')
              <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
            @endforeach
            </div>
            
            {{-- <div class="form-group col-md-6">
              <label>Lokasi Stasiun</label>
              <input class="form-control @error('lokasiStasiun') is-invalid @enderror" value="{{ isset($pemeliharaan)? $pemeliharaan->alat->lokasiStasiun :old('lokasiStasiun') }}" name="lokasiStasiun" type="text"/>
              @error('lokasiStasiun')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div> --}}

            {{-- <div class="form-group col-md-6">
              <label>Jenis Peralatan</label>
              <select
                name="jenis_alat"
                class="form-control @error('jenis_alat') is-invalid @enderror"
                required
              >
                <option value="">Pilih Jenis Alat</option>
                @foreach( $jenisAlat as $jenis)
                <option value="{{ $jenis->id }}" {{ old('jenis_alat', isset($pemeliharaan) && $pemeliharaan->alat_telemetri_id == $alat->id) ? 'selected' : '' }}>
                  {{ $jenis->namajenis }}
                </option>
                @endforeach
              </select>
              @error('alat_telemetri_id')
              <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div> --}}

            <div class="card-body">
            <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
                @csrf
                {!!(isset($spr))? method_field('PUT') : '' !!}
              <!-- Grid Layout -->
              <div class="d-flex justify-content-between">
                    <!-- Setting Tipping Bucket -->
                    <div>
                        <p>Penunjukan Data Setting di Display (LCD)</p>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th colspan="2">Sebelum Kalibrasi</th>
                                    <th colspan="2">Sesudah Kalibrasi</th>
                                </tr>
                                <tr>
                                    <th>Simulasi</th>
                                    <th>Display</th>
                                    <th>Simulasi</th>
                                    <th>Display</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="simulasi_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="display_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="simulasi_sesudah" class="form-control" /></td>
                                    <td><input type="text" name="display_sesudah" class="form-control" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Setting Sensor Water Level -->
                    <div>
                        <p>Penunjukan Data Setting di Display (LCD)</p>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th colspan="2">Sebelum Kalibrasi</th>
                                    <th colspan="2">Sesudah Kalibrasi</th>
                                </tr>
                                <tr>
                                    <th>Aktual</th>
                                    <th>Display</th>
                                    <th>Aktual</th>
                                    <th>Display</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="aktual_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="display_aktual_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="aktual_sesudah" class="form-control" /></td>
                                    <td><input type="text" name="display_aktual_sesudah" class="form-control" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group col-md-12" style="margin-top: 20px;">
              <label>Keterangan</label>
                <textarea
                name="keterangan"
                class="form-control @error('keterangan') is-invalid @enderror"
                >{{ old('keterangan', isset($pemeliharaan) ? $pemeliharaan->keterangan : '') }}</textarea>
                @error('keterangan')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>

            <!-- <div class="form-group col-md-6">
              <label>Tanggal Pemeliharaan</label>
              <input class="form-control @error('simulasi') is-invalid @enderror" value="{{ isset($spr)? $spr->simulasi :old('simulasi') }}" name="simulasi" type="text"/>
              @error('simulasi')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div> -->

            <!-- <div class="form-group">
              <label>Nilai Display</label>
              <input class="form-control @error('display') is-invalid @enderror" value="{{ isset($spr)? $spr->display :old('display') }}" name="display" type="text"/>
              @error('display')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div> -->

            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/pemeliharaans') }}">Kembali</a>
            </div>
          </form>
        </div>
      </div>
</section>
@endsection
