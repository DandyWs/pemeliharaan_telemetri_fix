<?php

namespace Database\Seeders;

use App\Models\Pemeriksaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pemeriksaan::factory()
        //     ->count(5)
        //     ->create();
        DB::table('pemeriksaans')->insert([
            [   
                'id' => 1,
                'ttd' => 'manager/1.png',
                'catatan' => 'Pemeriksaan bulanan',
                'pemeliharaan2_id' => 1,
                'user_id' => 1
            ]
            ]);
    }
}
