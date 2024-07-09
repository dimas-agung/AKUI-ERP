<?php

namespace Database\Seeders;

use App\Models\TransitDryAHancuran;
use Illuminate\Database\Seeder;

class TransitDryAHancuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        TransitDryAHancuran::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'SD',
            'berat_job' => '50',
            'nomor_job' => 'ugk_010324-093001',
            'nomor_bstb' => '093513',
            'tujuan_kirim' => 'Jombang',
            'modal' => '5000',
            'total_modal' => '250000',
            'status' => 1
        ]);
        TransitDryAHancuran::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'MII',
            'berat_job' => '100',
            'nomor_job' => 'ugk_010324-093002',
            'nomor_bstb' => '093513',
            'tujuan_kirim' => 'Malang',
            'modal' => '5000',
            'total_modal' => '500000',
            'status' => 1
        ]);
        TransitDryAHancuran::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'SMP',
            'berat_job' => '150',
            'nomor_job' => 'ugk_010324-093003',
            'nomor_bstb' => '093511',
            'tujuan_kirim' => 'Madiun',
            'modal' => '5000',
            'total_modal' => '750000',
            'status' => 1
        ]);
        TransitDryAHancuran::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'MTs',
            'berat_job' => '200',
            'nomor_job' => 'ugk_010324-093533',
            'nomor_bstb' => '093512',
            'tujuan_kirim' => 'Lamongan',
            'modal' => '5000',
            'total_modal' => '1000000',
            'status' => 1
        ]);
        TransitDryAHancuran::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'SD',
            'berat_job' => '250',
            'nomor_job' => 'ugk_010324-093533',
            'nomor_bstb' => '093512',
            'tujuan_kirim' => 'Demak',
            'modal' => '5000',
            'total_modal' => '1250000',
            'status' => 1
        ]);
    }
}
