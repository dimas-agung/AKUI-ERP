<?php

namespace Database\Seeders;

use App\Models\MasterTujuanKirimRawMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTujuanKirimRawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterTujuanKirimRawMaterial::create([
            'tujuan_kirim' => 'AKUI',
            'letak_tujuan' => 'INTERNAL',
            'inisial_tujuan' => 'AKI',
            'status' => 1,
        ]);
        MasterTujuanKirimRawMaterial::create([
            'tujuan_kirim' => 'ORIGINAL BERKAH',
            'letak_tujuan' => 'INTERNAL',
            'inisial_tujuan' => 'OBI',
            'status' => 1,
        ]);
        MasterTujuanKirimRawMaterial::create([
            'tujuan_kirim' => 'LOGISTIK',
            'letak_tujuan' => 'EKSTERNAL',
            'inisial_tujuan' => 'LOG',
            'status' => 1,
        ]);
    }
}
