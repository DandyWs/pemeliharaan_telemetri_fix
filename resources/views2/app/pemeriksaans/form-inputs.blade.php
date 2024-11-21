@php $editing = isset($pemeriksaan) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="ttd"
            label="Ttd"
            :value="old('ttd', ($editing ? $pemeriksaan->ttd : ''))"
            maxlength="255"
            placeholder="Ttd"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="catatan"
            label="Catatan"
            :value="old('catatan', ($editing ? $pemeriksaan->catatan : ''))"
            maxlength="255"
            placeholder="Catatan"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="pemeliharaan2_id" label="Pemeliharaan2" required>
            @php $selected = old('pemeliharaan2_id', ($editing ? $pemeriksaan->pemeliharaan2_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Pemeliharaan2</option>
            @foreach($pemeliharaan2s as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
