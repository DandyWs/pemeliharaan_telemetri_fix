@extends ('layouts.template')

@section('content')

<section class="content">
    {{-- <div >
        {{Breadcrumbs::render('detail_componen')}}
      </div> --}}
    <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Daftar Komponen</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('detail_componen/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a>

            </div>
            <table class="table table-bordered table-striped " id="data_detail_componen">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Namadetaildetail</th>
                        <th>Komponen2_id</th>
                        <th>Action</th>
                    </tr>
                </thead>


            </table>

        </div>
    </div>

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
                            action: "{{url('detail_componen')}}/" + id,
                            method: 'POST',
                            class: 'delete-form'
                        }).append('@csrf', '@method("DELETE")');
                        form.appendTo('body').submit();
          }

        })

    });

    $(document).ready(function (){
      var data = $('#data_detail_componen').DataTable();
      data.destroy();
        var data = $('#data_detail_componen').DataTable({
            processing:true,
            serverside:true,
            ajax:{
                'url': '{{  route('data_detail_componen') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns: [
            { data: 'id', searchable: false, sortable: false },
            { data: 'namadetail', name: 'namadetail', sortable: true, searchable: true },
            { data: 'nama', name: 'nama', sortable: true, searchable: true },
            {   
                data: 'id', name: 'id', searchable: false, sortable: false,
                render: function (data, type, row, meta) {
                    return '<a href="{{ url('detail_componen') }}/' + data + '/edit" class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"></i> </a>' +
                        '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data + '"><i class="fa fa-trash"></i> </button>' +
                    `<a href="{{url('/detail_componen/')}}/` + data +`"class="btn btn-sm btn-primary "><i class="fas fa fa-info-circle"></i></a>`;
                }
                }
            ]
        });
    });

</script>
@endsection

{{-- @extends ('layouts.template')

 @section('content')

<section class="content">
    {{-- <div >
        {{Breadcrumbs::render('nasabah')}}
      </div> --}}
    {{-- <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Data User</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('nasabah/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a>
            </div>
              <table class="table table-bordered table-striped " id="data_nasabah">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Id</th>
                        <th>Namadetaildetail</th>
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
</section> --}}

{{-- @push('js')
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
                            action: "{{url('nasabah')}}/" + id,
                            method: 'POST',
                            class: 'delete-form'
                        }).append('@csrf', '@method("DELETE")');
                        form.appendTo('body').submit();
          }

        })

    });
       $(document).ready(function (){
      var data = $('#data_nasabah').DataTable();
      data.destroy();
        var data = $('#data_nasabah').DataTable({
            processing:true,
            serverside:true,
            ajax:{
                'url': '{{  url('nasabah/data') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns: [
            { data: 'no', searchable: false, sortable: false },
            { data: 'id_nasabah', name: 'id_nasabah', searchable: true, sortable: true },
            { data: 'namadetaildetail', name: 'namadetaildetail', sortable: true, searchable: true },
            { data: 'email', name: 'email', sortable: false, searchable: true },
            { data: 'role', name: 'role', sortable: false, searchable: true },
            {
                data: 'id', name: 'id', searchable: false, sortable: false,
                render: function (data, type, row, meta) {
                    return '<a href="{{ url('nasabah') }}/' + data + '/edit" class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"></i> </a>' +
                        '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data + '"><i class="fa fa-trash"></i> </button>' +
                    `<a href="{{url('/nasabah/')}}/` + data +`"class="btn btn-sm btn-primary "><i class="fas fa fa-info-circle"></i></a>`;
                }
            }
        ]
        });
    });

</script>
@endpush --}}
{{-- 
@endsection --}}


