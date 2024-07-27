<?php

namespace Database\Seeders;

use App\Models\GradingKasarOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingkasarOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // \App\Models\GradingKasarOutput::factory(5)->create();
        GradingKasarOutput::create([
            'nomor_bstb' => 'BSTB_173621-275671_UGK',
            'id_box_grading_kasar' => 'K001',
            'nomor_job' => '275671',
            'nomor_batch' => '173621-275671_UGK',
            'id_box_raw_material' => 'K001',
            'nama_supplier' => 'Jawirr',
            'jenis_raw_material' => 'Celestial Wings',
            'jenis_grading' => 'Celestial Wings',
            'berat_keluar' => 50,
            'pcs_keluar' => 50,
            'avg_kadar_air' => 55,
            'tujuan_kirim' => 'Jombang',
            'nomor_grading' => '716575',
            'modal' => 100,
            'total_modal' => 15000,
            'fix_total_modal' => 115000,
            'biaya_produksi' => 15000,
            'keterangan' => 'Test 1',
            'user_created' => 'Asd-134',
        ]);
        GradingKasarOutput::create([
            'nomor_bstb' => 'BSTB_173621-275672_UGK',
            'nomor_job' => '275672',
            'nomor_batch' => '173621-275672_UGK',
            'id_box_grading_kasar' => 'K002',
            'id_box_raw_material' => 'K002',
            'nama_supplier' => 'Munawirr',
            'jenis_raw_material' => 'Celestial Wings',
            'jenis_grading' => 'Celestial Wings',
            'berat_keluar' => 200,
            'pcs_keluar' => 20,
            'avg_kadar_air' => 55,
            'tujuan_kirim' => 'Malang',
            'nomor_grading' => '716575',
            'modal' => 100,
            'total_modal' => 20000,
            'fix_total_modal' => 120000,
            'biaya_produksi' => 20000,
            'keterangan' => 'Test 2',
            'user_created' => 'Asd-134',
        ]);
        GradingKasarOutput::create([
            'nomor_bstb' => 'BSTB_173621-275673_UGK',
            'nomor_job' => '275673',
            'nomor_batch' => '173621-275673_UGK',
            'id_box_grading_kasar' => 'K003',
            'id_box_raw_material' => 'K003',
            'nama_supplier' => 'Dinda',
            'jenis_raw_material' => 'Celestial Wings',
            'jenis_grading' => 'Celestial Wings',
            'berat_keluar' => 50,
            'pcs_keluar' => 5,
            'avg_kadar_air' => 55,
            'tujuan_kirim' => '716575',
            'nomor_grading' => '716575',
            'modal' => 100,
            'total_modal' => 5000,
            'fix_total_modal' => 15000,
            'biaya_produksi' => 5000,
            'keterangan' => 'Test 3',
            'user_created' => 'Asd-134',
        ]);
    }
}
