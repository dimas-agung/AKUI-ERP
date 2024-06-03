<?php

namespace Database\Seeders;

use App\Models\DryAGradingCabutStock;
use Illuminate\Database\Seeder;

class DryAGradingStock extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        DryAGradingCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093533',
            'nomor_batch' => '093513',
            'berat_kotor' => '50',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '50',
            'pcs_1_grading' => '10',
            'berat_2_grading' => '0',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test',
            'modal' => '5000',
            'total_modal' => '55000',
            'status' => 1,
        ]);
        DryAGradingCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093533',
            'nomor_batch' => '093513',
            'berat_kotor' => '50',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '0',
            'pcs_1_grading' => '10',
            'berat_2_grading' => '25',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test',
            'modal' => '5000',
            'total_modal' => '55000',
            'status' => 1,
        ]);
        DryAGradingCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093522',
            'nomor_batch' => '093522',
            'berat_kotor' => '100',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '100',
            'pcs_1_grading' => '20',
            'berat_2_grading' => '0',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test',
            'modal' => '7000',
            'total_modal' => '77000',
            'status' => 1,
        ]);
        DryAGradingCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093522',
            'nomor_batch' => '093522',
            'berat_kotor' => '100',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '0',
            'pcs_1_grading' => '20',
            'berat_2_grading' => '25',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test',
            'modal' => '7000',
            'total_modal' => '77000',
            'status' => 1,
        ]);
        DryAGradingCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093522',
            'nomor_batch' => '093522',
            'berat_kotor' => '100',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '0',
            'pcs_1_grading' => '20',
            'berat_2_grading' => '25',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test',
            'modal' => '7000',
            'total_modal' => '77000',
            'status' => 1,
        ]);
        DryAGradingCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093511',
            'nomor_batch' => '093511',
            'berat_kotor' => '150',
            'jenis_grading' => 'SA',
            'berat_1_grading' => '0',
            'pcs_1_grading' => '30',
            'berat_2_grading' => '150',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test',
            'modal' => '5000',
            'total_modal' => '55000',
            'status' => 1,
        ]);
    }
}
