<?php

namespace Database\Seeders;

use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingHalusStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        GradingHalusStock::create([
            'unit' => 'Grading Halus',
            'id_box_grading_halus' => 'OB_010324-093525',
            'nomor_batch' => '093513',
            'jenis' => 'K001',
            'berat_masuk' => '50',
            'pcs_masuk' => '25',
            'berat_keluar' => '0',
            'pcs_keluar' => '0',
            'sisa_berat' => '50',
            'sisa_pcs' => '25',
            'modal' => '5000',
            'total_modal' => '55000',
        ]);
        GradingHalusStock::create([
            'unit' => 'Grading Halus',
            'id_box_grading_halus' => 'OB_010324-093550',
            'nomor_batch' => '093513',
            'jenis' => 'K002',
            'berat_masuk' => '50',
            'pcs_masuk' => '25',
            'berat_keluar' => '0',
            'pcs_keluar' => '0',
            'sisa_berat' => '50',
            'sisa_pcs' => '25',
            'modal' => '5000',
            'total_modal' => '55000',
        ]);
        GradingHalusStock::create([
            'unit' => 'Grading Halus',
            'id_box_grading_halus' => 'OB_010324-093100',
            'nomor_batch' => '093513',
            'jenis' => 'K002',
            'berat_masuk' => '50',
            'pcs_masuk' => '25',
            'berat_keluar' => '0',
            'pcs_keluar' => '0',
            'sisa_berat' => '50',
            'sisa_pcs' => '25',
            'modal' => '5000',
            'total_modal' => '55000',
        ]);
    }
}
