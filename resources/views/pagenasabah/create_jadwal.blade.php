@extends ('layouts.sidebar_nasabah')

@section('content')
<section class="content">
  <div >
    {{Breadcrumbs::render('jadwal')}}
  </div>
    <!-- Default Box-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Jadwal Pengambilan Sampah</h3>
            <br>
        </div>
        <div class="card-body">
            <form method="POST" action="{{$url_form }}">
                @csrf
                
                {!! (isset($jdw))? method_field('PUT'):''!!}

               
                <div class="form-group">
                  <label>Id Nasabah</label>
                  <input class="form-control @error('id_nasabah') is-invalid @enderror" placeholder="{{$nasabah->id_nasabah}}" type="text" readonly>
                  <input class="form-control @error('id_nasabah') is-invalid @enderror" value="{{Auth::user()->nasabah->id}}" name="id_nasabah" type="hidden">
                  @error('id_nasabah')
                    <span class="error invalid-feedback">{{ $message }} </span>
                  @enderror
                </div>
               <table id="tambahData"  >
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
                  <td> <a style="float: right"   class="btn  btn-primary" onclick="tambahData()"><i class="fa  fa-plus" aria-hidden="true"></i></a></td>
                </tr>
               
               </table>
               <div class="form-group mt-3">
                <input type="hidden" value="1" id="counter" name="counter">
                <button class="btn btn-sm btn-success">Simpan</button>
                <a class="btn btn-sm btn-danger" href="{{ url('/jadwalnasabah') }}">Kembali</a>

            </div>
              </form>
        </div>
        
    </div>
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
</section>

@endsection