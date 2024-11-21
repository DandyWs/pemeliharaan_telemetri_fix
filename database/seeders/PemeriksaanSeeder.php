<?php

namespace Database\Seeders;

use App\Models\Pemeriksaan;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemeriksaan::factory()
            ->count(5)
            ->create();
    }
}
