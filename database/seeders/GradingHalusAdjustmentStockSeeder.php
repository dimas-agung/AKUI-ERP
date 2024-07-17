<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradingHalusAdjustmentStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradingHalusAdjustmentStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GradingHalusAdjustmentStock::create([
            'unit' => 'Grading Halus',
            'nomor_adjustment' => '	ADJ_130724_092246_A_UGH',
            'nomor_batch' => '	P202311.006.1012',
            'berat_adding' => 111,
            'pcs_adding' => 7,
            'modal' => 5457,
            'total_modal' => 605727,
            'status' => 0,
        ]);
    }
}
