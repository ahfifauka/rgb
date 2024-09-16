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
            'nik' => 'RGB-86.10.24.0032',
            'area' => 'mako',
            'role' => 'admin',
            'jabatan' => 'direktur',
            'password' => Hash::make('admin#123'),
            'status' => 'menikah',
            'level' => 'manops',
            'alamat' => 'jln sana no 100',
            'name_pasangan' => 'admincwe',
            'name_anak' => 'adminanak',
            'golongan_darah' => 'A',
            'kta' => 'ya',
            'agama' => 'islam',
            'jenis_kelamin' => 'laki-laki',
            'ktp' => 'ya',
            'skck' => 'ya',
            'lamaran' => 'ya',
            'foto' => 'ya',
            'surat_sehat' => 'ya',
            'ijazah' => 'ya',
            'kk' => 'ya',
            'izin_ortu' => 'ya',
            'paklaring' => 'ya',
            'sim' => 'ya',
        ]);
    }
}
