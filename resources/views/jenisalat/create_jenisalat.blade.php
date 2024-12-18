@extends ('layouts.template')

@section('content')
<section class="content">

    <!-- Default Box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Jenis Alat</h3>
            <br>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
                @csrf
                {!! (isset($jenisalat))? method_field('PUT'):''!!}
                
                <div class="form-group">
                  <label>Nama Jenis</label>
                  <input class="form-control @error('namajenis') is-invalid @enderror" value="{{isset($jenisalat)? $jenisalat->namajenis : old('namajenis') }}" name="namajenis" type="text"/>
                  @error('namajenis')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div>
                {{-- <div class="form-group">
                  <label>Gambar</label>
                  <input class="form-control" name="foto" type="file" required="required">
                  @error('foto')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div> --}}
                <div class="form-group">
                    <label>Setting</label>
                    <input type="hidden" name="setting" value="0">
                    <input class="form-control @error('setting') is-invalid @enderror" type="checkbox" name="setting" value="1" {{ (isset($jenisalat) && $jenisalat->setting == 1) ? 'checked' : '' }}>
                    @error('setting')
                    <span class="error invalid-feedback">{{ $message }} </span>
                    @enderror
                </div>
                {{-- <div class="form-group">
                  <label>Setting</label>
                  <input class="form-control @error('setting') is-invalid @enderror" value="{{isset($jenisalat)? $jenisalat->setting : old('setting') }}" name="setting" type="checkbox"/>
                  @error('setting')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div> --}}
                <div class="form-group mt-3">
                  <button class="btn btn-sm btn-success">Simpan</button>
                  <a class="btn btn-sm btn-primary" href="{{ url('/jenisalat') }}">Kembali</a>
              </div>
              </form>
      
        </div>
    </div>
   
</section>
@endsection