<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkenarioTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProdukTestSeeder::class,
            PesananTestSeeder::class,
            LaporanTestSeeder::class,
        ]);
    }
}
