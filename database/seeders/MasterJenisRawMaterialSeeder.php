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
            'jenis' => 'PTH A',
            'kategori_susut' => 'SD',
            'upah_operator' => 5000,
            'pengurangan_harga' => 10,
            'harga_estimasi' => 20000,
            'status' => 1,
        ]);
        MasterJenisRawMaterial::create([
            'jenis' => 'PTH B',
            'kategori_susut' => 'SB',
            'upah_operator' => 6000,
            'pengurangan_harga' => 20,
            'harga_estimasi' => 30000,
            'status' => 1,
        ]);
        MasterJenisRawMaterial::create([
            'jenis' => 'PTH C',
            'kategori_susut' => 'SD',
            'upah_operator' => 7000,
            'pengurangan_harga' => 30,
            'harga_estimasi' => 40000,
            'status' => 1,
        ]);
        MasterJenisRawMaterial::create([
            'jenis' => 'PTH BULU',
            'kategori_susut' => 'SB',
            'upah_operator' => 7000,
            'pengurangan_harga' => 10,
            'harga_estimasi' => 40000,
            'status' => 1,
        ]);
    }
}
