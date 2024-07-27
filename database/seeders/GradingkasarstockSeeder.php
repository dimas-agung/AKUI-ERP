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
            'nomor_batch' => 'Batch001',
            'id_box_grading_kasar' => 'NG_260724-144040_A_UGK_Christiansen Ltd',
            'id_box_raw_material' => 'PA_345_260724_Celestial Angel Wings_100	',
            'nama_supplier' => 'Jawirr',
            'nomor_nota_internal' => 'PA_345_260724',
            'jenis_raw_material' => 'Celestial Angel Wings',
            'jenis_grading' => 'Christiansen Ltd',
            'berat_masuk' => 150,
            'berat_keluar' => '0',
            'pcs_masuk' => 15,
            'pcs_keluar' => '0',
            'avg_kadar_air' => 55,
            'nomor_grading' => 'NG_260724-144040_A_UGK',
            'modal' => 1350,
            'total_modal' => 1.35000,
            'keterangan' => 'Test 1',
            'user_created' => 'Asd-134',
        ]);
    }
}
