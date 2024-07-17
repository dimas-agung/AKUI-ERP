<?php

namespace Database\Seeders;

use App\Models\PreCleaningInput;
use App\Models\TransitGradingKasarStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreCleaningInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\StockTransitGradingKasar::factory(5)->create();
        PreCleaningInput::create([
            'doc_no' => '093511',
            'nomor_job' => '010324-093511',
            'id_box_grading_kasar' => 'ugk_010324-093513_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'nomor_batch' => '093513',
            'nama_supplier' => 'Koko Lim',
            'nomor_nota_internal' => '010324-093513',
            'id_box_raw_material' => 'AB_010324-093513',
            'jenis_raw_material' => 'K001',
            'jenis_kirim' => 'AB',
            'berat_kirim' => '10',
            'pcs_kirim' => '5',
            'kadar_air' => '15',
            'tujuan_kirim' => 'jombang',
            'nomor_grading' => 'ugk_010324-093513',
            'modal' => '5000',
            'total_modal' => '55000',
            'keterangan' => 'oke',
            'user_created' => 'Asc-275',
        ]);
        PreCleaningInput::create([
            'doc_no' => '093512',
            'nomor_job' => '010324-093512',
            'id_box_grading_kasar' => 'ugk_010324-093525_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'nomor_batch' => '093513',
            'nama_supplier' => 'Alba',
            'nomor_nota_internal' => '010324-093513',
            'id_box_raw_material' => 'AB_010324-093513',
            'jenis_raw_material' => 'K002',
            'jenis_kirim' => 'BC',
            'berat_kirim' => '20',
            'pcs_kirim' => '15',
            'kadar_air' => '15',
            'tujuan_kirim' => 'malang',
            'nomor_grading' => 'ugk_010324-093513',
            'modal' => '7000',
            'total_modal' => '75000',
            'keterangan' => 'Test 2',
            'user_created' => 'Asc-275',
        ]);
        PreCleaningInput::create([
            'doc_no' => '093513',
            'nomor_job' => '010324-093513',
            'id_box_grading_kasar' => 'ugk_010324-093525_GK',
            'nomor_bstb' => 'ugk_010324-093513',
            'nomor_batch' => '093513',
            'nama_supplier' => 'Aliando',
            'nomor_nota_internal' => '010324-093513',
            'id_box_raw_material' => 'AB_010324-093513',
            'jenis_raw_material' => 'K003',
            'jenis_kirim' => 'CD',
            'berat_kirim' => '30',
            'pcs_kirim' => '25',
            'kadar_air' => '15',
            'tujuan_kirim' => 'surabaya',
            'nomor_grading' => 'ugk_010324-093513',
            'modal' => 9000,
            'total_modal' => 95000,
            'keterangan' => 'Test 3',
            'user_created' => 'Asc-275',
        ]);
    }
}
