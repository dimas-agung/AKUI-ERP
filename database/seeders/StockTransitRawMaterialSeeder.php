<?php

namespace Database\Seeders;

use App\Models\StockTransitRawMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockTransitRawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // \App\Models\StockTransitRawMaterial::factory(5)->create();
        StockTransitRawMaterial::create([
            'nomor_bstb' => 'BSTB_173621-275671_UGK',
            'nomor_batch' => '173621-275671_UGK',
            'id_box' => 'K001',
            'nama_supplier' => 'Jawirr',
            'jenis' => 'Celestial Wings',
            'nomor_nota_internal' => 275671,
            'berat' => 150,
            'kadar_air' => 55,
            'tujuan_kirim' => 'Jombang',
            'letak_tujuan' => 'Akui',
            'inisial_tujuan' => 'A',
            'modal' => 16000,
            'total_modal' => 200000,
            'keterangan' => 'Test 1',
            'user_created' => 'Asd-134',
        ]);
        StockTransitRawMaterial::create([
            'nomor_bstb' => 'BSTB_173621-275671_UGK',
            'nomor_batch' => '173621-275671_UGK',
            'id_box' => 'K002',
            'nama_supplier' => 'Munawirr',
            'jenis' => 'Celestial',
            'nomor_nota_internal' => 275671,
            'berat' => 200,
            'kadar_air' => 60,
            'tujuan_kirim' => 'Jombang',
            'letak_tujuan' => 'Berkah',
            'inisial_tujuan' => 'B',
            'modal' => 21000,
            'total_modal' => 350000,
            'keterangan' => 'Test 2',
            'user_created' => 'Asd-134',
        ]);
        StockTransitRawMaterial::create([
            'nomor_bstb' => 'BSTB_173621-275671_UGK',
            'nomor_batch' => '173621-275671_UGK',
            'id_box' => 'K003',
            'nama_supplier' => 'Ahyarr',
            'jenis' => 'Wings',
            'nomor_nota_internal' => 275671,
            'berat' => 350,
            'kadar_air' => 75,
            'tujuan_kirim' => 'China',
            'letak_tujuan' => 'Akui',
            'inisial_tujuan' => 'C',
            'modal' => 25000,
            'total_modal' => 100000,
            'keterangan' => 'Test 3',
            'user_created' => 'Asd-134',
        ]);
    }
}
