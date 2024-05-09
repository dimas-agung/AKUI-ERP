<?php

namespace Database\Seeders;

use App\Models\RambangBasahStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RambangBasahStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RambangBasahStock::create([
            'workstation'           => 'Cleaning',
            'unit'                  => 'Rambang',
            'id_box_hcr_kotor'      => '230424_HCR Kotor PB',
            'jenis_rambang'         => 'Bulu',
            'berat_masuk'           => 200,
            'berat_keluar'          => 0,
            'sisa_berat'            => 200,
        ]);
        RambangBasahStock::create([
            'workstation'           => 'Cleaning',
            'unit'                  => 'Rambang',
            'id_box_hcr_kotor'      => '230424_HCR Kotor PB',
            'jenis_rambang'         => 'Bulu',
            'berat_masuk'           => 200,
            'berat_keluar'          => 0,
            'sisa_berat'            => 200,
        ]);
        RambangBasahStock::create([
            'workstation'           => 'Cleaning',
            'unit'                  => 'Rambang',
            'id_box_hcr_kotor'      => '230424_HCR Kotor PB',
            'jenis_rambang'         => 'Bulu',
            'berat_masuk'           => 200,
            'berat_keluar'          => 0,
            'sisa_berat'            => 200,
        ]);
    }
}
