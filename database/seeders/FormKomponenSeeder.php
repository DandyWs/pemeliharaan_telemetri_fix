<?php

namespace Database\Seeders;

use App\Models\FormKomponen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormKomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // FormKomponen::factory()
        //     ->count(5)
        //     ->create();
        DB::table('form_komponens')->insert([
            [   
                'id' => 1,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 1,
                'cheked' => TRUE
            ],[
                'id' => 2,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 2,
                'cheked' => TRUE
            ],[
                'id' => 3,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 3,
                'cheked' => TRUE
            ],[
                'id' => 4,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 4,
                'cheked' => TRUE
            ],[
                'id' => 5,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 5,
                'cheked' => TRUE
            ],[
                'id' => 6,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 6,
                'cheked' => TRUE
            ],[
                'id' => 7,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 7,
                'cheked' => TRUE
            ],[
                'id' => 8,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 8,
                'cheked' => TRUE
            ],[
                'id' => 9,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 9,
                'cheked' => TRUE
            ],[
                'id' => 10,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 10,
                'cheked' => TRUE
            ],[
                'id' => 11,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 11,
                'cheked' => TRUE
            ],[
                'id' => 12,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 12,
                'cheked' => TRUE
            ],[
                'id' => 13,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 13,
                'cheked' => TRUE
            ],[
                'id' => 14,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 14,
                'cheked' => TRUE
            ],[
                'id' => 15,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 15,
                'cheked' => TRUE
            ],[
                'id' => 16,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 16,
                'cheked' => TRUE
            ],[
                'id' => 17,
                'pemeliharaan2_id' => 1,
                'detail_komponen_id' => 17,
                'cheked' => TRUE
            ]
            ]);
    }
}
