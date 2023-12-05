<?php

namespace Database\Seeders;

use App\Models\TransitGradingHalus;
use Illuminate\Database\Seeder;

class TransitGradingHalusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransitGradingHalus::create([
            'nomor_bstb' => 'BS001',
            'nomor_batch' => 'BTC001',
            'nama_supplier' => 'Supplier 1',
            'jenis' => 'PTH001',
            'berat' => 1,
            'pcs' => 1,
            'kadar_air' => 1,
            'nomor_job' => 'JB001',
            'modal' => 1000,
            'total_modal' => 10000,
            'timestamp'
        ]);
    }
}
