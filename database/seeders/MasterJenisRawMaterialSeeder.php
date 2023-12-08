<?php

namespace Database\Seeders;

use App\Models\MasterJenisRawMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJenisRawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterJenisRawMaterial::create([
            'jenis' => 'Calestial',
            'kategori_susut' => 'A',
            'upah_operator' => 5000,
            'pengurangan_harga' => 10000,
            'harga_estimasi' => 20000,
            'status' => 1,
        ]);
        MasterJenisRawMaterial::create([
            'jenis' => 'Crown',
            'kategori_susut' => 'B',
            'upah_operator' => 6000,
            'pengurangan_harga' => 20000,
            'harga_estimasi' => 30000,
            'status' => 1,
        ]);
        MasterJenisRawMaterial::create([
            'jenis' => 'Crown',
            'kategori_susut' => 'C',
            'upah_operator' => 7000,
            'pengurangan_harga' => 30000,
            'harga_estimasi' => 40000,
            'status' => 1,
        ]);
    }
}
