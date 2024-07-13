<?php

namespace Database\Seeders;

use App\Models\PreGradingHalusAddingStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreGradingHalusAddingStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PreGradingHalusAddingStock::create([
            'unit'                  => 'Grading Halus',
            'nomor_grading'         => 'NG_130724_090146_A_UGH	',
            'id_box_grading_kasar'  => 'NG_090124-161335_ A_UGK_Sterofoam Karat',
            'id_box_raw_material'   => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'nomor_batch'           => 'P202311.006.1012',
            'nomor_nota_internal'   => 'DH_DHOFIN/102570-231123	',
            'nama_supplier'         => 'Dhofin',
            'jenis_raw_material'    => 'PTH BULU',
            'kadar_air'             => '0.25',
            'berat_adding'          => '451',
            'pcs_adding'            => '43',
            'modal'                 => '991.90',
            'total_modal'           => '447.345',
            'status_stock'          => '1',
        ]);
    }
}
