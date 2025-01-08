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
            <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
            @csrf
            {!!(isset($spr))? method_field('PUT') : '' !!}

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
            <div class="row">
              @foreach ($komponen as $komp)
                  <div class="form-group col-md-6"> 
                      <label id="{{ $komp->id==9 || $komp->id==10 ? $komp->id : '' }}">{{ $komp->nama }}
                              <input
                                type="{{ $komp->id==9 || $komp->id==10 ? 'checkbox' : 'hidden' }}"
                                name="cheked{{ $komp->id }}"
                                {{ $komp->id==9 || $komp->id==10 ? 'checked' : '' }}
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
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'bucket')->first()->simulasi ?? ' '}}</p></td>
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'bucket')->first()->display ?? ' '}}</p></td>
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'bucket')->first()->simulasi ?? ' '}}</p></td>
                                    <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'bucket')->first()->display ?? ' '}}</p></td>
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
                                  <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'water')->first()->simulasi ?? ' ' }}</p></td>
                                  <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 0)->where('jenis', 'water')->first()->display  ?? ' ' }}</p></td>
                                  <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'water')->first()->simulasi ?? ' ' }}</p></td>
                                  <td><p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $setting2->where('kondisi', 1)->where('jenis', 'water')->first()->display ?? ' ' }}</p></td>
                                </tr>
                            </tbody>
                        </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>Keterangan</label>
                <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ $pemeliharaan->keterangan }}</p>
              </div>
              {{-- <div class="col-md-12">
              <label>TTD Mekanik Pemeliharaan</label>
              <br>
              <img src="{{ asset('assets/img/ttd/'.$pemeliharaan->ttdMekanik) }}" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">
              </div> --}}
          </div>
            <h2 class=" card-header text-center"><strong>PEMERIKSAAN LAPORAN PEMELIHARAAN</strong></h2>
            <div class="row">
              <div class="form-group col-md-6">
                <label>User Pemeriksa</label>
                <p class="form-control-static" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;">{{ Auth::user()->name }}</p>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              </div>

              <div class="form-group col-md-6">
                <label>Catatan</label>
                <textarea
                  name="catatan"
                  class="form-control @error('catatan') is-invalid @enderror"
                  
                ></textarea>
                @error('catatan')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row text-center">
              
                <div class="col-md-6">
                  <label>Mengetahui, <br> Ka. Tim Kalibrasi</label>

                  <div id="signature-pad" class="signature-pad">
                    <div id="sig" class="kbw-signature">
                    </div>
                    <input type="text" id="signature64" name="ttd" style="display: none">
                    <div class="signature-pad--footer">
                    <label>{{ Auth::user()->name }}</label><br>
                    <button type="button" class="btn btn-sm btn-secondary" id="clear">Hapus</button>

                    </div>
                  </div>
                  @error('ttd')
                  <span class="error invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label>Dibuat oleh, <br> Pelaksana Kalibrasi</label>
                  <br>
                  <img src="{{ asset('assets/img/ttd/'.$pemeliharaan->ttdMekanik) }}" style="border: 1px solid #ced4da; background-color: #e9ecef; padding: .375rem .75rem;"><br>
                  <label>{{ $pemeliharaan->user->name }}</label>
                  </div>
              

            </div>
            <div class="form-group mt-3">
              <button name="submit" class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/pemeriksaan') }}">Kembali</a>
            </div>
            </form>
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
      <script type="text/javascript">
          var sig = $('#sig').signature({
              syncField: '#signature64',
              syncFormat: 'PNG'
          });
          $('#clear').click(function(e) {
              e.preventDefault();
              sig.signature('clear');
              $("#signature64").val('');
          });
      </script>
</section>

@endsection