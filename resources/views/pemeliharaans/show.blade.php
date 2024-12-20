@extends('layouts.template')

@section('content')
<section class="content">

    <!--Default box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Setting</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Tanggal Pemeliharaan : </b>{{$pemeliharaan->tanggal}}</li>
                <li class="list-group-item"><b>Waktu Mulai Pemeliharaan : </b>{{$pemeliharaan->waktu}}</li>
                <li class="list-group-item"><b>Periode Pemeliharaan : </b>{{$pemeliharaan->periode}}</li>
                <li class="list-group-item"><b>Cuaca : </b>{{$pemeliharaan->cuaca}}</li>
                <li class="list-group-item"><b>No Alat Ukur : </b>{{$pemeliharaan->no_alatUkur}}</li>
                <li class="list-group-item"><b>No GSM : </b>{{$pemeliharaan->no_GSM}}</li>
                <li class="list-group-item"><b>User : </b>{{$pemeliharaan->user->name}}</li>
                <li class="list-group-item"><b>Lokasi Stasiun : </b>{{$pemeliharaan->alatTelemetri->lokasiStasiun}}</li>
                <li class="list-group-item"><b>Jenis Peralatan : </b>{{$pemeliharaan->alatTelemetri->jenisAlat->namajenis}}</li>
                <li class="list-group-item"><b>Keterangan : </b>{{$pemeliharaan->keterangan ?? 'Pemeliharaan ' . $pemeliharaan->alatTelemetri->jenisAlat->namajenis}}</li>
            </ul>
            {{-- {{ $formKomponen }} --}}
            @foreach ($komponen as $komp)
            <div class="form-group col-md-6">
              <label>
                {{ $komp->nama }}
              </label>
              @foreach ($detailKomponen->where('komponen2_id', $komp->id) as $detail)
              @php
              $cheked = false;
                  if (in_array($detail->id, $formKomponen)) {
                        $cheked = true;
                        // var_dump($cheked);
                    }
              @endphp
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
                    {{-- <input
                    type="hidden"
                    name="cheked[{{ $detail->id }}]"
                    value="0"
                    /> --}}
                    <input
                    type="checkbox"
                    name="cheked{{ $detail->id }}"
                    {{ $cheked ? 'checked' : 'disabled' }}
                    class="form-check-input"
                    
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

            <div class="row">
                @foreach ($komponen as $komponen)
                <div class="col-md-6">
                    <h3 class="card-title">{{ $komponen->nama }}</h3>
                    {{-- @foreach ($komponen->detailKomponen as $detail)
                    @endforeach --}}
                </div>
                @endforeach
                
            </div>
            <a class="btn btn-md btn-primary" href="{{ url('/pemeliharaans') }}">Kembali</a>
        </div>
        
    </div>
       
      
    <!-- /.card -->

</section>
@endsection
