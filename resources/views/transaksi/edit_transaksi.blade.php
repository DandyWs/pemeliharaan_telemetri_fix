@extends ('layouts.template')

@section('content')
<section class="content">

    <!-- Default Box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Transaksi</h3>
            <br>
        </div>
        <div class="card-body">
            <form method="POST" action="{{$url_form }}">
                @csrf
                {!! (isset($trs))? method_field('PUT'):''!!}
                <div class="form-group">
                  <label for="Id Jadwal">Id Jadwal</label>
                  <select name="id_jadwal" class="form-control @error('id_jadwal') is-invalid @enderror">
                    @foreach($jdw as $jdw)
                    <option value="{{$jdw->id}}" {{ old('id_jadwal', $trs->id_jadwal) == $jdw->id ? 'selected' : null }}>{{$jdw->id_jadwal}}</option>
                    @endforeach
                  </select>
                  @error('id_jadwal')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="Jenis Sampah">Jenis Sampah</label>
                  <select name="jenis_sampah" class="form-control @error('jenis_sampah') is-invalid @enderror">
                    @foreach($smp as $smp)
                    <option value="{{$smp->id}}" {{ old('jenis_sampah', $trs->jenis_sampah) == $smp->id ? 'selected' : null }}>{{$smp->jenis_sampah}} ({{($smp->harga)}}/kg)</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Berat</label>
                  <input class="form-control @error('berat') is-invalid @enderror" name="berat" type="text" value="{{isset($trs)? $trs->berat : old('berat') }}"/>
                  @error('berat')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Harga</label>
                  <input class="form-control @error('harga') is-invalid @enderror" name="harga" type="text" value="{{isset($trs)? $trs->harga : old('harga') }}"/>
                  @error('harga')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-sm btn-primary">Simpan</button>
                  </div>
              </form>
      
        </div>
    </div>
</section>
@endsection