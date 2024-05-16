<?php

namespace Database\Seeders;

use App\Models\CabutBuluStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabutBuluStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CabutBuluStock::create([
            'workstation' => "Cleaning",
            'unit' => "Cabut Bulu",
            'nomor_job' => "060224-135009.62_A_GH",
            'nomor_batch' => "P202401.001.1902",
            'jenis_job' => "PT-1-VIP-PK",
            'berat_job' => 200,
            'pcs_job' => 31,
            'tujuan_kirim' => "Akui",
            'keterangan' => "SP-K",
            'modal' => 1375,
            'total_modal' => 2749119,
            'status' => "1",
        ]);

        CabutBuluStock::create([
            'workstation' => "Cleaning",
            'unit' => "Cabut Bulu",
            'nomor_job' => "060224-135011.68_A_GH",
            'nomor_batch' => "P202401.001.1902",
            'jenis_job' => "PT-1-BSC-PK",
            'berat_job' => 60,
            'pcs_job' => 7,
            'tujuan_kirim' => "Akui",
            'keterangan' => "SP-K",
            'modal' => 12671,
            'total_modal' => 760300,
            'status' => "2",
        ]);

        CabutBuluStock::create([
            'workstation' => "Cleaning",
            'unit' => "Cabut Bulu",
            'nomor_job' => "060224-135013.25_A_GH",
            'nomor_batch' => "P202401.001.1902",
            'jenis_job' => "PT-3-BSA-PK",
            'berat_job' => 135,
            'pcs_job' => 1,
            'tujuan_kirim' => "Akui",
            'keterangan' => "K",
            'modal' => 10655,
            'total_modal' => 1438513,
            'status' => "2",
        ]);
    }
}
