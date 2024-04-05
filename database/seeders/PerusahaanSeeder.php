<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Perusahaan::create([
            'nama' => 'Akui Bird Nest Indonesia',
            'plant' => 'A',
            'status' => 1,
        ]);
        Perusahaan::create([
            'nama' => 'Original Berkah Indonesia',
            'plant' => 'O',
            'status' => 1,
        ]);
    }
}
