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
        for ($i = 0; $i <= 10; $i++) {
            TransitGradingHalus::create([
                'unit'          => 'Grading Halus',
                'nomor_job'     => '060224_084235_A_UGH' . $i,
                'nomor_batch'   => 'P202311.006.1012',
                'status'        => '1',
                'jenis_job'     => 'HCR',
                'berat_job'     => 11,
                'pcs_job'       => 0,
                'upah_operator' => 7000,
                'tujuan_kirim'  => 'AKUI',
                'keterangan'    => 'TES',
                'nomor_bstb'    => 'BSTB_060224_084235_A_UGH' . $i,
                'modal'         => '10000',
                'total_modal'   => '110000',
                'user_created'  => 'Admin123',
                'user_updated'  => 'Admin123',
            ]);
        }
        // for ($i = 0; $i <= 1000; $i++) {
        //     TransitGradingHalus::create([
        //         'unit'          => 'Grading Halus',
        //         'nomor_job'     => '060224_084235_A_UGH' . $i . '-2',
        //         'nomor_batch'   => 'P202311.006.1012',
        //         'status'        => '1',
        //         'jenis_job'     => 'HCR',
        //         'berat_job'     => 11,
        //         'pcs_job'       => 0,
        //         'upah_operator' => 7000,
        //         'tujuan_kirim'  => 'AKUI',
        //         'keterangan'    => 'TES',
        //         'nomor_bstb'    => 'BSTB_060224_084235_A_UGH-2',
        //         'modal'         => '10000',
        //         'total_modal'   => '110000',
        //         'user_created'  => 'Admin123',
        //         'user_updated'  => 'Admin123',
        //     ]);
        // }
        // for ($i = 0; $i <= 1000; $i++) {
        //     TransitGradingHalus::create([
        //         'unit'          => 'Grading Halus',
        //         'nomor_job'     => '060224_084235_A_UGH' . $i . '-3',
        //         'nomor_batch'   => 'P202311.006.1012',
        //         'status'        => '1',
        //         'jenis_job'     => 'HCR',
        //         'berat_job'     => 11,
        //         'pcs_job'       => 0,
        //         'upah_operator' => 7000,
        //         'tujuan_kirim'  => 'AKUI',
        //         'keterangan'    => 'TES',
        //         'nomor_bstb'    => 'BSTB_060224_084235_A_UGH-3',
        //         'modal'         => '10000',
        //         'total_modal'   => '110000',
        //         'user_created'  => 'Admin123',
        //         'user_updated'  => 'Admin123',
        //     ]);
        // }
        // for ($i = 0; $i <= 1000; $i++) {
        //     TransitGradingHalus::create([
        //         'unit'          => 'Grading Halus',
        //         'nomor_job'     => '060224_084235_A_UGH' . $i . '-4',
        //         'nomor_batch'   => 'P202311.006.1012',
        //         'status'        => '1',
        //         'jenis_job'     => 'HCR',
        //         'berat_job'     => 11,
        //         'pcs_job'       => 0,
        //         'upah_operator' => 7000,
        //         'tujuan_kirim'  => 'AKUI',
        //         'keterangan'    => 'TES',
        //         'nomor_bstb'    => 'BSTB_060224_084235_A_UGH-4',
        //         'modal'         => '10000',
        //         'total_modal'   => '110000',
        //         'user_created'  => 'Admin123',
        //         'user_updated'  => 'Admin123',
        //     ]);
        // }
    }
}
