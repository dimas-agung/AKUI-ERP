<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransitMouldingRework;
use App\Models\TransitFinalGradingRework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransitMouldingReworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TransitMouldingRework::create([
            'unit'                      => 'Moulding',
            'nomor_job_rework'          => '290624_140303_A_UMD_R',
            'nomor_batch'               => 'P202401.001.1902',
            'tujuan_kirim'              => 'A',
            'job_order'                 => 'A-MK-KT',
            'berat_job'                 => 3,
            'pcs_job'                   => 5,
            'modal_per_jenis'           => 3000,
            'total_modal_per_jenis'     => 4000,
            'nama_operator'             => 'budi',
            'nip_operator'              => '2002050623',
            'grade_operator'            => 'SS',
            'nama_team_leader'          => 'Anton',
        ]);
        TransitMouldingRework::create([
            'unit'                      => 'Moulding',
            'nomor_job_rework'          => '290624_140303_O_UMD_R',
            'nomor_batch'               => 'P202401.001.1902',
            'tujuan_kirim'              => 'O',
            'job_order'                 => 'A-KT',
            'berat_job'                 => 5,
            'pcs_job'                   => 5,
            'modal_per_jenis'           => 5000,
            'total_modal_per_jenis'     => 9000,
            'nama_operator'             => 'Yono',
            'nip_operator'              => '2002050623',
            'grade_operator'            => 'SB',
            'nama_team_leader'          => 'Bakri',
        ]);
        TransitMouldingRework::create([
            'unit'                      => 'Moulding',
            'nomor_job_rework'          => '300624_140303_A_UMD_R',
            'nomor_batch'               => 'P202401.001.1902',
            'tujuan_kirim'              => 'A',
            'job_order'                 => 'B-KT',
            'berat_job'                 => 5,
            'pcs_job'                   => 5,
            'modal_per_jenis'           => 5000,
            'total_modal_per_jenis'     => 9000,
            'nama_operator'             => 'Yono',
            'nip_operator'              => '2002050623',
            'grade_operator'            => 'SB',
            'nama_team_leader'          => 'Bakri',
        ]);
    }
}
