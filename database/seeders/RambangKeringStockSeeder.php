<?php

namespace Database\Seeders;

use App\Models\RambangKeringStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RambangKeringStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RambangKeringStock::create([
            'unit'              => 'Cleaning',
            'id_box_hcr_kotor'  => '230424_HCR Kotor PB',
            'jenis_rambang'     => 'Bulu',
            'berat_masuk'       => 50,
            'berat_keluar'      => 50,
            'sisa_berat'        => 0,
        ]);
    }
}
