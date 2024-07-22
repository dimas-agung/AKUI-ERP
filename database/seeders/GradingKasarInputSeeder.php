<?php

namespace Database\Seeders;

use App\Models\GradingKasarInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingKasarInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // \App\Models\StockTransitRawMaterial::factory(5)->create();
        GradingKasarInput::create([
            'nomor_bstb' => 'BSTB_173621-275671_UGK',
            'nomor_batch' => '173621-275671_UGK',
            'id_box' => 'K001',
            'nama_supplier' => 'Jawirr',
            'jenis_raw_material' => 'Celestial Wings',
            'nomor_nota_internal' => 275671,
            'berat' => 150,
            'kadar_air' => 55,
            'nomor_grading' => '100824_100809',
            'modal' => 16000,
            'total_modal' => 200000,
            'keterangan' => 'Test 1',
            'user_created' => 'Asd-134',
        ]);
        GradingKasarInput::create([
            'nomor_bstb' => 'BSTB_173621-275672_UGK',
            'nomor_batch' => '173621-275671_UGK',
            'id_box' => 'K002',
            'nama_supplier' => 'Munawirr',
            'jenis_raw_material' => 'Celestial',
            'nomor_nota_internal' => 275671,
            'berat' => 200,
            'kadar_air' => 60,
            'nomor_grading' => '100824_100831',
            'modal' => 21000,
            'total_modal' => 350000,
            'keterangan' => 'Test 2',
            'user_created' => 'Asd-134',
        ]);
        GradingKasarInput::create([
            'nomor_bstb' => 'BSTB_173621-275673_UGK',
            'nomor_batch' => '173621-275671_UGK',
            'id_box' => 'K003',
            'nama_supplier' => 'Ahyarr',
            'jenis_raw_material' => 'Wings',
            'nomor_nota_internal' => 275671,
            'berat' => 350,
            'kadar_air' => 75,
            'nomor_grading' => '100824_100905',
            'modal' => 25000,
            'total_modal' => 100000,
            'keterangan' => 'Test 3',
            'user_created' => 'Asd-134',
        ]);
    }
}
