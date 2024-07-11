<?php

namespace Database\Seeders;

use App\Models\MouldingStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MouldingStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MouldingStock::create([
            'unit' => 'Moulding',
            'nomor_job' => '290624_140200_A_UMD',
            'nomor_batch' => 'P202401.001.1902',
            'tujuan_kirim' => 'Akui',
            'job_order' => 'A-MK-KT',
            'berat_job' => 200,
            'pcs_job' => 50,
            'modal_nomor_job' => 1000,
            'total_modal_nomor_job' => 2000,
            'upah_operator' => 3000,
            'status' => 1,
        ]);

        MouldingStock::create([
            'unit' => 'Moulding',
            'nomor_job' => '290624_140222_O_UMD',
            'nomor_batch' => 'P202401.001.1902',
            'tujuan_kirim' => 'Akui',
            'job_order' => 'B-MK-KT',
            'berat_job' => 400,
            'pcs_job' => 100,
            'modal_nomor_job' => 2000,
            'total_modal_nomor_job' => 3000,
            'upah_operator' => 4000,
            'status' => 1,
        ]);
    }
}
