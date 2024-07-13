<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradingHalusAdjustmentAdding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradingHalusAdjustmentAddingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GradingHalusAdjustmentAdding::create([
            'id_box_grading_halus'  => 'P202311.006.1012_CHONG	',
            'nomor_batch'           => 'P202311.006.1012',
            'jenis_adding'          => 'CHONG',
            'berat_adding'          => '111',
            'pcs_adding'            => '7',
            'keterangan'            => 'tes',
            'modal'                 => '5457',
            'total_modal'           => '605727',
            'nomor_adjustment'      => 'ADJ_130724_091132_A_UGH',
            'status'                => 0,
            'user_created'          => 'Admin123',
            'user_created'          => 'Admin123',
        ]);
    }
}
