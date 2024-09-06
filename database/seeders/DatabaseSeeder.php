<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'username' => 'administrator',
            'email' => 'admin@gmail.com',
            'nohp' => '085872063116',
            'nik' => '321123098890873',
            'area' => 'mako',
            'role' => 'admin',
            'jabatan' => 'direktur',
            'password' => Hash::make('admin#123'),
        ]);
    }
}
