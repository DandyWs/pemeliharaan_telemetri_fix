@extends('layouts.template')

@section('content')
{{-- <div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('pemeliharaans.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.forms.create_title')
            </h4>

            <x-form
                method="POST"
                action="{{ route('pemeliharaans.store') }}"
                class="mt-4"
            >
                @include('app.pemeliharaans.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('pemeliharaans.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div> --}}
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Form Pemeliharaan Telemetri </h3>
            <br>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
            @csrf
            {!!(isset($spr))? method_field('PUT') : '' !!}

            
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
                  <option value="{{ $alat->id }}" {{ old('alat_telemetri_id', isset($spr) && $spr->alat_telemetri_id == $alat->id) ? 'selected' : '' }}>
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
                <input
                  type="datetime-local"
                  name="tanggal"
                  class="form-control @error('tanggal') is-invalid @enderror"
                  value="{{ old('tanggal', isset($spr) ? optional($spr->tanggal)->format('Y-m-d\TH') : '') }}"
                  required
                />
                @error('tanggal')
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
              <label>Waktu Mulai Pemeliharaan</label>
                <input
                  type="datetime-local"
                  name="waktu"
                  class="form-control @error('waktu') is-invalid @enderror"
                  value="{{ old('waktu', isset($spr) ? optional($spr->waktu)->format('Y-m-d\TH') : '') }}"
                  required
                />
                @error('waktu')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
              <label>Pelaksana Pemeliharaan</label>
              <select
              name="user_id"
              class="form-control @error('user_id') is-invalid @enderror"
              required
              >
              <option value="">Pilih Mekanik</option>
              @foreach($user as $user)
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

      

            

            {{-- <div class="form-group col-md-6">
              <label>Lokasi Stasiun</label>
              <input class="form-control @error('lokasiStasiun') is-invalid @enderror" value="{{ isset($spr)? $spr->alat->lokasiStasiun :old('lokasiStasiun') }}" name="lokasiStasiun" type="text"/>
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
                <option value="{{ $jenis->id }}" {{ old('jenis_alat', isset($spr) && $spr->alat_telemetri_id == $alat->id) ? 'selected' : '' }}>
                  {{ $jenis->namajenis }}
                </option>
                @endforeach
              </select>
              @error('alat_telemetri_id')
              <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div> --}}

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
@endsection
