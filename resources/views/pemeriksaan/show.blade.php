@extends('layouts.template')

@section('content')
<section class="content">
    <div class="card">
        <div class="card-header text-center">
        <h2><strong>LAPORAN PEMELIHARAAN DAN</strong></h2>
            <h2><strong>KALIBRASI INTERNAL PERALATAN TELEMETRI GSM</strong></h2>
            </h2>
            <br>
        </div>
        <div class="card-body">
        <div class="row">
              <div class="form-group col-md-6">
                <label>Nama Stasiun -- Jenis Alat</label>
                <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->alatTelemetri->lokasiStasiun }} -- {{ $pemeliharaan->alatTelemetri->jenisAlat->namajenis }}</p>
              <input type="hidden" name="pemeliharaan2_id" value="{{ $pemeliharaan->id }}">
              </div>
              <div class="form-group col-md-6">
              <label>Tanggal Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->tanggal }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Periode Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->periode }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Waktu Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->waktu }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Pelaksana Pemeliharaan</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->user->name }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>Cuaca</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->cuaca }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>No Alat Ukur</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->no_alatUkur }}</p>
              </div>
              <div class="form-group col-md-6">
              <label>No GSM</label>
              <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->no_GSM }}</p>
              </div>
            </div>
              <br>
              <div class="row">
                    @foreach ($komponen as $komp)
                        <div class="form-group col-md-6"> 
                            <label id="{{ $komp->id==9 || $komp->id==10 ? $komp->id : '' }}">{{ $komp->nama }}
                                <input
                                type="{{ $komp->id==9 || $komp->id==10 ? 'checkbox' : 'hidden' }}"
                                name="chekedsetting{{ $komp->id }}"
                                {{  $setting2->where('jenis', 'bucket')->first() && $komp->id==9 ? 'checked' : '' }}
                                {{  $setting2->where('jenis', 'water')->first() && $komp->id==10 ? 'checked' : '' }}
                                
                                />
                            </label>
                            @foreach ($detailKomponen->where('komponen2_id', $komp->id) as $detail)
                                @php
                                    $cheked = false;
                                    if (in_array($detail->id, $formKomponen)) {
                                        $cheked = true;
                                    }
                                @endphp
                                <div class="form-check">
                                    <input type="hidden" name="detail_komponen_id[{{ $detail->id }}]" value="{{ $detail->id }}" />
                                    <input type="hidden" name="pemeliharaan2_id[{{ $detail->id }}]" value="{{ isset($pemeliharaan) ? $pemeliharaan->id : '' }}" />
                                    <input type="checkbox" name="cheked{{ $detail->id }}" {{ $cheked ? 'checked' : 'disabled' }} class="form-check-input" />
                                    <label class="form-check-label">{{ $detail->namadetail }}</label>
                                </div>
                            @endforeach
                            @if ($komp->id==7)
                    {{-- <div class="form-group col-md-6"> --}}
                        <div class="row">
                            <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <span>Tegangan: </span>
                            </div>
                          <div class="col-md-6">
                            <input
                              type="text"
                              name="tegangan"
                              value="{{ $pemeliharaan->tegangan }}"
                              class="form-control @error('tegangan') is-invalid @enderror"
                              placeholder="Tegangan"
                              disabled
                            />
                            @error('tegangan')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-md-3 d-flex align-items-center">
                            <span>Volt</span>
                          </div>
                        </div>
                      
                      @error('tegangan')
                      <span class="error invalid-feedback">{{ $message }}</span>
                      @enderror
                  {{-- </div> --}}
                  @endif
                            @error('komponen2_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
              </div>
              <div class="row example" id="form-setting"  style="display: none;">
                <!-- Add your form setting fields here -->
                <div class="form-group col-md-6">
                  <p>Penunjukan Data Setting di Display (LCD)</p>
                          <table class="table table-bordered text-center">
                              <thead>
                                  <tr>
                                      <th colspan="2">Sebelum Kalibrasi</th>
                                      <th colspan="2">Sesudah Kalibrasi</th>
                                  </tr>
                                  <tr>
                                      <th>Simulasi</th>
                                      <th>Display</th>
                                      <th>Simulasi</th>
                                      <th>Display</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'bucket')->first()->simulasi ?? ' '}}&nbsp;</p></td>
                                      <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'bucket')->first()->display ?? ' '}}&nbsp;</p></td>
                                      <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'bucket')->first()->simulasi ?? ' '}}&nbsp;</p></td>
                                      <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'bucket')->first()->display ?? ' '}}&nbsp;</p></td>
                                  </tr>
                              </tbody>
                          </table>
                </div>
                <div class="form-group col-md-6">
                  <p>Penunjukan Data Setting di Display (LCD)</p>
                          <table class="table table-bordered text-center">
                              <thead>
                                  <tr>
                                      <th colspan="2">Sebelum Kalibrasi</th>
                                      <th colspan="2">Sesudah Kalibrasi</th>
                                  </tr>
                                  <tr>
                                      <th>Aktual</th>
                                      <th>Display</th>
                                      <th>Aktual</th>
                                      <th>Display</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'water')->first()->simulasi ?? ' ' }}&nbsp;</p></td>
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'water')->first()->display  ?? ' ' }}&nbsp;</p></td>
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'water')->first()->simulasi ?? ' ' }}&nbsp;</p></td>
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'water')->first()->display ?? ' ' }}&nbsp;</p></td>
                                  </tr>
                              </tbody>
                          </table>
                </div>
              </div>
            <div class="row">
                <div class="col-md-12">
                  <label>Keterangan</label>
                @if ($pemeliharaan->keterangan === null)
                    <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">Pemeliharaan {{ $pemeliharaan->alatTelemetri->jenisAlat->namajenis }}</p>
                @else
                  <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->keterangan }}</p>
                @endif
                </div>
                <div class="col-md-12 text-center">
                    <label>Dibuat oleh, <br> Pelaksana Kalibrasi</label>
                    <br>
                    <img src="{{ asset('assets/img/ttd/'.$pemeliharaan->ttdMekanik) }}" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">
                    <br>
                    <label>{{ $pemeliharaan->User->name }}</label>
                </div>
            </div>
            <h2 class=" card-header text-center"><strong>PEMERIKSAAN LAPORAN PEMELIHARAAN</strong></h2>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>User Pemeriksa</label>
                    <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ Auth::user()->name }}</p>
                </div>
                <div class="form-group col-md-6">
                    <label>Catatan Pemeriksa</label>
                    <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $data->catatan }}</p>
                </div>
                <div class="col-md-12 text-center">
                    <label>Mengetahui, <br> Ka. Tim Kalibrasi</label>
                    <br>
                    <img src="{{ asset('assets/img/ttd/'.$data->ttd) }}" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">
                    <br><label>{{ $data->User->name }}</label>
                </div>
                
            </div>
              
            <a class="btn btn-md btn-primary" href="{{ url('/pemeliharaans') }}">Kembali</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const label11 = document.getElementById('9');
            const label12 = document.getElementById('10');
            var jenisAlat = "{{ $pemeliharaan->alatTelemetri->jenisAlat->namajenis }}";
            if (jenisAlat === 'AWLR' || jenisAlat === 'ARR') {
                document.getElementById('form-setting').style.display = 'flex';
                label11.style.display = 'flex';
                label12.style.display = 'flex';
            }else{
                document.getElementById('form-setting').style.display = 'none';
                label11.style.display = 'none';
                label12.style.display = 'none';
            }
        });
    </script>
</section>
@endsection