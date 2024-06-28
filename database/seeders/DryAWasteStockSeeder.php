<?php

namespace Database\Seeders;

use App\Models\DryAWasteStock;
use Illuminate\Database\Seeder;

class DryAWasteStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        DryAWasteStock::create([
            'unit' => 'Dry A',
            'jenis_waste' => 'Kuningan',
            'berat_masuk' => '50',
            'berat_keluar' => '0',
            'sisa_berat' => '50',
            'pcs_masuk' => '10',
            'pcs_keluar' => '0',
            'sisa_pcs' => '10',
            'modal' => '1000',
            'total_modal' => '50000',
            'status' => 1,
        ]);
        DryAWasteStock::create([
            'unit' => 'Dry A',
            'jenis_waste' => 'Mii',
            'berat_masuk' => '100',
            'berat_keluar' => '0',
            'sisa_berat' => '100',
            'pcs_masuk' => '20',
            'pcs_keluar' => '0',
            'sisa_pcs' => '20',
            'modal' => '1000',
            'total_modal' => '100000',
            'status' => 1,
        ]);
        DryAWasteStock::create([
            'unit' => 'Dry A',
            'jenis_waste' => 'SD',
            'berat_masuk' => '150',
            'berat_keluar' => '0',
            'sisa_berat' => '150',
            'pcs_masuk' => '30',
            'pcs_keluar' => '0',
            'sisa_pcs' => '30',
            'modal' => '1000',
            'total_modal' => '300000',
            'status' => 1,
        ]);
    }
}
