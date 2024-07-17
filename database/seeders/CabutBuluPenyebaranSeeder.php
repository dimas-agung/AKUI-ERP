<?php

namespace Database\Seeders;

use App\Models\CabutBuluPenyebaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabutBuluPenyebaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CabutBuluPenyebaran::create([
            'nomor_job'         => '060224-135009.62_A_GH',
            'nomor_batch'       => 'P202401.001.1902',
            'jenis_job'         => 'PT-1-VIP-PK',
            'berat_job'         => 200,
            'pcs_job'           => 31,
            'tujuan_kirim'      => 'Akui',
            'keterangan'        => 'SP-K',
            'modal'             => 1375,
            'total_modal'       => 2749119,
            'upah_operator'     => 5000,
            'waktu_penyebaran'  => '2024-07-13 10:22:59',
            'nama_operator'     => 'Andi Nugroho',
            'nip_operator'      => 'Bilas123',
            'grade_operator'    => 'B',
            'nama_team_leader'  => 'Cobi',
            'keterangan_2'      => 'tes',
            'user_created'      => 'Admin123',
        ]);
    }
}
