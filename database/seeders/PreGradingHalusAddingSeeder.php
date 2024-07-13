<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PreGradingHalusAdding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PreGradingHalusAddingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PreGradingHalusAdding::create([
            'nomor_grading'             => 'NG_130724_083756_O_UGH',
            'nomor_job'                 => '120124_101946_AKI_ugk',
            'id_box_grading_kasar'      => 'NG_090124-161335_ A_UGK_Sterofoam Karat',
            'id_box_raw_material'       => 'DH_DHOFIN/102570-231123_PTH BULU_7400	',
            'nomor_batch'               => 'P202311.006.1012',
            'nomor_nota_internal'       => 'DH_DHOFIN/102570-231123',
            'nama_supplier'             => 'Dhofin',
            'jenis_raw_material'        => 'PTH BULU',
            'kadar_air'                 => '0.25',
            'jenis_kirim'               => 'Sterofoam Karat	',
            'berat_kirim'               => '451',
            'pcs_kirim'                 => '43',
            'tujuan_kirim'              => 'Akui',
            'modal'                     => '3209',
            'total_modal'               => '447345',
            'user_created'              => 'Admin123',
        ]);
    }
}
