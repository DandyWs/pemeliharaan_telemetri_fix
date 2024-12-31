<?php

namespace Database\Seeders;

use App\Models\Pemeliharaan2;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pemeliharaan2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pemeliharaan2::factory()
        //     ->count(5)
        //     ->create();
        DB::table('pemeliharaan2s')->insert([
            [   
                'id' => 1,
                'tanggal' => '2021-08-01 00:00:00',
                'waktu' => '2021-08-01 08:00:00',
                'periode' => 'Bulanan',
                'cuaca' => 'Cerah',
                'no_alatUkur' => 1,
                'no_GSM' => 1,
                'keterangan' => 'Pemeliharaan bulanan',
                'ttdMekanik' => 'mekanik/1.png',
                'tegangan' => '220',
                'alat_telemetri_id' => 1,
                'user_id' => 1
            ]
            ]);
    }
}
