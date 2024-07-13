<?php

namespace Database\Seeders;

use App\Models\PreWashInput;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PreWashInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PreWashInput::create([
            'nomor_job' => '060224_084235_A_UGH0',
            'nomor_batch' => 'P202311.006.1012',
            'jenis_job' => 'HCR',
            'berat_job' => 11,
            'pcs_job' => 0,
            'upah_operator' => 7000,
            'tujuan_kirim' => 'AKUI',
            'keterangan' => 'tes',
            'nomor_bstb' => 'BSTB_060224_084235_A_UGH0',
            'status' => 1,
            'modal' => 10000,
            'total_modal' => 110000,
            'user_created' => 'Admin123',
        ]);
    }
}
