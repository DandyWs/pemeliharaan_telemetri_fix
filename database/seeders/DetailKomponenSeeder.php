<?php

namespace Database\Seeders;

use App\Models\DetailKomponen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailKomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DetailKomponen::factory()
        //     ->count(5)
        //     ->create();
        DB::table('detail_komponens')->insert([
            [   
                'id' => 1,
                'komponen2_id' => 1,
                'namadetail' => 'Indikator LED',
            ],[
                'id' => 2,
                'komponen2_id' => 1,
                'namadetail' => 'Sim Card',
            ],[
                'id' => 3,
                'komponen2_id' => 2,
                'namadetail' => 'Test SMS Manual dan Setting RTC',
            ],[
                'id' => 4,
                'komponen2_id' => 2,
                'namadetail' => 'Indikator LED',
            ],[
                'id' => 5,
                'komponen2_id' => 2,
                'namadetail' => 'Pembersihan dan Pengecekan SONDE',
            ],[
                'id' => 6,
                'komponen2_id' => 3,
                'namadetail' => 'Pemeriksaan Kondisi Alat',
            ],[
                'id' => 7,
                'komponen2_id' => 3,
                'namadetail' => 'Pemeriksaan Sambungan Kabel',
            ],[
                'id' => 8,
                'komponen2_id' => 4,
                'namadetail' => 'Pemeriksaan Kondisi Alat',
            ],[
                'id' => 9,
                'komponen2_id' => 4,
                'namadetail' => 'Pemeriksaan Sambungan Kabel',
            ],[
                'id' => 10,
                'komponen2_id' => 5,
                'namadetail' => 'Pemeriksaan Kondisi Alat',
            ],[
                'id' => 11,
                'komponen2_id' => 5,
                'namadetail' => 'Pemeriksaan Sambungan Kabel',
            ],[
                'id' => 12,
                'komponen2_id' => 6,
                'namadetail' => 'Pemeriksaan Kondisi Alat',
            ],[
                'id' => 13,
                'komponen2_id' => 6,
                'namadetail' => 'Pemeriksaan Sambungan Kabel',
            ],[
                'id' => 14,
                'komponen2_id' => 7,
                'namadetail' => 'Pemeriksaan Level Air Aki',
            ],[
                'id' => 15,
                'komponen2_id' => 7,
                'namadetail' => 'Pemeriksaan Sambungan Kabel',
            ],[
                'id' => 16,
                'komponen2_id' => 8,
                'namadetail' => 'Pemeriksaan Kondisi Alat',
            ],[
                'id' => 17,
                'komponen2_id' => 8,
                'namadetail' => 'Pemeriksaan Sambungan Kabel',
            ]
            ]);
    }
}
