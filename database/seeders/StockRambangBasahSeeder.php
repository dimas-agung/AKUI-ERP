<?php

namespace Database\Seeders;

use App\Models\StockRambangBasah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockRambangBasahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        StockRambangBasah::create([
            'unit' => 'Rambang',
            'id_box_hcr_kotor' => '200525_Putih Rambang',
            'jenis_rambang' => 'Putih Rambang',
            'berat_masuk' => 150,
            'berat_keluar' => 0,
            'sisa_berat' => 150,
        ]);
        StockRambangBasah::create([
            'unit' => 'Rambang',
            'id_box_hcr_kotor' => '200524_Hcr Rambang',
            'jenis_rambang' => 'Hcr Rambang',
            'berat_masuk' => 50,
            'berat_keluar' => 0,
            'sisa_berat' => 50,
        ]);
        StockRambangBasah::create([
            'unit' => 'Rambang',
            'id_box_hcr_kotor' => '200525_Hcr Rambang',
            'jenis_rambang' => 'Putih Rambang',
            'berat_masuk' => 200,
            'berat_keluar' => 0,
            'sisa_berat' => 200,
        ]);
        StockRambangBasah::create([
            'unit' => 'Rambang',
            'id_box_hcr_kotor' => '200524_Putih Rambang',
            'jenis_rambang' => 'Hcr Rambang',
            'berat_masuk' => 100,
            'berat_keluar' => 0,
            'sisa_berat' => 100,
        ]);
    }
}
