<?php

namespace Database\Seeders;

use App\Models\AlatTelemetri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatTelemetriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AlatTelemetri::factory()
        //     ->count(5)
        //     ->create();
        DB::table('alat_telemetris')->insert([
            [   
                'id' => 1,
                'lokasiStasiun' => 'WS Brantas',
                'jenis_alat_id' => 1
            ],[
                'id' => 2,
                'lokasiStasiun' => 'WS Solo',
                'jenis_alat_id' => 1
            ],[
                'id' => 3,
                'lokasiStasiun' => 'WS Lodoyo',
                'jenis_alat_id' => 1
            ],[
                'id' => 4,
                'lokasiStasiun' => 'WS Brantas',
                'jenis_alat_id' => 2
            ],[
                'id' => 5,
                'lokasiStasiun' => 'WS Solo',
                'jenis_alat_id' => 2
            ],[
                'id' => 6,
                'lokasiStasiun' => 'WS Lodoyo',
                'jenis_alat_id' => 2
            ],[
                'id' => 7,
                'lokasiStasiun' => 'WS Brantas',
                'jenis_alat_id' => 3
            ],[
                'id' => 8,
                'lokasiStasiun' => 'WS Solo',
                'jenis_alat_id' => 3
            ],[
                'id' => 9,
                'lokasiStasiun' => 'WS Lodoyo',
                'jenis_alat_id' => 3
            ]
            ]);
    }
}
