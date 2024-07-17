<?php

namespace Database\Seeders;

use App\Models\CabutHancuranPersiapanStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabutHancuranPersiapanStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CabutHancuranPersiapanStock::create([
            'nomor_job' => "040524-111450_A_uch",
            'jenis_rambang' => "HCR Rambang PK",
            'upah_operator' => 6000,
            'berat_masuk' => 100,
            'berat_keluar' => 100,
            'sisa_berat' => 0,
            'status' => 3,
        ]);
        CabutHancuranPersiapanStock::create([
            'nomor_job' => "040524-111602_A_uch",
            'jenis_rambang' => "HCR Rambang PK",
            'upah_operator' => 7000,
            'berat_masuk' => 400,
            'berat_keluar' => 0,
            'sisa_berat' => 400,
            'status' => 1,
        ]);
        CabutHancuranPersiapanStock::create([
            'nomor_job' => "040524-111612_A_uch",
            'jenis_rambang' => "HCR Rambang PB",
            'upah_operator' => 8000,
            'berat_masuk' => 500,
            'berat_keluar' => 0,
            'sisa_berat' => 500,
            'status' => 1,
        ]);
    }
}
