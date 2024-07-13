<?php

namespace Database\Seeders;

use App\Models\GradingHalusStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingHalusStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GradingHalusStock::create([
            'unit' => "Grading Halus",
            'id_box_grading_halus' => "P202311.006.1012_CHONG",
            'nomor_batch' => "P202311.006.1012",
            'jenis' => "CHONG",
            'berat_masuk' => 300,
            'pcs_masuk' => 23,
            'berat_keluar' => 89,
            'pcs_keluar' => 8,
            'sisa_berat' => 211,
            'sisa_pcs' => 15,
            'modal' => 5457,
            'total_modal' => 1637152,
        ]);
        GradingHalusStock::create([
            'unit' => "Grading Halus",
            'id_box_grading_halus' => "P202311.006.1012_HCR",
            'nomor_batch' => "P202311.006.1012",
            'jenis' => "HCR",
            'berat_masuk' => 200,
            'pcs_masuk' => 15,
            'berat_keluar' => 0,
            'pcs_keluar' => 0,
            'sisa_berat' => 200,
            'sisa_pcs' => 15,
            'modal' => 3028,
            'total_modal' => 605728,
        ]);
    }
}
