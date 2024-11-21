<?php

namespace Database\Seeders;

use App\Models\AlatTelemetri;
use Illuminate\Database\Seeder;

class AlatTelemetriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlatTelemetri::factory()
            ->count(5)
            ->create();
    }
}
