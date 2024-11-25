@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Pemeliharaan::class)
                <a href="{{ route('pemeliharaans.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
                <a href="{{ route('pemeliharaans.export', ['format' => 'pdf']) }}" class="btn btn-danger ml-2">
                    <i class="icon ion-md-download"></i> Export PDF
                </a>
                <a href="{{ route('pemeliharaans.export', ['format' => 'xlsx']) }}" class="btn btn-success ml-2">
                    <i class="icon ion-md-download"></i> Export XLSX
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <b>Pemeliharaan List</b>
        </div>
        <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
            <form class="form" method="GET" action="@lang('crud.forms.index_title')" class="col-md-4" style="width: 100%; padding: 0">
              <div class="form-group w-100 mb-3">
              </div>
              <div class="col-md-6 text-right">
            </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">
                                @lang('crud.forms.inputs.tanggalPemeliharan')
                            </th>
                            <th class="text-center">
                                @lang('crud.forms.inputs.waktuMulaiPemeliharan')
                            </th>
                            <th class="text-center">
                                @lang('crud.forms.inputs.periodePemeliharaan')
                            </th>
                            <th class="text-center">
                                @lang('crud.forms.inputs.cuaca')
                            </th>
                            <th class="text-center">
                                @lang('crud.forms.inputs.no_AlatUkur')
                            </th>
                            <th class="text-center">
                                @lang('crud.forms.inputs.no_GSM')
                            </th>
                            <th class="text-center">
                                @lang('crud.forms.inputs.user_id')
                            </th>
                            <th class="text-center  ">
                                @lang('crud.forms.inputs.peralatan_telemetri_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemeliharaans as $pemeliharaan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $pemeliharaan->tanggalPemeliharan ?? '-' }}
                            </td>
                            <td>
                                {{ $pemeliharaan->waktuMulaiPemeliharan ?? '-'
                                }}
                            </td>
                            <td>
                                {{ $pemeliharaan->periodePemeliharaan ?? '-' }}
                            </td>
                            <td>{{ $pemeliharaan->cuaca ?? '-' }}</td>
                            <td>{{ $pemeliharaan->no_AlatUkur ?? '-' }}</td>
                            <td>{{ $pemeliharaan->no_GSM ?? '-' }}</td>
                            <td>
                                {{ optional($pemeliharaan->user)->name ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($pemeliharaan->peralatanTelemetri)->namaAlat
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $pemeliharaan)
                                    <a
                                        href="{{ route('pemeliharaans.edit', $pemeliharaan) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $pemeliharaan)
                                    <a
                                        href="{{ route('pemeliharaans.show', $pemeliharaan) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $pemeliharaan)
                                    <form
                                        action="{{ route('pemeliharaans.destroy', $pemeliharaan) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                {!! $pemeliharaans->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
