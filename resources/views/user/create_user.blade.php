@extends ('layouts.template')

@section('content')
<section class="content">

    <!-- Default Box-->
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
              <label>Nama</label>
              <input class="form-control @error('name') is-invalid @enderror" value="{{ isset($nsb)? $nsb->name :old('name') }}" name="name" type="text"/>
              @error('name')
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
              <label for="role" class=" col-form-label text-md-end">{{ __('Role') }}</label>
              <div class="col-md-12">
                  <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required autocomplete="role">
                      <option value="mekanik">Mekanik</option>
                      <option value="manager">Ka. Tim Kalibrasi Divisi</option>
                  </select>

                  @error('role')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

            <div class="form-group">
              <label>Password</label>
              <input class="form-control @error('password') is-invalid @enderror" value="" name="password" type="password"/>
              @error('password')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>

            {{--  --}}
            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/user') }}">Kembali</a>
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
              <label>Id User</label>
              <input class="form-control @error('id_user') is-invalid @enderror" value="{{ isset($nsb)? $nsb->id_user : old('id_user') }}" name="id_user" type="text" />
              @error('id_user')
                <span class="error invalid-feedback">{{ $message }} </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input class="form-control @error('nama') is-invalid @enderror" value="{{ isset($nsb)? $nsb->nama :old('nama') }}" name="nama" type="text"/>
              @error('nama')
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
              <a class="btn btn-sm btn-primary" href="{{ url('/user') }}">Kembali</a>
          </div>

          </form>
        </div>
    </div>  --}}
{{-- </section> --}}
{{-- @endsection --> --}}
