@extends ('layouts.template')

@section('content')
<section class="content">

    <!-- Default Box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Jadwal</h3>
            <br>
        </div>
        <div class="card-body">
            <form method="POST" action="{{$url_form}}">
                @csrf
                {!! (isset($jdw))? method_field('PUT'):''!!}

                <div class="form-group">
                  <label for="Id Nasabah">Id Nasabah</label>
                  <select name="id_nasabah" class="form-control @error('id_nasabah')
                    is-invalid @enderror">
                    @foreach($nasabah as $nsb)
                    <option value="{{$nsb->id}}">{{$nsb->id_nasabah}} -- {{$nsb->nama}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="Id Sopir">Id Sopir</label>
                  <select name="id_sopir" class="form-control @error('id_sopir')
                    is-invalid @enderror">
                    @foreach($sopir as $spr)
                    <option value="{{$spr->id}}">{{$spr->id_sopir}} -- {{$spr->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <table id="konfirmasi">
                  <th>Tanggal Pengambilan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</th>
                  <th></th>
                  <th>Konfirmasi&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <tr>
                    <td>
                      <input class="form-control @error('tanggal_pengambilan') is-invalid @enderror" value="{{isset($jdw)? $jdw->tanggal_pengambilan : old('tanggal_pengambilan') }}" name="tanggal_pengambilan" type="date"/>
                    @error('tanggal_pengambilan')
                      <span class="error invalid-feedback">{{ $message }} </span>
                    @enderror
                    </td>
                    <td style="width: 50px"></td>
                    <td>
                      <select class="form-control @error('konfirmasi') is-invalid @enderror" value="{{isset($jdw)? $jdw->konfirmasi : old('konfirmasi') }}" name="konfirmasi" type="text">
                        <option value="Menunggu Pick Up">Menunggu Pick Up</option>                        
                        <option value="Selesai">Selesai</option>
                      </select>
                    @error('konfirmasi')
                      <span class="error invalid-feedback">{{ $message }} </span>
                    @enderror
                    </td>
                  </tr>
                  </table>
                  
                <table id="tambahData"  style="margin-top: 16px">
                  <th>Jenis Sampah</th>
                  <th>Berat</th>
                  <th>Action</th>
                  <tr >
                    <td>
                     
                      <select  name="jenis_sampah_0" class="form-control @error('jenis_sampah') is-invalid @enderror">
                        @foreach($sampah as $s)
                        <option value="{{$s->id}}">{{$s->jenis_sampah}} ({{($s->harga)}}/kg)</option>
                        @endforeach
                      </select></td>
                    <td >
                     
                      <input class="form-control @error('berat') is-invalid @enderror" name="berat_0" type="text"/>
                      @error('berat')
                        <span class="error invalid-feedback">{{ $message }} </span>
                      @enderror</td>
                    <td> <a style="float: right"   class="btn  btn-success" onclick="tambahData()"><i class="fa  fa-plus" aria-hidden="true"></i></a></td>
                  </tr>
                 
                 </table>

                <div class="form-group mt-3">
                    <input type="hidden" value="1" id="counter" name="counter">
                    <button class="btn btn-sm btn-success">Simpan</button>
                    <a class="btn btn-sm btn-primary" href="{{ url('/jadwal') }}">Kembali</a>
                </div>
              </form>
      
        </div>
    </div>
    <div style="padding-bottom: 30px"> </div>
</section>
<script>
  var counter = 1; // Menambahkan variabel counter

  function tambahData() {
    var tempHtml = `
        <tr >
            <td>
            <select name="jenis_sampah_${counter}" class="form-control @error('jenis_sampah') is-invalid @enderror">
             @foreach($sampah as $s)
            <option value="{{$s->id}}">{{$s->jenis_sampah}} ({{($s->harga)}}/kg)</option>
            @endforeach
            </select>
            </td>
            <td >
              <input class="form-control @error('berat') is-invalid @enderror" name="berat_${counter}" type="text"/>
            </td>
            <td> <a style="float: right"   class="btn  btn-danger remove-table-row" "><i class="fa fa-times" aria-hidden="true"></i></a></td>
          </tr>`;

    $('#tambahData').append(tempHtml);
    counter++; // Meningkatkan counter setelah menambahkan elemen

    $('#counter').val(counter); // Mengisi nilai pada input counter
    $(document).on('click','.remove-table-row',function(){
          $(this).parents('tr').remove();
        });
  }
</script>

@endsection