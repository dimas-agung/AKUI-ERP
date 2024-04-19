<?php

namespace Database\Seeders;

use App\Models\PreCleaningStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreCleaningStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PreCleaningStock::create([
            'unit' => 'Pre Cleaning',
            'nomor_job' => '120124_102042_AKUI_UGK',
            'id_box_grading_kasar' => 'NG_090124-161335_ A_UGK_PTH BULU',
            'nomor_bstb' => 'BSTB_120124_102029_AKUI_UGK',
            'id_box_raw_material' => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'nomor_batch' => 'P202311.006.1012',
            'nomor_nota_internal' => 'DH_DHOFIN/102570-231123',
            'nama_supplier' => 'Dhofin',
            'jenis_raw_material' => 'PTH BULU',
            'kadar_air' => 3,
            'jenis_kirim' => 'PTH BULU',
            'berat_masuk' => 500,
            'berat_keluar' => 350,
            'pcs_masuk' => 431,
            'pcs_keluar' => 381,
            'sisa_berat' => 150,
            'sisa_pcs' => 50,
            'tujuan_kirim' => 'AKUI',
            'modal' => 7000,
            'total_modal' =>  1050000,
            'keterangan' => 'Tes',
            'nomor_grading' => 'NG_270224-235412_A_UGK',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
        ]);
        PreCleaningStock::create([
            'unit' => 'Pre Cleaning',
            'nomor_job' => '120124_102042_OBI_UGK',
            'id_box_grading_kasar' => 'NG_090124-161335_ O_UGK_PT 12 Flek',
            'nomor_bstb' => 'BSTB_120124_102029_OBI_UGK',
            'id_box_raw_material' => 'AB_ABEL/102570-231123_PT 12 Flek',
            'nomor_batch' => 'P202311.006.1012',
            'nomor_nota_internal' => 'AB_ABEL/102570-231123',
            'nama_supplier' => 'ABEL',
            'jenis_raw_material' => 'PT 12 Flek',
            'kadar_air' => 5,
            'jenis_kirim' => 'PT 12 Flek',
            'berat_masuk' => 750,
            'berat_keluar' => 450,
            'pcs_masuk' => 431,
            'pcs_keluar' => 250,
            'sisa_berat' => 300,
            'sisa_pcs' => 181,
            'tujuan_kirim' => 'OBI',
            'modal' => 6000,
            'total_modal' =>  180000,
            'keterangan' => 'Tes',
            'nomor_grading' => 'NG_270224-235412_O_UGK',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
        ]);
    }
}
