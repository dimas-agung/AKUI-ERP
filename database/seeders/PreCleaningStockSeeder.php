<?php

namespace Database\Seeders;

use App\Models\PreCleaningStock;
use App\Models\TransitGradingKasarStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreCleaningStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<100;$i++){
            PreCleaningStock::create([
                'unit' => 'Pre-Cleaning',
                'nomor_job' => '010324-093511',
                'id_box_grading_kasar' => 'ugk_010324-093513_GK',
                'nomor_bstb' => 'ugk_010324-093511',
                'nomor_batch' => '093513',
                'nama_supplier' => 'Koko Lim',
                'nomor_nota_internal' => '010324-093513',
                'id_box_raw_material' => 'AB_010324-093513',
                'jenis_raw_material' => 'K001',
                'tujuan_kirim' => 'jombang',
                'jenis_kirim' => 'AB',
                'berat_masuk' => '10',
                'berat_keluar' => '0',
                'sisa_berat' => '0',
                'pcs_masuk' => '5',
                'pcs_keluar' => '0',
                'sisa_pcs' => '5',
                'kadar_air' => '15',
                'nomor_grading' => 'ugk_010324-093513',
                'modal' => '5000',
                'total_modal' => '55000',
                'keterangan' => 'oke',
                'user_created' => 'Asc-275',
            ]);
        }
    }
}
