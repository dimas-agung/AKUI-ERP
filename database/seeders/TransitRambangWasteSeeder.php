<?php

namespace Database\Seeders;

use App\Models\TransitRambangWaste;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitRambangWasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TransitRambangWaste::create([
            'unit'          => 'Cleaning',
            'nomor_bstb'    => 'BSTB_130724_103656_A_UPC',
            'jenis_rambang' => 'Bulu',
            'berat'         => 50,
            'status'        => 1,
        ]);
    }
}
