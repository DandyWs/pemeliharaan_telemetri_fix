<?php

namespace Database\Seeders;

use App\Models\FormKomponen;
use Illuminate\Database\Seeder;

class FormKomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormKomponen::factory()
            ->count(5)
            ->create();
    }
}
