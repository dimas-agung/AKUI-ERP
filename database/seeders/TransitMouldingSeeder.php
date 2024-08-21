<?php

namespace Database\Seeders;

use App\Models\TransitPreWash;
use App\Models\TransitMoulding;
use Illuminate\Database\Seeder;
use App\Models\TransitMouldingRework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransitMouldingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TransitMoulding::create([
            'unit'                      => 'Moulding',
            'nomor_job'                 => '290624_140303_A_UMD',
            'nomor_batch'               => 'P202401.001.1902',
            'tujuan_kirim'              => 'A',
            'job_order'                 => 'A-MK-KT',
            'berat_job'                 => 163,
            'pcs_job'                   => 15,
            'modal_nomor_job'           => 6349,
            'total_modal_nomor_job'     => 1034998,
            'upah_operator'             => 41076,
            'nama_operator'             => 'Valentino',
            'nip_operator'              => '221060239',
            'grade_operator'            => 'X',
            'nama_team_leader'          => 'Son Goku',
        ]);
        TransitMoulding::create([
            'unit'                      => 'Moulding',
            'nomor_job'                 => '300624_140303_A_UMD',
            'nomor_batch'               => 'P202401.001.1902',
            'tujuan_kirim'              => 'A',
            'job_order'                 => 'A-MK-KT',
            'berat_job'                 => 163,
            'pcs_job'                   => 15,
            'modal_nomor_job'           => 6349,
            'total_modal_nomor_job'     => 1034998,
            'upah_operator'             => 41076,
            'nama_operator'             => 'Redo',
            'nip_operator'              => '221060239',
            'grade_operator'            => 'X',
            'nama_team_leader'          => 'Son Goku',
        ]);
        TransitMoulding::create([
            'unit'                      => 'Moulding',
            'nomor_job'                 => '290624_140303_O_UMD',
            'nomor_batch'               => 'P202401.001.1902',
            'tujuan_kirim'              => 'O',
            'job_order'                 => 'B-KT',
            'berat_job'                 => 200,
            'pcs_job'                   => 20,
            'modal_nomor_job'           => 5000,
            'total_modal_nomor_job'     => 20000,
            'upah_operator'             => 50000,
            'nama_operator'             => 'Doni',
            'nip_operator'              => '221060239',
            'grade_operator'            => 'X',
            'nama_team_leader'          => 'Son Goku',
        ]);
    }
}
