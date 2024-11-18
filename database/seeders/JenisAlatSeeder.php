<?php

namespace Database\Seeders;

use App\Models\JenisAlat;
use Illuminate\Database\Seeder;

class JenisAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisAlat::factory()
            ->count(5)
            ->create();
    }
}
