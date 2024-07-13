<?php

namespace Database\Seeders;

use App\Models\TransitPreCleaningStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitPreCleaningStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\TransitPreCleaningStock::factory(5)->create();
        TransitPreCleaningStock::create([
            'nomor_job' => '010324-093511',
            'id_box_grading_kasar' => 'ugk_010324-093513_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'nomor_batch' => '093513',
            'nama_supplier' => 'Koko Lim',
            'nomor_nota_internal' => '010324-093513',
            'id_box_raw_material' => 'AB_010324-093513',
            'jenis_raw_material' => 'K001',
            'jenis_kirim' => 'AB',
            'berat_kirim' => '10',
            'pcs_kirim' => '5',
            'kadar_air' => '15',
            'tujuan_kirim' => 'AKUI',
            'nomor_grading' => 'ugk_010324-093513',
            'keterangan' => 'oke',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => 'Asc-275',
        ]);
    }
}
