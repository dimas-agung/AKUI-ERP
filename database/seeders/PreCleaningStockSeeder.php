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
            'nomor_job' => '120124_102042_OBI_ugk',
            'id_box_grading_kasar' => 'NG_090124-161335_ O_UGK_PT 12 Flek',
            'nomor_bstb' => 'BSTB_120124_102029_OBI_ugk',
            'nomor_batch' => 'P202311.006.1012',
            'nama_supplier' => 'Dhofin',
            'nomor_nota_internal' => 'DH_DHOFIN/102570-231123',
            'id_box_raw_material' => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'jenis_raw_material' => 'PTH BULU',
            'tujuan_kirim' => 'Obi',
            'jenis_kirim' => 'PT 12 Flek',
            'berat_masuk' => 500,
            'pcs_masuk' => 431,
            'berat_keluar' => 500,
            'pcs_keluar' => 431,
            'avg_kadar_air' => 5,
            'nomor_grading' => 'tes',
            'modal' => 7069,
            'total_modal' =>  353,
            'keterangan' => 'tes',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
        ]);
        PreCleaningStock::create([
            'nomor_job' => '120124_103127_AKI_ugk',
            'id_box_grading_kasar' => 'NG_090124-161335_ O_UGK_PT 12 Flek',
            'nomor_bstb' => 'BSTB_120124_103054_AKI_ugk',
            'nomor_batch' => 'P202311.006.1012',
            'nama_supplier' => 'Dhofin',
            'nomor_nota_internal' => 'DH_DHOFIN/102570-231123',
            'id_box_raw_material' => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'jenis_raw_material' => 'PTH BULU',
            'tujuan_kirim' => 'Obi',
            'jenis_kirim' => 'PT 12 Flek',
            'berat_masuk' => 600,
            'pcs_masuk' => 231,
            'berat_keluar' => 700,
            'pcs_keluar' => 231,
            'avg_kadar_air' => 10,
            'nomor_grading' => 'tes',
            'modal' => 8000,
            'total_modal' =>  300000,
            'keterangan' => 'tes',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
        ]);
    }
}
