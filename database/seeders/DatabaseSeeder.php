<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);

        $this->call(AlatTelemetriSeeder::class);
        $this->call(DetailKomponenSeeder::class);
        $this->call(FormKomponenSeeder::class);
        $this->call(JenisAlatSeeder::class);
        $this->call(Komponen2Seeder::class);
        $this->call(Pemeliharaan2Seeder::class);
        $this->call(PemeriksaanSeeder::class);
        $this->call(Setting2Seeder::class);
        $this->call(UserSeeder::class);
    }
}
