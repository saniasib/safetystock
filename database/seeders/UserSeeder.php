<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'nama_user' => 'Admin Utama',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );
        User::updateOrCreate(
            ['email' => 'produksi@test.com'],
            [
                'nama_user' => 'Staf Produksi',
                'password' => Hash::make('password'),
                'role' => 'produksi_gudang'
            ]
        );
        User::updateOrCreate(
            ['email' => 'pemilik@test.com'],
            [
                'nama_user' => 'Pemilik Usaha',
                'password' => Hash::make('password'),
                'role' => 'pemilik'
            ]
        );
    }
}
