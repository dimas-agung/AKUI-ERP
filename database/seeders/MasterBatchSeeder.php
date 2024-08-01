<?php

namespace Database\Seeders;

use App\Models\MasterBatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterBatch::create([
            'nomor_batch'   => 'P202401.001.1902',
            'user_created'  => 'Admin123',
        ]);
    }
}
