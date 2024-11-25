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
            <h3 class="card-title"> Data Pemeliharaan </h3>
            <br>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
            @csrf
            {!!(isset($spr))? method_field('PUT') : '' !!}

            

            <div class="form-group">
              <label>Nilai Simulasi</label>
              <input class="form-control @error('simulasi') is-invalid @enderror" value="{{ isset($spr)? $spr->simulasi :old('simulasi') }}" name="simulasi" type="text"/>
              @error('simulasi')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Nilai Display</label>
              <input class="form-control @error('display') is-invalid @enderror" value="{{ isset($spr)? $spr->display :old('display') }}" name="display" type="text"/>
              @error('display')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror

            {{-- <div class="form-group"> --}}
              {{-- <label>Form Komponen ID</label> --}}
                {{-- <select class="form-control @error('form_komponen_id') is-invalid @enderror" name="form_komponen_id"> --}}
                {{-- <option value="" Pilih Komponen </option> --}}
                {{-- @foreach($sopir as $komp) --}}
                  {{-- <option value="{{ $komp->id }}" {{ (isset($spr) && $spr->form_komponen_id == $komp->id) ? 'selected' : '' }}>{{ $komp->id }}</option> --}}
                {{-- @endforeach --}}
                {{-- </select> --}}
                {{-- @error('form_komponen_id') --}}
                  {{-- <span class="error invalid-feedback">{{ $message }} </span> --}}
                {{-- @enderror --}}
            {{-- </div> --}}

            {{--  --}}
            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/pemeliharaans') }}">Kembali</a>
          </div>
          </form>
        </div>
@endsection
