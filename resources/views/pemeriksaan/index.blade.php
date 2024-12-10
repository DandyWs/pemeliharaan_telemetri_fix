@extends('layouts.template')

@section('content')

<section class="content">
    {{-- <div >
        {{Breadcrumbs::render('detail_componen')}}
      </div> --}}
    <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b>Daftar Pemeriksaan</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              {{-- <a href="{{url('pemeriksaan/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a> --}}
              <div class="col-md-12 text-right mb-3" style="width: 100%">
                <a href="{{ route('pemeliharaans.export', ['format' => 'pdf']) }}" class="btn btn-danger ml-2">
                    <i class="icon ion-md-download"></i> Export PDF
                </a>
                <a href="{{ route('pemeliharaans.export', ['format' => 'xlsx']) }}" class="btn btn-success ml-2">
                    <i class="icon ion-md-download"></i> Export XLSX
                </a>
            </div>
            </div>
            <table class="table table-bordered table-striped " id="data_detail_componen">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Periode</th>
                        <th>Cuaca</th>
                        <th>No Alat Ukur</th>
                        <th>No GSM</th>
                        <th>Jenis Alat</th>
                        <th>Lokasi Stasiun</th>
                        <th>User</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            </div>
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
                            action: "{{url('pemeriksaan')}}/" + id,
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
                'url': '{{  route('data_pemeliharaan') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns: [
            { data: null, searchable: false, sortable: false,
              render: function (data, type, row, meta) {
                  return meta.row + 1;
              }
            },
            {
                data: null,
                name: 'tanggal_waktu',
                sortable: true,
                searchable: true,
                render: function (data, type, row, meta) {
                    return row.tanggal + ' ' + row.waktu;
                }
            },
            // { data: 'waktu', name: 'waktu', sortable: true, searchable: true },
            { data: 'periode', name: 'periode', sortable: true, searchable: true },
            { data: 'cuaca', name: 'cuaca', sortable: true, searchable: true },
            { data: 'no_alatUkur', name: 'no_alatUkur', sortable: true, searchable: true },
            { data: 'no_GSM', name: 'no_GSM', sortable: true, searchable: true },
            { data: 'jenis_alat', name: 'jenis_alat', sortable: true, searchable: true },
            { data: 'alat_telemetri_id', name: 'alat_telemetri_id', sortable: true, searchable: true },
            { data: 'user_id', name: 'user_id', sortable: true, searchable: true },
            {
                data: 'keterangan',
                name: 'keterangan',
                sortable: true,
                searchable: true,
                render: function (data, type, row, meta) {
                    return data ? data : 'Menunggu Konfirmasi';
                }
            },
            {
                data: 'id', name: 'id', searchable: false, sortable: false,
                render: function (data, type, row, meta) {
                    return '<a href="{{ url('pemeriksaan') }}/' + data + '/edit" class="btn btn-warning btn-sm mr-1"><i class="fa fa-plus"></i> </a>' +
                        '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data + '"><i class="fa fa-trash"></i> </button>';
                    // '<a href="{{ url('pemeriksaan') }}/' + data + '/create" class="btn btn-success btn-sm mr-1"><i class="fa fa-plus"></i> </a>';
                    // `<a href="{{url('/pemeliharaans/')}}/` + data +`"class="btn btn-sm btn-primary "><i class="fas fa fa-info-circle"></i></a>`;
                }
                }
            ]
        });
    });

</script>
@endsection
