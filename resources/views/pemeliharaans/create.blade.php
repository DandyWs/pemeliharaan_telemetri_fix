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
          <form action="{{ isset($pemeliharaan) ? $url_form : url('/pemeliharaans') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {!!(isset($pemeliharaan))? method_field('PUT') : '' !!}

            <div class="row">
              <div class="form-group col-md-6">
                <label>Nama Stasiun -- Jenis Alat</label>
                <select
                  id="alat_telemetri_id"
                  name="alat_telemetri_id"
                  class="form-control @error('alat_telemetri_id') is-invalid @enderror"
                  required
                >
                  <option value="">Pilih Peralatan Telemetri</option>
                  @foreach( $alat as $alat)
                  {{-- <option value="{{ $alat->id }}" {{ old('alat_telemetri_id', isset($pemeliharaan) && $pemeliharaan->alat_telemetri_id == $alat->id) ? 'selected' : '' }}> --}}
                  <option value="{{ $alat->id }}" data-jenis="{{ $alat->jenisAlat->namajenis }}" {{ old('alat_telemetri_id', isset($pemeliharaan) && $pemeliharaan->alat_telemetri_id == $alat->id) ? 'selected' : '' }}>
                    {{ $alat->lokasiStasiun }} -- {{ $alat->jenisAlat->namajenis }}
                  </option>
                  @endforeach
                </select>
                @error('alat_telemetri_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Tanggal Pemeliharaan</label>
                {{-- <input
                  type="date"
                  name="tanggal"
                  class="form-control @error('tanggal') is-invalid @enderror"
                  value="{{ old('tanggal', isset($pemeliharaan) ? optional($pemeliharaan->tanggal)->format('Y-m-d') : '') }}"
                  required
                /> --}}
                <input type="date" name="tanggal" class="form-control" value="{{ isset($pemeliharaan) ? $pemeliharaan->tanggal : old('tanggal') }}">
                @error('tanggal')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
              <label>Periode Pemeliharaan</label>
                <input type="text" name="periode" class="form-control @error('periode') is-invalid @enderror" value="{{ old('periode', isset($pemeliharaan) ? $pemeliharaan->periode : '') }}" placeholder="Periode" required />
                @error('periode')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
              <label>Waktu Mulai Pemeliharaan</label>
              <input type="time" name="waktu" class="form-control" value="{{ isset($pemeliharaan) ? $pemeliharaan->waktu : old('waktu') }}">
                @error('waktu')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
              <label>Pelaksana Pemeliharaan</label>
                <input
                type="hidden"
                name="user_id"
                value="{{ Auth::user()->id }}"
                />
                <input
                type="text"
                class="form-control"
                value="{{ Auth::user()->name }}"
                readonly
                />
                @error('user_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
              <label>Cuaca</label>
                <input
                  type="text"
                  name="cuaca"
                  class="form-control @error('cuaca') is-invalid @enderror"
                  value="{{ old('cuaca', isset($pemeliharaan) ? $pemeliharaan->cuaca : '') }}"
                  placeholder="Cuaca"
                  required
                />
                @error('cuaca')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group col-md-6">
              <label>No Alat Ukur</label>
                <input
                  type="text"
                  name="no_alatUkur"
                  class="form-control @error('no_alatUkur') is-invalid @enderror"
                  value="{{ old('no_alatUkur', isset($pemeliharaan) ? $pemeliharaan->no_alatUkur : '') }}"
                  placeholder="No Alat Ukur"
                  required
                />
                @error('no_alatUkur')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
              <label>No GSM</label>
                <input
                  type="text"
                  name="no_GSM"
                  class="form-control @error('no_GSM') is-invalid @enderror"
                  value="{{ old('no_GSM', isset($pemeliharaan) ? $pemeliharaan->no_GSM : '') }}"
                  placeholder="No GSM"
                  required
                />
                @error('no_GSM')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
              @foreach ($komponen as $komp)
              <div class="form-group col-md-6">
                <label class="example" id="{{ $komp->id==9 || $komp->id==10 ? $komp->id : '' }}">
                  {{ $komp->nama }}
                  <input
                      type="{{ $komp->id==9 || $komp->id==10 ? 'checkbox' : 'hidden' }}"
                      name="chekedsetting{{ $komp->id }}"
                      
                    />
                </label>
                @foreach ($detailKomponen->where('komponen2_id', $komp->id) as $detail)
                  <div class="form-check">
                      <input
                      type="hidden"
                      name="detail_komponen_id[{{ $detail->id }}]"
                      value="{{ $detail->id }}"
                      />
                      <input
                      type="hidden"
                      name="pemeliharaan2_id[{{ $detail->id }}]"
                      value="{{ isset($pemeliharaan) ? $pemeliharaan->id : '' }}"
                      />
                      
                      {{-- <input
                      type="checkbox"
                      name="cheked{{ $detail->id }}"
                      {{-- value="1" 
                      class="form-check-input"
                      {{ old('cheked' . $detail->id, isset($pemeliharaan) && $pemeliharaan->formKomponen->where('komponen2_id', $detail->id)->first()->cheked) ? 'checked' : '' }}
                      /> --}}
                    <input
                      type="checkbox"
                      name="cheked{{ $detail->id }}"
                      class="form-check-input"
                      id="detail{{ $detail->id }}"
                      {{ old('cheked' . $detail->id, isset($pemeliharaan) && $pemeliharaan->formKomponen->where('komponen2_id', $detail->id)->first()->cheked) ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="detail{{ $detail->id }}">{{ $detail->namadetail }}</label>
                  </div>
                  
                  
                @endforeach
                @if ($komp->id==7)
                    {{-- <div class="form-group col-md-6"> --}}
                        <div class="row">
                            <div class="col-md-3 d-flex align-items-center">
                            <span>Tegangan: </span>
                            </div>
                          <div class="col-md-6">
                            <input
                              type="text"
                              name="tegangan"
                              class="form-control @error('tegangan') is-invalid @enderror"
                              placeholder="Tegangan"
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
                                    <td><input type="text" name="simulasi_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="display_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="simulasi_sesudah" class="form-control" /></td>
                                    <td><input type="text" name="display_sesudah" class="form-control" /></td>
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
                                    <td><input type="text" name="aktual_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="display_aktual_sebelum" class="form-control" /></td>
                                    <td><input type="text" name="aktual_sesudah" class="form-control" /></td>
                                    <td><input type="text" name="display_aktual_sesudah" class="form-control" /></td>
                                </tr>
                            </tbody>
                        </table>
              </div>
            </div>

              
              <div class="form-group col-md-12" style="margin-top: 20px;">
                <label>Keterangan</label>
                  <textarea
                  name="keterangan"
                  class="form-control @error('keterangan') is-invalid @enderror"
                  >{{ old('keterangan', isset($pemeliharaan) ? $pemeliharaan->keterangan : '') }}</textarea>
                  @error('keterangan')
                  <span class="error invalid-feedback">{{ $message }}</span>
                  @enderror
              </div>

            <div class="form-group col-md-12 text-center">
              <label>Tanda Tangan Mekanik Pemeliharaan</label>
              <div id="signature-pad" class="signature-pad">
                <div id="sig" class="kbw-signature">
                </div>
                <input type="text" id="signature64" name="ttdMekanik" style="display: none">
                <div class="signature-pad--footer">
                <button type="button" class="btn btn-sm btn-secondary" id="clear">Hapus</button>

                </div>
              </div>
              @error('ttdMekanik')
              <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group mt-3">
              <button class="btn btn-sm btn-success">Simpan</button>
              <a class="btn btn-sm btn-primary" href="{{ url('/pemeliharaans') }}">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const alatTelemetriSelect = document.getElementById('alat_telemetri_id');
          const formSetting = document.getElementById('form-setting');
          const label11 = document.getElementById('9');
          const label12 = document.getElementById('10');
      
          alatTelemetriSelect.addEventListener('change', function () {
              const selectedOption = alatTelemetriSelect.options[alatTelemetriSelect.selectedIndex];
              const jenisAlat = selectedOption.getAttribute('data-jenis');
      
              if (jenisAlat === 'AWLR' || jenisAlat === 'ARR') {
                  formSetting.style.display = 'flex';
                  label11.style.display = 'flex';
                  label12.style.display = 'flex';
              } else {
                  formSetting.style.display = 'none';
                  label11.style.display = 'none';
                  label12.style.display = 'none';
              }
          });
      
          // Trigger change event on page load to handle pre-selected option
          alatTelemetriSelect.dispatchEvent(new Event('change'));
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
