<?php

namespace Database\Seeders;

use App\Models\MouldingPersiapanRework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MouldingPersiapanReworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MouldingPersiapanRework::create([
            'nomor_job_rework' => 'ufg_310724-093100',
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
            'user_created' => 2002050693,
        ]);
        MouldingPersiapanRework::create([
            'nomor_job_rework' => 'ufg_310724-103333',
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
            'user_created' => 2002050693,
        ]);
    }
}
