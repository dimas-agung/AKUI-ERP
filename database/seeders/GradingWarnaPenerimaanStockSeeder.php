<?php

namespace Database\Seeders;

use App\Models\GradingWarnaPenerimaanStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingWarnaPenerimaanStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i <= 5; $i++) {
            GradingWarnaPenerimaanStock::create([
                'nomor_job' => '070624-152524_AKI_UDA',
                'nomor_bstb' => 'BSTB_070624-163201_AKI_UDA',
                'nomor_batch' => ' P202401.001.1902 ',
                'tujuan_kirim' => 'Akui',
                'keterangan' => 'Tes Seeder',
                'berat_kotor' => 120,
                'jenis_grading' => 'HCR-PKB',
                'berat_1_grading' => 0,
                'pcs_1_grading' => 50,
                'berat_2_grading' => 200,
                'modal' => 4000,
                'total_modal' => 200000,
                'status' => 1,
            ]);
        }

        for ($i = 0; $i <= 3; $i++) {
            GradingWarnaPenerimaanStock::create([
                'nomor_job' => '070624-152533_AKI_UDA',
                'nomor_bstb' => 'BSTB_070624-163201_AKI_UDA',
                'nomor_batch' => ' P202401.001.1902 ',
                'tujuan_kirim' => 'Akui',
                'keterangan' => 'Tes Seeder 2',
                'berat_kotor' => 150,
                'jenis_grading' => 'HCR-KR',
                'berat_1_grading' => 400,
                'pcs_1_grading' => 100,
                'berat_2_grading' => 0,
                'modal' => 5000,
                'total_modal' => 2000000,
                'status' => 1,
            ]);
        }
        for ($i = 0; $i <= 4; $i++) {
            GradingWarnaPenerimaanStock::create([
                'nomor_job' => '090224-135011.88_A_GH',
                'nomor_bstb' => 'BSTB_20240528-123029_UDA',
                'nomor_batch' => ' P202401.001.1902 ',
                'tujuan_kirim' => 'Obi',
                'keterangan' => 'Tes Seeder 3',
                'berat_kotor' => 100,
                'jenis_grading' => 'PT-1-PK',
                'berat_1_grading' => 0,
                'pcs_1_grading' => 20,
                'berat_2_grading' => 100,
                'modal' => 2000,
                'total_modal' => 40000,
                'status' => 1,
            ]);
        }
    }
}
