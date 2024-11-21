<?php

namespace Database\Seeders;

use App\Models\Setting2;
use Illuminate\Database\Seeder;

class Setting2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting2::factory()
            ->count(5)
            ->create();
    }
}
