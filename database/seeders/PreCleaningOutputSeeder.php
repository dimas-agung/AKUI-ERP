<?php

namespace Database\Seeders;

use App\Models\PreCleaningOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreCleaningOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PreCleaningOutput::create([
            'nomor_job'                     => '120124_102042_AKUI_UGK',
            'id_box_grading_kasar'          => 'NG_090124-161335_ A_UGK_PTH BULU',
            'nomor_bstb'                    => 'BSTB_120724_144157_A_UPC',
            'id_box_raw_material'           => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'nomor_batch'                   => 'P202311.006.1012',
            'nomor_nota_internal'           => 'NG_100124-102025_ A_UGK',
            'nama_supplier'                 => 'DHOFIN',
            'jenis_raw_material'            => 'PTH BULU',
            'kadar_air'                     => '1',
            'jenis_kirim'                   => 'PTH BULU',
            'berat_kirim'                   => '5',
            'pcs_kirim'                     => '5',
            'tujuan_kirim'                  => 'AKUI',
            'modal'                         => '5',
            'total_modal'                   => '5',
            'operator_sikat_n_kompresor'    => 'Agus Mulyanto',
            'operator_flek_n_poles'         => 'Heri Susilo',
            'operator_cutter'               => 'Diki Arnando Prastio',
            'kuningan'                      => '2',
            'sterofoam'                     => '3',
            'karat'                         => '3',
            'rontokan_flek'                 => '2',
            'rontokan_bahan'                => '2',
            'rontokan_serabut'              => '3',
            'ws_0_0_0'                      => '3',
            'berat_pre_cleaning'            => '4',
            'pcs_pre_cleaning'              => '3',
            'susut'                         => '1',
            'keterangan'                    => 'tessss',
            'nomor_grading'                 => 'NG_270224-235412_A_UGK',
            'user_created'                  => 'Admin123',
        ]);
    }
}
