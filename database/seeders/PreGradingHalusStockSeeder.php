<?php

namespace Database\Seeders;

use App\Models\PreGradingHalusInput;
use App\Models\PreGradingHalusStock;
use App\Models\TransitPreCleaningStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreGradingHalusStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data=[];
        // for($i=0;$i<=100;$i++){
        //     $data= [
        //         'unit' => 'Grading Halus',
        //         'nomor_job' => '010324-093511',
        //         'id_box_grading_kasar' => 'ugk_010324-093513_GK',
        //         'nomor_bstb' => 'ugk_010324-093511',
        //         'id_box_raw_material' => 'AB_010324-093513',
        //         'nomor_batch' => '093513',
        //         'nomor_nota_internal' => '010324-093513',
        //         'nama_supplier' => 'Koko Lim',
        //         'status' => '1',
        //         'jenis_raw_material' => 'K001',
        //         'kadar_air' => '15',
        //         'jenis_kirim' => 'AB',
        //         'berat_kirim' => '10',
        //         'pcs_kirim' => '5',
        //         'tujuan_kirim' => 'jombang',
        //         'modal' => '5000',
        //         'total_modal' => '55000',
        //         'user_created' => 'Asc-275',
        //     ];
        //     PreGradingHalusInput::create($data);
        // }
        PreGradingHalusStock::create([
            'unit' => 'Grading Halus Stock',
            'nomor_job' => '010324-093511',
            'id_box_grading_kasar' => 'ugk_010324-093513_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'id_box_raw_material' => 'AB_010324-093513',
            'nomor_batch' => '093513',
            'nomor_nota_internal' => '010324-093513',
            'nama_supplier' => 'Koko Lim',
            'jenis_raw_material' => 'K001',
            'kadar_air' => '15',
            'jenis_kirim' => 'AB',
            'berat_masuk' => '10',
            'pcs_masuk' => '5',
            'berat_keluar' => '0',
            'pcs_keluar' => '0',
            'sisa_berat' => '10',
            'sisa_pcs' => '5',
            'tujuan_kirim' => 'jombang',
            'modal' => '5000',
            'total_modal' => '55000'
        ]);
        PreGradingHalusStock::create([
            'unit' => 'Grading Halus Stock',
            'nomor_job' => '010324-093522',
            'id_box_grading_kasar' => 'ugk_010324-093513_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'id_box_raw_material' => 'AB_010324-093513',
            'nomor_batch' => '093513',
            'nomor_nota_internal' => '010324-093513',
            'nama_supplier' => 'Janson',
            'jenis_raw_material' => 'K002',
            'kadar_air' => '30',
            'jenis_kirim' => 'AB',
            'berat_masuk' => '20',
            'pcs_masuk' => '10',
            'berat_keluar' => '0',
            'pcs_keluar' => '0',
            'sisa_berat' => '20',
            'sisa_pcs' => '10',
            'tujuan_kirim' => 'jombang',
            'modal' => '5000',
            'total_modal' => '55000'
        ]);
        PreGradingHalusStock::create([
            'unit' => 'Grading Halus Stock',
            'nomor_job' => '010324-093511',
            'id_box_grading_kasar' => 'ugk_010324-093513_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'id_box_raw_material' => 'AB_010324-093513',
            'nomor_batch' => '093513',
            'nomor_nota_internal' => '010324-093513',
            'nama_supplier' => 'Rere',
            'jenis_raw_material' => 'K001',
            'kadar_air' => '15',
            'jenis_kirim' => 'AB',
            'berat_masuk' => '50',
            'pcs_masuk' => '15',
            'berat_keluar' => '0',
            'pcs_keluar' => '0',
            'sisa_berat' => '50',
            'sisa_pcs' => '15',
            'tujuan_kirim' => 'jombang',
            'modal' => '5000',
            'total_modal' => '55000'
        ]);
        // \App\Models\TransitPreCleaningStock::factory(5)->create();
    }
}
