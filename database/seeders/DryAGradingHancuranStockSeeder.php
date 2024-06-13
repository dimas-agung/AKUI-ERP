<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DryAGradingHancuranStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DryAGradingHancuranStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DryAGradingHancuranStock::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'HCR-PB',
            'berat_masuk' => 100,
            'berat_keluar' => 0,
            'sisa_berat' => 100,
        ]);

        DryAGradingHancuranStock::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'HCR-PK',
            'berat_masuk' => 200,
            'berat_keluar' => 0,
            'sisa_berat' => 200,
        ]);

        DryAGradingHancuranStock::create([
            'unit' => 'Dry A',
            'jenis_grading' => 'PT-PK',
            'berat_masuk' => 300,
            'berat_keluar' => 0,
            'sisa_berat' => 300,
        ]);
    }
}
