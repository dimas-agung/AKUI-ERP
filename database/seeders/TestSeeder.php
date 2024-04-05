<?php

namespace Database\Seeders;

use App\Models\PreGradingHalusAddingStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        PreGradingHalusAddingStock::create([
            'unit' => 'Grading Halus',
            'nomor_grading' => 'ugk_010324-093513',
            'id_box_grading_kasar' => 'ugk_010324-093513_GK',
            'id_box_raw_material' => 'AB_010324-093513',
            'nomor_batch' => '093513',
            'nomor_nota_internal' => '010324-093513',
            'nama_supplier' => 'Koko Lim',
            'jenis_raw_material' => 'K001',
            'kadar_air' => '15',
            'berat_adding' => '10',
            'pcs_adding' => '5',
            'modal' => '5000',
            'total_modal' => '55000',
            'status_stock' => 1,
        ]);
        PreGradingHalusAddingStock::create([
            'unit' => 'Grading Halus',
            'nomor_grading' => 'ugk_010324-093525',
            'id_box_grading_kasar' => 'ugk_010324-093525_GK',
            'id_box_raw_material' => 'OB_010324-093525',
            'nomor_batch' => '093525',
            'nomor_nota_internal' => '010324-093525',
            'nama_supplier' => 'Jefry Nichol',
            'jenis_raw_material' => 'K002',
            'kadar_air' => '20',
            'berat_adding' => '20',
            'pcs_adding' => '4',
            'modal' => '6000',
            'total_modal' => '65000',
            'status_stock' => 1,
        ]);
        PreGradingHalusAddingStock::create([
            'unit' => 'Grading Halus',
            'nomor_grading' => 'ugk_010324-093555',
            'id_box_grading_kasar' => 'ugk_010324-093555_GK',
            'id_box_raw_material' => 'EX_010324-093555',
            'nomor_batch' => '093555',
            'nomor_nota_internal' => '010324-093555',
            'nama_supplier' => 'Prabowo',
            'jenis_raw_material' => 'K003',
            'kadar_air' => '25',
            'berat_adding' => '30',
            'pcs_adding' => '6',
            'modal' => '9000',
            'total_modal' => '95000',
            'status_stock' => 1,
        ]);
    }
}
