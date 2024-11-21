<?php

namespace Database\Seeders;

use App\Models\Komponen2;
use Illuminate\Database\Seeder;

class Komponen2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Komponen2::factory()
            ->count(5)
            ->create();
    }
}
