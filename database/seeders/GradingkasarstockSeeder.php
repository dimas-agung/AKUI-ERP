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
            'doc_no' => '275671_UGK',
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
        // GradingKasarStock::create([
        //     'nomor_bstb' => 'BSTB_173621-275671_UGK',
        //     'nomor_batch' => '173621-275671_UGK',
        //     'id_box_grading_kasar' => 'K002',
        //     'nama_supplier' => 'Munawirr',
        //     'jenis' => 'Celestial',
        //     'nomor_nota_internal' => 275671,
        //     'berat' => 200,
        //     'kadar_air' => 60,
        //     'tujuan_kirim' => 'Jombang',
        //     'letak_tujuan' => 'Berkah',
        //     'inisial_tujuan' => 'B',
        //     'modal' => 21000,
        //     'total_modal' => 350000,
        //     'keterangan' => 'Test 2',
        //     'user_created' => 'Asd-134',
        // ]);
        // GradingKasarStock::create([
        //     'nomor_bstb' => 'BSTB_173621-275671_UGK',
        //     'nomor_batch' => '173621-275671_UGK',
        //     'id_box_grading_kasar' => 'K003',
        //     'nama_supplier' => 'Ahyarr',
        //     'jenis' => 'Wings',
        //     'nomor_nota_internal' => 275671,
        //     'berat' => 350,
        //     'kadar_air' => 75,
        //     'tujuan_kirim' => 'China',
        //     'letak_tujuan' => 'Akui',
        //     'inisial_tujuan' => 'C',
        //     'modal' => 25000,
        //     'total_modal' => 100000,
        //     'keterangan' => 'Test 3',
        //     'user_created' => 'Asd-134',
        // ]);
    }
}
