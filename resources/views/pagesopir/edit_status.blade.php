@extends ('layouts.sidebar_sopir')

@section('content')
<section class="content">
  <a class="btn btn-success mt-3" href="{{ url('/jadwalnasabah') }}">Kembali</a>
    <!-- Default Box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Jadwal</h3>
            <br>
        </div>
        <div class="card-body">
            <form method="POST" action="{{$url_form }}">
                @csrf
                {!! (isset($jdw))? method_field('PUT'):''!!}
                <div class="form-group">
                  <label>Konfirmasi</label>
                  <select class="form-control @error('konfirmasi') is-invalid @enderror" value="{{isset($jdw)? $jdw->id_transaksibaru : old('id_transaksibaru', $jdw->konfirmasi) }}" name="konfirmasi" type="text">
                    <option value="Menunggu Pick Up" {{ old('kofnirmasi', $jdw->konfirmasi) == 'Menunggu Pick Up' ? 'selected' : '' }}>Menunggu Pick Up</option>
                    <option value="Pick Up" {{ old('konfirmasi', $jdw->konfirmasi) == 'Pick Up' ? 'selected' : '' }}>Pick Up</option>
                    <option value="Selesai" {{ old('konfirmasi', $jdw->konfirmasi) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                  </select>
                  
                  @error('konfirmasi')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div>
      <div style="padding-bottom: 30px"> <a class="btn btn-primary mt-3" href="{{ url('/jadwalsopir') }}">Kembali</a></div>
              </form>
        </div>
    </div>
   
</section>
@endsection