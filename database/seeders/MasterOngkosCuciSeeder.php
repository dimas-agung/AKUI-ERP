<?php

namespace Database\Seeders;

use App\Models\MasterOngkosCuci;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterOngkosCuciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterOngkosCuci::create([
            'unit' => 'Grading Halus',
            'jenis_bulu' => 'VIP',
            'biaya_per_gram' => 1100,
            'status' => 1,
        ]);
        MasterOngkosCuci::create([
            'unit' => 'Grading Halus',
            'jenis_bulu' => 'BSA',
            'biaya_per_gram' => 1500,
            'status' => 1,
        ]);
        MasterOngkosCuci::create([
            'unit' => 'Grading Halus',
            'jenis_bulu' => 'BSB',
            'biaya_per_gram' => 2200,
            'status' => 1,
        ]);
        MasterOngkosCuci::create([
            'unit' => 'Grading Halus',
            'jenis_bulu' => 'BSC',
            'biaya_per_gram' => 3300,
            'status' => 1,
        ]);
    }
}
