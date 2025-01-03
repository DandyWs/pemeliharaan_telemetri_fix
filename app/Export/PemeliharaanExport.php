<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemeliharaanExport implements FromCollection, WithHeadings
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Waktu',
            'Periode',
            'Cuaca',
            'No. Alat Ukur',
            'No. GSM',
            'Lokasi Stasiun',
            'Jenis Alat',
            'Keterangan',
            'User  ID',
            'TTD Mekanik',
            'TTD',
            'Catatan',
        ];
    }
}