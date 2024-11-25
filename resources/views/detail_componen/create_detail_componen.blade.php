@extends ('layouts.template')

@section('content')
<section class="content">

    <!-- Default Box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Data Komponen </h3>
            <br>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
            @csrf
            {!!(isset($spr))? method_field('PUT') : '' !!}

            

            <div class="form-group">
              <label>Nama Detail komponen</label>
              <input class="form-control @error('namadetail') is-invalid @enderror" value="{{ isset($spr)? $spr->namadetail :old('namadetail') }}" name="namadetail" type="text"/>
              @error('namadetail')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Nama Komponen</label>
                <select class="form-control @error('komponen2_id') is-invalid @enderror" name="komponen2_id">
                {{-- <option value="" Pilih Komponen </option> --}}
                @foreach($komponen2 as $komp)
                  <option value="{{ $komp->id }}" {{ (isset($spr) && $spr->komponen2_id == $komp->id) ? 'selected' : '' }}>{{ $komp->nama }}</option>
                @endforeach
                </select>
                @error('komponen2_id')
                <span class="error invalid-feedback">{{ $message }} </span>
                @enderror
            </div>

            {{--  --}}
            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/detail_componen') }}">Kembali</a>
          </div>
          </form>
        </div>
    </div>
   
   
</section>
@endsection

{{-- @extends ('layouts.template') --}}

{{-- @section('content') --}}
{{-- <section class="content"> --}}

    {{-- <!-- Default Box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Data User </h3>
            <br>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
            @csrf
            {!!(isset($nsb))? method_field('PUT') : '' !!}

            <div class="form-group">
              <label>Id Nasabah</label>
              <input class="form-control @error('id_nasabah') is-invalid @enderror" value="{{ isset($nsb)? $nsb->id_nasabah : old('id_nasabah') }}" name="id_nasabah" type="text" />
              @error('id_nasabah')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Namadetail</label>
              <input class="form-control @error('namadetail') is-invalid @enderror" value="{{ isset($nsb)? $nsb->namadetail :old('namadetail') }}" name="namadetail" type="text"/>
              @error('namadetail')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>
            {{-- <div class="form-group">
              <label>Foto</label>
              <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" onchange="previewPhotoCreate()" style="padding: 0; height: 100%;">
              @error('foto')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div> --}}
            {{-- <div class="form-group">
                <label>Alamat</label>
                <input class="form-control @error('alamat') is-invalid @enderror" value="{{ isset($nsb)? $nsb->alamat :old('alamat') }}" name="alamat" type="text"/>
                @error('alamat')
                  <span class="error invalid-feedback">{{ $message }} </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Nomor HP</label>
                <input class="form-control @error('phone') is-invalid @enderror" value="{{ isset($nsb)? $nsb->phone :old('phone') }}" name="phone" type="text"/>
                @error('phone')
                  <span class="error invalid-feedback">{{ $message }} </span>
                @enderror
            </div>

            <div class="form-group">
              <label>Email</label>
              <input class="form-control @error('email') is-invalid @enderror" value="{{ isset($nsb)? $nsb->email :old('email') }}" name="email" type="text"/>
              @error('email')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Password</label>
              <input class="form-control @error('password') is-invalid @enderror" value="" name="password" type="text"/>
              @error('password')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>

            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/nasabah') }}">Kembali</a>
          </div>

          </form>
        </div>
    </div>  --}}
{{-- </section> --}}
{{-- @endsection --}}
