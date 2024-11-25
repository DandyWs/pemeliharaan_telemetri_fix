@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('pemeliharaans.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.forms.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.tanggalPemeliharan')</h5>
                    <span>{{ $pemeliharaan->tanggalPemeliharan ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.waktuMulaiPemeliharan')</h5>
                    <span
                        >{{ $pemeliharaan->waktuMulaiPemeliharan ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.periodePemeliharaan')</h5>
                    <span>{{ $pemeliharaan->periodePemeliharaan ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.cuaca')</h5>
                    <span>{{ $pemeliharaan->cuaca ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.no_AlatUkur')</h5>
                    <span>{{ $pemeliharaan->no_AlatUkur ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.no_GSM')</h5>
                    <span>{{ $pemeliharaan->no_GSM ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.user_id')</h5>
                    <span
                        >{{ optional($pemeliharaan->user)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.forms.inputs.peralatan_telemetri_id')</h5>
                    <span
                        >{{
                        optional($pemeliharaan->peralatanTelemetri)->namaAlat ??
                        '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('pemeliharaans.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Pemeliharaan::class)
                <a
                    href="{{ route('pemeliharaans.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
