<?php

namespace Database\Seeders;

use App\Models\MouldingWasteStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MouldingWasteStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i < 5; $i++) {
            MouldingWasteStock::create([
                'plant'                 => 'A',
                'unit'                  => 'Moulding',
                'id_box_waste_moulding' => 'ABC_A',
                'jenis_waste'           => 'ABC',
                'berat_masuk'           => 20,
                'berat_keluar'          => 0,
                'sisa_berat'            => 20,
                'pcs_masuk'             => 5,
                'pcs_keluar'            => 0,
                'sisa_pcs'              => 5,
                'modal'                 => 2000,
                'total_modal'           => 50000,
            ]);
        }
        for ($i = 0; $i < 5; $i++) {
            MouldingWasteStock::create([
                'plant'                 => 'O',
                'unit'                  => 'Moulding',
                'id_box_waste_moulding' => 'ABC_O',
                'jenis_waste'           => 'ABC',
                'berat_masuk'           => 20,
                'berat_keluar'          => 0,
                'sisa_berat'            => 20,
                'pcs_masuk'             => 5,
                'pcs_keluar'            => 0,
                'sisa_pcs'              => 5,
                'modal'                 => 2000,
                'total_modal'           => 50000,
            ]);
        }
    }
}
