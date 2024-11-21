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
                {!! (isset($sampah))? method_field('PUT'):''!!}
                
                <div class="form-group">
                  <label>Nama Jenis</label>
                  <input class="form-control @error('namajenis') is-invalid @enderror" value="{{isset($sampah)? $sampah->namajenis : old('namajenis') }}" name="namajenis" type="text"/>
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
                  <select class="form-control @error('setting') is-invalid @enderror" name="setting">
                    <option value="1" {{ (isset($sampah) && $sampah->setting == 1) ? 'selected' : '' }}>True</option>
                    <option value="0" {{ (isset($sampah) && $sampah->setting == 0) ? 'selected' : '' }}>False</option>
                  </select>
                  @error('setting')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div>
                {{-- <div class="form-group">
                  <label>Setting</label>
                  <input class="form-control @error('setting') is-invalid @enderror" value="{{isset($sampah)? $sampah->setting : old('setting') }}" name="setting" type="checkbox"/>
                  @error('setting')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div> --}}
                <div class="form-group mt-3">
                  <button class="btn btn-sm btn-success">Simpan</button>
                  <a class="btn btn-sm btn-primary" href="{{ url('/sampah') }}">Kembali</a>
              </div>
              </form>
      
        </div>
    </div>
   
</section>
@endsection