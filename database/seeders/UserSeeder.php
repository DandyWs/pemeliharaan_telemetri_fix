<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()
        //     ->count(5)
        //     ->create();
        DB::table('users')->insert([
            [   
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ],[
                'id' => 2,
                'name' => 'KA. Tim Kalibrasi Divisi',
                'email' => 'manager@manager.com',
                'password' => Hash::make('manager'),
                'role' => 'manager'
            ],[
                'id' => 3,
                'name' => 'Mekanik Pemeliharaan',
                'email' => 'mekanik@mekanik.com',
                'password' => Hash::make('mekanik'),
                'role' => 'mekanik'
            ]
            ]);
    }
}
