@extends('layouts.template')
@section('content')
<section class="content">
  <div >
    {{Breadcrumbs::render('jadwal')}}
  </div>
    <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Daftar Jadwal</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('jadwal/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a>

            </div>
            <table class="table table-bordered table-striped " id="data_jadwal">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id Jadwal</th>
                  <th>Nama Nasabah</th>
                  <th>Nama Sopir</th>
                  <th>Tanggal Ambil</th>
                  <th>Konfirmasi</th>
                  <th>Action</th>
                </tr>
              </thead>

            </table>

          </div>
        </div>
    </div>
</section>
    
@push('js')
<script>
    $(document).on('click', '.btn-delete', function () {
                let id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Setelah dibatalkan, Anda tidak dapat memulihkannya lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
          
        }).then((result) => {
          if(result.isConfirmed){
            var form = $('<form>').attr({
                            action: "{{url('jadwal')}}/" + id,
                            method: 'POST',
                            class: 'delete-form'
                        }).append('@csrf', '@method("DELETE")');
                        form.appendTo('body').submit();
          }
         
        })
      
    });
    $(document).ready(function (){
      var data = $('#data_jadwal').DataTable();
      data.destroy();
        var data = $('#data_jadwal').DataTable({
            processing:true,
            serverside:true,
            ajax:{
                'url': '{{  url('jadwal/data') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns:[
            {data:'no',searchable:false,sortable:false},
            {data:'id_jadwal',name:'id_jadwal',searchable:true,sortable:true},
            {data:'id_nasabah',name:'id_nasabah',searchable:true,sortable:false},
            {data:'id_sopir',name:'id_nasabah',searchable:true,sortable:false},
            {data:'tanggal_pengambilan',name:'tanggal_pengambilan',searchable:true,sortable:true},
            {data:'konfirmasi',name:'konfirmasi',searchable:true,sortable:false},
            {data:'id',name:'id',searchable:false,sortable:false,
                render: function(data, type, row, meta){
                  if (row.konfirmasi !== 'Dibatalkan' && row.konfirmasi !== 'Selesai') {
                    return `<a href="{{url('jadwal')}}/` + data + `/edit" class="btn btn-warning btn-sm mr-1 "><i class="fa fa-edit"></i> </a>` +
                    '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data + '"><i class="fa fa-trash"></i> </button>' + 
                    `<a href="{{url('/jadwal/')}}/` + data +`"class="btn btn-sm btn-primary "><i class="fas fa fa-info-circle"></i></a>`;
                  } else {
                    return `<a href="{{url('/jadwal/')}}/` + data +`"class="btn btn-sm btn-primary "><i class="fas fa fa-info-circle"></i></a>`
                  }
                }
            } 
            ]
        }); 
    });
</script>
@endpush

@endsection