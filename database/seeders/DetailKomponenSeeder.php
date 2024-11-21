<?php

namespace Database\Seeders;

use App\Models\DetailKomponen;
use Illuminate\Database\Seeder;

class DetailKomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailKomponen::factory()
            ->count(5)
            ->create();
    }
}
