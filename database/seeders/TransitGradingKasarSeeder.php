<?php

namespace Database\Seeders;

use App\Models\TransitGradingKasar;
use Illuminate\Database\Seeder;

class TransitGradingKasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransitGradingKasar::create([
            'unit' => 'SBY001',
            'nomor_bstb' => 'BS001',
            'id_box' => 1,
            'nomor_batch' => 'BTC001',
            'nama_supplier' => 'Supplier 1',
            'jenis' => 'PTH001',
            'berat' => 1,
            'kadar_air' => 2,
            'modal' => 10000,
            'total_modal' => 40000,
        ]);
        TransitGradingKasar::create([
            'unit' => 'SGP001',
            'nomor_bstb' => 'BS002',
            'id_box' => 2,
            'nomor_batch' => 'BTC002',
            'nama_supplier' => 'Supplier 2',
            'jenis' => 'PTH002',
            'berat' => 10,
            'kadar_air' => 2,
            'modal' => 20000,
            'total_modal' => 60000,
        ]);
        TransitGradingKasar::create([
            'unit' => 'MLY001',
            'nomor_bstb' => 'BS003',
            'id_box' => 3,
            'nomor_batch' => 'BTC003',
            'nama_supplier' => 'Supplier 3',
            'jenis' => 'PTH003',
            'berat' => 30,
            'kadar_air' => 1,
            'modal' => 40000,
            'total_modal' => 80000,
        ]);
    }
}
