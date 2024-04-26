<?php

namespace Database\Seeders;

use App\Models\StockTransitGradingKasar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitGradingKasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\StockTransitGradingKasar::factory(5)->create();
        StockTransitGradingKasar::create([
            'nomor_job' => '010324-093511',
            'id_box_grading_kasar' => 'ugk_010324-093513_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'nomor_batch' => '093513',
            'nama_supplier' => 'Koko Lim',
            'nomor_nota_internal' => '010324-093513',
            'id_box_raw_material' => 'AB_010324-093513',
            'jenis_raw_material' => 'K001',
            'jenis_grading' => 'AB',
            'berat_keluar' => '10',
            'pcs_keluar' => '5',
            'avg_kadar_air' => '15',
            'tujuan_kirim' => 'jombang',
            'nomor_grading' => 'ugk_010324-093513',
            'modal' => '5000',
            'total_modal' => '55000',
            'biaya_produksi' => '55000',
            'fix_total_modal' => '55000',
            'keterangan' => 'oke',
            'user_created' => 'Asc-275',
        ]);
        StockTransitGradingKasar::create([
            'nomor_job' => '010324-093512',
            'id_box_grading_kasar' => 'ugk_010324-093525_GK',
            'nomor_bstb' => 'ugk_010324-093511',
            'nomor_batch' => '093513',
            'nama_supplier' => 'Alba',
            'nomor_nota_internal' => '010324-093513',
            'id_box_raw_material' => 'AB_010324-093513',
            'jenis_raw_material' => 'K002',
            'jenis_grading' => 'BC',
            'berat_keluar' => '20',
            'pcs_keluar' => '15',
            'avg_kadar_air' => '15',
            'tujuan_kirim' => 'malang',
            'nomor_grading' => 'ugk_010324-093513',
            'modal' => '7000',
            'total_modal' => '75000',
            'biaya_produksi' => '55000',
            'fix_total_modal' => '55000',
            'keterangan' => 'Test 2',
            'user_created' => 'Asc-275',
        ]);
        StockTransitGradingKasar::create([
            'nomor_job' => '010324-093513',
            'id_box_grading_kasar' => 'ugk_010324-093525_GK',
            'nomor_bstb' => 'ugk_010324-093513',
            'nomor_batch' => '093513',
            'nama_supplier' => 'Aliando',
            'nomor_nota_internal' => '010324-093513',
            'id_box_raw_material' => 'AB_010324-093513',
            'jenis_raw_material' => 'K003',
            'jenis_grading' => 'CD',
            'berat_keluar' => '30',
            'pcs_keluar' => '25',
            'avg_kadar_air' => '15',
            'tujuan_kirim' => 'surabaya',
            'nomor_grading' => 'ugk_010324-093513',
            'modal' => '9000',
            'total_modal' => '95000',
            'biaya_produksi' => '55000',
            'fix_total_modal' => '55000',
            'keterangan' => 'Test 3',
            'user_created' => 'Asc-275',
        ]);
    }
}
