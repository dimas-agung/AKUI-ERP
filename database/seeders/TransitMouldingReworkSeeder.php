<?php

namespace Database\Seeders;

use App\Models\TransitMouldingRework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitMouldingReworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransitMouldingRework::create([
            'unit' => 'Transit Mouldig Rework',
            'nomor_job_rework' => 'ufg_310724-093533',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Malang',
            'job_order' => 'SD',
            'berat_job' => 150,
            'pcs_job' => 15,
            'modal' => '5000',
            'total_modal' => '250000',
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'status' => 1,
        ]);
        TransitMouldingRework::create([
            'unit' => 'Transit Mouldig Rework',
            'nomor_job_rework' => 'ufg_310724-103525',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Jombang',
            'job_order' => 'MII',
            'berat_job' => 100,
            'pcs_job' => 10,
            'modal' => '5000',
            'total_modal' => '250000',
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'status' => 1,
        ]);
    }
}
