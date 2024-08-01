<?php

namespace Database\Seeders;

use App\Models\MouldingPenyebaranRework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MouldingPenyebaranReworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MouldingPenyebaranRework::create([
            'nomor_job_rework' => 'ufg_310724-093533',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Malang',
            'job_order' => 'SD',
            'berat_job' => 150,
            'pcs_job' => 15,
            'modal' => '5000',
            'total_modal' => '250000',
            'waktu_penyebaran' => '2024-07-31 09:37:12',
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'keterangan' => 'Test',
            'status' => 1,
            'user_created' => 2002050693,
        ]);
        MouldingPenyebaranRework::create([
            'nomor_job_rework' => 'ufg_310724-103525',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Jombang',
            'job_order' => 'MII',
            'berat_job' => 100,
            'pcs_job' => 10,
            'modal' => '5000',
            'total_modal' => '250000',
            'waktu_penyebaran' => '2024-07-31 09:37:12',
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'keterangan' => 'Test 1',
            'status' => 1,
            'user_created' => 2002050693,
        ]);
    }
}
