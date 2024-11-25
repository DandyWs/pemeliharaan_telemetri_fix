@php $editing = isset($pemeliharaan) @endphp

<div class="row">
        <x-inputs.group class="col-md-6">
            <x-inputs.datetime
                name="tanggalPemeliharan"
                label="Tanggal Pemeliharan"
                value="{{ old('tanggalPemeliharan', ($editing ? optional($pemeliharaan->tanggalPemeliharan)->format('Y-m-d\TH:i:s') : '')) }}"
                max="255"
                required
            ></x-inputs.datetime>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.datetime
                name="waktuMulaiPemeliharan"
                label="Waktu Mulai Pemeliharan"
                value="{{ old('waktuMulaiPemeliharan', ($editing ? optional($pemeliharaan->waktuMulaiPemeliharan)->format('Y-m-d\TH:i:s') : '')) }}"
                max="255"
                required
            ></x-inputs.datetime>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.text
                name="periodePemeliharaan"
                label="Periode Pemeliharaan"
                :value="old('periodePemeliharaan', ($editing ? $pemeliharaan->periodePemeliharaan : ''))"
                maxlength="255"
                placeholder="Periode Pemeliharaan"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.text
                name="cuaca"
                label="Cuaca"
                :value="old('cuaca', ($editing ? $pemeliharaan->cuaca : ''))"
                maxlength="255"
                placeholder="Cuaca"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.text
                name="no_AlatUkur"
                label="No Alat Ukur"
                :value="old('no_AlatUkur', ($editing ? $pemeliharaan->no_AlatUkur : ''))"
                maxlength="255"
                placeholder="No Alat Ukur"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.text
                name="no_GSM"
                label="No Gsm"
                :value="old('no_GSM', ($editing ? $pemeliharaan->no_GSM : ''))"
                maxlength="255"
                placeholder="No Gsm"
                required
            ></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.select name="user_id" label="User" required>
                @php $selected = old('user_id', ($editing ? $pemeliharaan->user_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
                @foreach($users as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.select
                name="alat_telemetri_id"
                label="Lokasi Stasiun"
                required
            >
                @php $selected = old('alat_telemetri_id', ($editing ? $pemeliharaan2->alat_telemetri_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Lokasi Stasiun</option>
                @foreach($alatTelemetri as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>

        <x-inputs.group class="col-md-6">
            <x-inputs.select
                name="jenisAlat_id"
                label="Jenis Peralatan"
                required
            >
                @php $selected = old('jenis_alat_id', ($editing ? $pemeliharaan2->alat_telemetri_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Jenis Alat Telemetri</option>
                @foreach($jenisAlat as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                @endforeach
            </x-inputs.select>
        </x-inputs.group>
        @php $editing = isset($komponen) @endphp

        @foreach ($komponen2 as $value)
        <div class="col-md-6">
            <x-inputs.group>
                <label for="namaKomponen">{{$value->nama}}</label>
                <span>{{ old('namaKomponen', ($editing ? $komponen2->nama : '')) }}</span>
            </x-inputs.group>
            @foreach ($detailKomponen->where('komponen2_id', $value->id) as $detailsKomponen)
            <x-inputs.group>
                <x-inputs.checkbox
                    name="detailKomponen"
                    label="{{ $detailsKomponen->namadetail }}"
                    :checked="old('detailKomponen', ($editing ? $detailKomponen->namadetail : 0))"
                ></x-inputs.checkbox>
            </x-inputs.group>
            @endforeach


        </div>
        @endforeach
        <div class="card">
            <div class="card-header" style="align-items: center";>
                <b>Tandatangan disini:</b>
            </div>
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
                  </div>
        {{-- @if (!$pemeliharaan->hasBeenSigned()) --}}
            {{-- <form action="{{ $pemeliharaan->getSignatureRoute() }}" method="POST">
                @csrf --}}
                <div style="text-align: center">
                    <x-creagia-signature-pad
                        border-color="#eaeaea"
                        pad-classes="rounded-x2 border-3"
                        button-classes="bg-gray-100 px-4 py-2 rounded-xl mt-6"

                        clear-name="Clear"
                        submit-name="Submit"
                        :disabled-without-signature="true"
                    />
                </div>
            <!-- {{-- </form> --}} -->
            <script src="{{ asset('vendor/sign-pad/sign-pad.min.js') }}"></script>
        <!-- {{-- @endif --}} -->
</div>
