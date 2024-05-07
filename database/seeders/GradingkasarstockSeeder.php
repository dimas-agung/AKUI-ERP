<?php

namespace Database\Seeders;

use App\Models\GradingKasarStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingkasarstockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // \App\Models\GradingKasarStock::factory(5)->create();
        GradingKasarStock::create([
            'doc_no' => '275671',
            'nomor_batch' => '173621-275671_UGK',
            'id_box_grading_kasar' => 'K001',
            'id_box_raw_material' => 'K001',
            'nama_supplier' => 'Jawirr',
            'nomor_nota_internal' => 275671,
            'jenis_raw_material' => 'Celestial Wings',
            'jenis_grading' => 'Celestial Wings',
            'berat_masuk' => 150,
            'berat_keluar' => 0,
            'pcs_masuk' => 15,
            'pcs_keluar' => 0,
            'avg_kadar_air' => 55,
            'nomor_grading' => '716575',
            'modal' => 100,
            'total_modal' => 15000,
            'keterangan' => 'Test 1',
            'user_created' => 'Asd-134',
        ]);
        GradingKasarStock::create([
            'doc_no' => '275672',
            'nomor_batch' => '173621-275672_UGK',
            'id_box_grading_kasar' => 'K002',
            'id_box_raw_material' => 'K002',
            'nama_supplier' => 'Munawirr',
            'nomor_nota_internal' => 275672,
            'jenis_raw_material' => 'Celestial Wings',
            'jenis_grading' => 'Celestial Wings',
            'berat_masuk' => 200,
            'berat_keluar' => 0,
            'pcs_masuk' => 20,
            'pcs_keluar' => 0,
            'avg_kadar_air' => 55,
            'nomor_grading' => '716575',
            'modal' => 100,
            'total_modal' => 20000,
            'keterangan' => 'Test 2',
            'user_created' => 'Asd-134',
        ]);
        GradingKasarStock::create([
            'doc_no' => '275673',
            'nomor_batch' => '173621-275673_UGK',
            'id_box_grading_kasar' => 'K003',
            'id_box_raw_material' => 'K003',
            'nama_supplier' => 'Dinda',
            'nomor_nota_internal' => 275673,
            'jenis_raw_material' => 'Celestial Wings',
            'jenis_grading' => 'Celestial Wings',
            'berat_masuk' => 50,
            'berat_keluar' => 0,
            'pcs_masuk' => 5,
            'pcs_keluar' => 0,
            'avg_kadar_air' => 55,
            'nomor_grading' => '716575',
            'modal' => 100,
            'total_modal' => 5000,
            'keterangan' => 'Test 3',
            'user_created' => 'Asd-134',
        ]);
    }
}
