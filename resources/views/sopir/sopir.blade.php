@extends ('layouts.template')

@section('content')

<section class="content">
    <div >
        {{Breadcrumbs::render('sopir')}}
      </div>
    <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Daftar Sopir</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('sopir/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a>

            </div>
            <table class="table table-bordered table-striped " id="data_sopir">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id Sopir</th>
                        <th>Nama</th>
                        {{-- <th>Foto</th> --}}
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                

            </table>

        </div>
    </div>
</section>

@push('js')
<script>
      $(document).on('click', '.btn-delete', function () {
                let id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
          
        }).then((result) => {
          if(result.isConfirmed){
            var form = $('<form>').attr({
                            action: "{{url('sopir')}}/" + id,
                            method: 'POST',
                            class: 'delete-form'
                        }).append('@csrf', '@method("DELETE")');
                        form.appendTo('body').submit();
          }
         
        })
      
    });

    $(document).ready(function (){
      var data = $('#data_sopir').DataTable();
      data.destroy();
        var data = $('#data_sopir').DataTable({
            processing:true,
            serverside:true,
            ajax:{
                'url': '{{  url('sopir/data') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns: [
            { data: 'no', searchable: false, sortable: false },
            { data: 'id_sopir', name: 'id_sopir', searchable: true, sortable: true },
            { data: 'nama', name: 'nama', sortable: true, searchable: true },
            { data: 'alamat', name: 'alamat', sortable: false, searchable: true },
            { data: 'phone', name: 'phone', sortable: false, searchable: true },
            {
                data: 'id', name: 'id', searchable: false, sortable: false,
                render: function (data, type, row, meta) {
                    return '<a href="{{ url('sopir') }}/' + data + '/edit" class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"></i> </a>' +
                        '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data + '"><i class="fa fa-trash"></i> </button>' + 
                    `<a href="{{url('/sopir/')}}/` + data +`"class="btn btn-sm btn-primary "><i class="fas fa fa-info-circle"></i></a>`;
                }
                }
            ]
        }); 
    });

</script>
@endpush

@endsection