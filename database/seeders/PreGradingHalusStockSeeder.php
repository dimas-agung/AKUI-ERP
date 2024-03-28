<?php

namespace Database\Seeders;

use App\Models\PreGradingHalusStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreGradingHalusStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PreGradingHalusStock::create([
            'unit' => 'Grading Halus',
            'nomor_job' => '120124_101946_AKI_ugk',
            'id_box_grading_kasar' => 'NG_090124-161335_ A_UGK_Sterofoam Karat',
            'nomor_bstb' => 'BSTB_250124_093229_AKI_UPC',
            'id_box_raw_material' => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'nomor_batch' => 'P202311.006.1012',
            'nomor_nota_internal' => 'DH_DHOFIN/102570-231123',
            'nama_supplier' => 'Dhofin',
            'jenis_raw_material' => 'PTH BULU',
            'kadar_air' => '0.25',
            'jenis_kirim' => 'Sterofoam Karat',
            'berat_masuk' => 451,
            'pcs_masuk' => 43,
            'berat_keluar' => 0,
            'pcs_keluar' => 0,
            'sisa_berat' => 451,
            'sisa_pcs' => 43,
            'tujuan_kirim' => 'Akui',
            'modal' => 3209,
            'total_modal' =>  447345,
        ]);
        PreGradingHalusStock::create([
            'unit' => 'Grading Halus',
            'nomor_job' => '120124_102042_OBI_ugk',
            'id_box_grading_kasar' => 'NG_090124-161335_ O_UGK_PT 12 Flek',
            'nomor_bstb' => 'BSTB_250124_093229_AKI_UPC',
            'id_box_raw_material' => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'nomor_batch' => 'P202311.006.1012',
            'nomor_nota_internal' => 'DH_DHOFIN/102570-231123',
            'nama_supplier' => 'Dhofin',
            'jenis_raw_material' => 'PTH BULU',
            'kadar_air' => '0.25',
            'jenis_kirim' => 'PT 12 Flek',
            'berat_masuk' => 500,
            'pcs_masuk' => 431,
            'berat_keluar' => 0,
            'pcs_keluar' => 0,
            'sisa_berat' => 500,
            'sisa_pcs' => 431,
            'tujuan_kirim' => 'OBI',
            'modal' => 7069,
            'total_modal' =>  3534447,
        ]);
    }
}
