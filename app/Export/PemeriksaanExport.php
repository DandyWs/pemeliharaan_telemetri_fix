<?php

namespace App\Exports;

use App\Models\Pemeliharaan;
use App\Models\Pemeriksaan;
use App\Models\Pemeliharaan2;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemeriksaanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pemeliharaan2::all(['id', 'tanggal', 'waktu', 'periode', 'cuaca', 'no_alatUkur', 'no_GSM', 'user_id', 'alat_telemetri_id']);
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Pemeliharaan',
            'Waktu Mulai',
            'Periode',
            'Cuaca',
            'No Alat Ukur',
            'No GSM',
            'User ID',
            'Peralatan Telemetri ID'
        ];
    }
}
