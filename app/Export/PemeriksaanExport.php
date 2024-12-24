<?php

namespace App\Exports;

use App\Models\Pemeliharaan2;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemeriksaanExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pemeliharaan2::all(['id', 'tanggal', 'periode', 'cuaca', 'user_id']);
    }

    /**
     * Mendefinisikan header kolom di file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Periode',
            'Cuaca',
            'User ID',
        ];
    }
}




