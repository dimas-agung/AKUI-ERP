<?php

namespace Database\Seeders;

use App\Models\TransitCabutBuluHancuran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitCabutHancuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TransitCabutBuluHancuran::create([
            'unit'                  => '',
            'nomor_job'             => '040524-111450_A_uch',
            'jenis_rambang'         => 'HCR Rambang PK',
            'upah_operator'         => 6000,
            'berat'                 => 100,
            'nama_operator'         => 'Denes Marlifah',
            'nip_operator'          => 'Box123',
            'grade_operator'        => 'B',
            'nama_team_leader'      => 'Cobi',
            'waktu_penyebaran'      => '2024-07-13',
            'waktu_pengembalian'    => '2024-07-13',
        ]);
    }
}
