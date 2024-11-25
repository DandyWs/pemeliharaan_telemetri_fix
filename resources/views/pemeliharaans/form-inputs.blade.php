@extends ('layouts.template')

@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Pemeliharaan</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
                @csrf
                {!! isset($spr) ? method_field('PUT') : '' !!}

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tanggal Pemeliharaan</label>
                        <input
                            type="datetime-local"
                            name="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', isset($spr) ? optional($spr->tanggal)->format('Y-m-d\TH:i:s') : '') }}"
                            required
                        />
                        @error('tanggal')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>Waktu Mulai Pemeliharaan</label>
                        <input
                            type="datetime-local"
                            name="waktu"
                            class="form-control @error('waktu') is-invalid @enderror"
                            value="{{ old('waktu', isset($spr) ? optional($spr->waktu)->format('Y-m-d\TH:i:s') : '') }}"
                            required
                        />
                        @error('waktu')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>Periode Pemeliharaan</label>
                        <input
                            type="text"
                            name="periode"
                            class="form-control @error('periode') is-invalid @enderror"
                            value="{{ old('periode', isset($spr) ? $spr->periode : '') }}"
                            placeholder="Periode Pemeliharaan"
                            required
                        />
                        @error('periode')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>Cuaca</label>
                        <input
                            type="text"
                            name="cuaca"
                            class="form-control @error('cuaca') is-invalid @enderror"
                            value="{{ old('cuaca', isset($spr) ? $spr->cuaca : '') }}"
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
                            value="{{ old('no_alatUkur', isset($spr) ? $spr->no_alatUkur : '') }}"
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
                            value="{{ old('no_GSM', isset($spr) ? $spr->no_GSM : '') }}"
                            placeholder="No GSM"
                            required
                        />
                        @error('no_GSM')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>User</label>
                        <select
                            name="user_id"
                            class="form-control @error('user_id') is-invalid @enderror"
                            required
                        >
                            <option disabled {{ old('user_id', isset($spr) ? $spr->user_id : '') == '' ? 'selected' : '' }}>Pilih User</option>
                            @foreach($users as $value => $label)
                            <option value="{{ $value }}" {{ old('user_id', isset($spr) ? $spr->user_id : '') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>Lokasi Stasiun</label>
                        <select
                            name="alat_telemetri_id"
                            class="form-control @error('alat_telemetri_id') is-invalid @enderror"
                            required
                        >
                            <option disabled {{ old('alat_telemetri_id', isset($spr) ? $spr->alat_telemetri_id : '') == '' ? 'selected' : '' }}>Pilih Lokasi Stasiun</option>
                            @foreach($alatTelemetri as $value => $label)
                            <option value="{{ $value }}" {{ old('alat_telemetri_id', isset($spr) ? $spr->alat_telemetri_id : '') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('alat_telemetri_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    <a href="{{ url('/pemeliharaan') }}" class="btn btn-sm btn-primary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
