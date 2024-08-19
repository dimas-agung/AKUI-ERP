<?php

namespace Database\Seeders;

use App\Models\TransitFinalGradingRework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitFinalGradingReworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransitFinalGradingRework::create([
            'unit' => 'Final Grading',
            'nomor_job_rework' => 'ufg_310724-093533',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Malang',
            'job_order' => 'SD',
            'berat_job' => 150,
            'pcs_job' => 15,
            'modal_per_jenis' => '5000',
            'total_modal_per_jenis' => '250000',
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'status' => 1,
        ]);
        TransitFinalGradingRework::create([
            'unit' => 'Final Grading',
            'nomor_job_rework' => 'ufg_310724-103525',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Jombang',
            'job_order' => 'MII',
            'berat_job' => 100,
            'pcs_job' => 10,
            'modal_per_jenis' => '5000',
            'total_modal_per_jenis' => '250000',
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'status' => 1,
        ]);
    }
}
