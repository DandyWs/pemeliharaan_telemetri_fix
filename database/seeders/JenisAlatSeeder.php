<?php

namespace Database\Seeders;

use App\Models\JenisAlat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // JenisAlat::factory()
        //     ->count(5)
        //     ->create();
        DB::table('jenis_alats')->insert([
            [   
                'id' => 1,
                'namajenis' => 'WQMS',
                'setting' => TRUE
            ],[
                'id' => 2,
                'namajenis' => 'AWLR',
                'setting' => FALSE
            ],[
                'id' => 3,
                'namajenis' => 'ARR',
                'setting' => TRUE
            ]
            ]);
    }
}
