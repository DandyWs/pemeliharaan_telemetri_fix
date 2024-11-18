<?php

namespace Database\Seeders;

use App\Models\Pemeliharaan2;
use Illuminate\Database\Seeder;

class Pemeliharaan2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemeliharaan2::factory()
            ->count(5)
            ->create();
    }
}
