<?php

namespace Database\Seeders;

use App\Models\MasterTujuanKirimGradingHalus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTujuanKirimGradingHalusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterTujuanKirimGradingHalus::create([
            'tujuan_kirim' => 'AKUI',
            'letak_tujuan' => 'INTERNAL',
            'inisial_tujuan' => 'AKI',
            'status' => 1,
        ]);
        MasterTujuanKirimGradingHalus::create([
            'tujuan_kirim' => 'ORIGINAL BERKAH',
            'letak_tujuan' => 'INTERNAL',
            'inisial_tujuan' => 'OBI',
            'status' => 1,
        ]);
        MasterTujuanKirimGradingHalus::create([
            'tujuan_kirim' => 'LOGISTIK',
            'letak_tujuan' => 'EKSTERNAL',
            'inisial_tujuan' => 'LOG',
            'status' => 1,
        ]);
    }
}
