<?php

namespace Database\Seeders;

use App\Models\CabutHancuranPengembalian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabutHancuranPengembalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CabutHancuranPengembalian::create([
            'nomor_job'             => '040524-111450_A_uch',
            'jenis_rambang'         => 'HCR Rambang PK	',
            'upah_operator'         => 6000,
            'berat'                 => 100,
            'nama_operator'         => 'Denes Marlifah',
            'nip_operator'          => 'Box123',
            'grade_operator'        => 'B',
            'nama_team_leader'      => 'Cobi',
            'waktu_penyebaran'      => '2024-07-13 10:51:19',
            'waktu_pengembalian'    => '2024-07-13 10:54:44',
            'lama_pengerjaan'       => 49,
            'status'                => 3,
            'user_created'          => 'Admin123',
            'user_updated'          => 'Admin123',
        ]);
    }
}
