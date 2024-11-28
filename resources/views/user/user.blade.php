@extends ('layouts.template')

 @section('content')

<section class="content">
    {{-- <div >
        {{Breadcrumbs::render('user')}}
      </div> --}}
    <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Daftar User</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('user/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a>
            </div>
              <table class="table table-bordered table-striped " id="data_user">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        </div>
    </div>
    </
</section>
@endsection
@section('mainjs')
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
                            action: "{{url('user')}}/" + id,
                            method: 'POST',
                            class: 'delete-form'
                        }).append('@csrf', '@method("DELETE")');
                        form.appendTo('body').submit();
          }

        })

    });
       $(document).ready(function (){
      var data = $('#data_user').DataTable();
      data.destroy();
        var data = $('#data_user').DataTable({
            processing:true,
            serverside:true,
            ajax:{
                'url': '{{  url('user/data') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns: [
            { data: 'id', searchable: false, sortable: false },
            { data: 'name', name: 'name', sortable: true, searchable: true },
            { data: 'email', name: 'email', sortable: false, searchable: true },
            { data: 'role', name: 'role', sortable: false, searchable: true },
            {
                data: 'id', name: 'id', searchable: false, sortable: false,
                render: function (data, type, row, meta) {
                    return '<a href="{{ url('user') }}/' + data + '/edit" class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"></i> </a>' +
                        '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data + '"><i class="fa fa-trash"></i> </button>' +
                    `<a href="{{url('/user/')}}/` + data +`"class="btn btn-sm btn-primary "><i class="fas fa fa-info-circle"></i></a>`;
                }
            }
        ]
        });
    });

</script>
@endsection

