<?php

namespace Database\Seeders;

use App\Models\Komponen2;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Komponen2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Komponen2::factory()
        //     ->count(5)
        //     ->create();
        DB::table('komponen2s')->insert([
            [   
                'id' => 1,
                'nama' => 'Modem',
            ],[
                'id' => 2,
                'nama' => 'Data Logger/Microcontroller',
            ],[
                'id' => 3,
                'nama' => 'AC/DC Converter',
            ],[
                'id' => 4,
                'nama' => 'DC/DC Converter',
            ],[
                'id' => 5,
                'nama' => 'Smart Battery Charger',
            ],[
                'id' => 6,
                'nama' => 'Antena GSM',
            ],[
                'id' => 7,
                'nama' => 'Baterai/Aki',
            ],[
                'id' => 8,
                'nama' => 'Sambungan PLN',
            ],[
                'id' => 9,
                'nama' => 'Setting Tipping Bucket',
            ],[
                'id' => 10,
                'nama' => 'Setting Water Level Sensor',
            ]
            ]);
    }
}
