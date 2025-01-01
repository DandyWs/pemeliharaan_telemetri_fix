<?php

namespace Database\Seeders;

use App\Models\Setting2;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Setting2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Setting2::factory()
        //     ->count(5)
        //     ->create();
        DB::table('setting2s')->insert([
            [   
                'id' => 1,
                'simulasi' => '255',
                'display' => '255',
                'kondisi' => TRUE,
                'jenis' => 'bucket',
                'pemeliharaan2_id' => 1
            ],[
                'id' => 2,
                'simulasi' => '255',
                'display' => '255',
                'kondisi' => TRUE,
                'jenis' => 'bucket',
                'pemeliharaan2_id' => 1
            ],[
                'id' => 3,
                'simulasi' => '255',
                'display' => '255',
                'kondisi' => FALSE,
                'jenis' => 'water',
                'pemeliharaan2_id' => 1
            ],[
                'id' => 4,
                'simulasi' => '255',
                'display' => '255',
                'kondisi' => FALSE,
                'jenis' => 'water',
                'pemeliharaan2_id' => 1
            ]
            ]);
    }
}
