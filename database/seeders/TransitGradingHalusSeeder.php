<?php

namespace Database\Seeders;

use App\Models\TransitGradingHalus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitGradingHalusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TransitGradingHalus::create([
            'unit'          => 'Grading Halus',
            'nomor_job'     => '060224_084235_A_UGH',
            'nomor_batch'   => 'P202311.006.1012',
            'status'        => '1',
            'jenis_job'     => 'HCR',
            'berat_job'     => 11,
            'pcs_job'       => 0,
            'tujuan_kirim'  => 'AKUI',
            'keterangan'    => 'TES',
            'nomor_bstb'    => 'BSTB_060224_084235_A_UGH',
            'modal'         => '10000',
            'total_modal'   => '110000',
            'user_created'  => 'Admin123',
            'user_updated'  => 'Admin123',
        ]);
        TransitGradingHalus::create([
            'unit'          => 'Grading Halus',
            'nomor_job'     => '060224_084243_A_UGH',
            'nomor_batch'   => 'P202311.006.1012',
            'status'        => '1',
            'jenis_job'     => 'HCR',
            'berat_job'     => 28,
            'pcs_job'       => 0,
            'tujuan_kirim'  => 'AKUI',
            'keterangan'    => 'TES',
            'nomor_bstb'    => 'BSTB_060224_084235_A_UGH',
            'modal'         => '10000',
            'total_modal'   => '110000',
            'user_created'  => 'Admin123',
            'user_updated'  => 'Admin123',
        ]);
        TransitGradingHalus::create([
            'unit'          => 'Grading Halus',
            'nomor_job'     => '010224-073242.78_O_GH',
            'nomor_batch'   => 'P202311.006.1012',
            'status'        => '1',
            'jenis_job'     => 'PT-1-BSA-PB',
            'berat_job'     => 30,
            'pcs_job'       => 0,
            'tujuan_kirim'  => 'AKUI',
            'keterangan'    => 'TES',
            'nomor_bstb'    => 'BSTB_060224_084235_O_UGH',
            'modal'         => '10000',
            'total_modal'   => '110000',
            'user_created'  => 'Admin123',
            'user_updated'  => 'Admin123',
        ]);
    }
}
