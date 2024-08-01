<?php

namespace Database\Seeders;

use App\Models\TransitFinalGrading;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitFinalGradingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransitFinalGrading::create([
            'unit' => 'Final Grading',
            'nomor_job' => 'ufg_310724-093533',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Malang',
            'job_order' => 'SD',
            'jenis_grading' => 'SD',
            'berat_grading' => '150',
            'pcs_grading' => '15',
            'modal_per_jenis' => '5000',
            'total_modal_per_jenis' => '250000',
            'status' => 1,
        ]);
        TransitFinalGrading::create([
            'unit' => 'Final Grading',
            'nomor_job' => 'ufg_310724-103525',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Jombang',
            'job_order' => 'MII',
            'jenis_grading' => 'SD',
            'berat_grading' => '150',
            'pcs_grading' => '15',
            'modal_per_jenis' => '5000',
            'total_modal_per_jenis' => '250000',
            'status' => 1,
        ]);
    }
}
