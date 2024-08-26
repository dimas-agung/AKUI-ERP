<?php

namespace Database\Seeders;

use App\Models\MouldingPersiapanReworkStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MouldingPersiapanReworkStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MouldingPersiapanReworkStock::create([
            'unit' => 'Moulding Rework',
            'nomor_job_rework' => 'ufg_310724-123456',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'A',
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
        MouldingPersiapanReworkStock::create([
            'unit' => 'Moulding Rework',
            'nomor_job_rework' => 'ufg_310724-654321',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'O',
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
