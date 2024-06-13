<?php

namespace Database\Seeders;

use App\Models\DryAPenerimaanHancuranStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DryAPenerimaanHancuranStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DryAPenerimaanHancuranStock::create([
            'unit'                  => 'Dry A',
            'nomor_job'             => '040524-111450_A_uch',
            'jenis_rambang'         => 'HCR Rambang PK',
            'upah_operator'         => 40000,
            'berat'                 => 400,
            'nama_operator'         => 'Andi',
            'nip_operator'          => '118070004',
            'grade_operator'        => 'B',
            'nama_team_leader'      => 'TL B',
            'waktu_penyebaran'      => '2024-05-06 08:39:15',
            'waktu_pengembalian'    => '2024-06-04 07:46:38',
            'status'                => 1,
        ]);
        DryAPenerimaanHancuranStock::create([
            'unit'                  => 'Dry A',
            'nomor_job'             => '050524-111450_A_uch',
            'jenis_rambang'         => 'HCR PB',
            'upah_operator'         => 50000,
            'berat'                 => 500,
            'nama_operator'         => 'Budi',
            'nip_operator'          => '118070005',
            'grade_operator'        => 'C',
            'nama_team_leader'      => 'TL C',
            'waktu_penyebaran'      => '2024-05-07 08:39:15',
            'waktu_pengembalian'    => '2024-06-08 07:46:38',
            'status'                => 1,
        ]);
        DryAPenerimaanHancuranStock::create([
            'unit'                  => 'Dry A',
            'nomor_job'             => '060524-111450_A_uch',
            'jenis_rambang'         => 'HCR PT',
            'upah_operator'         => 60000,
            'berat'                 => 600,
            'nama_operator'         => 'Cici',
            'nip_operator'          => '118070006',
            'grade_operator'        => 'D',
            'nama_team_leader'      => 'TL D',
            'waktu_penyebaran'      => '2024-05-09 08:39:15',
            'waktu_pengembalian'    => '2024-06-02 07:46:38',
            'status'                => 1,
        ]);
    }
}
