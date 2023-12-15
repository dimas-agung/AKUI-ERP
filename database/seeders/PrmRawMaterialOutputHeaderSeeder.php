<?php

namespace Database\Seeders;

use App\Models\PrmRawMaterialOutputHeader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrmRawMaterialOutputHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PrmRawMaterialOutputHeader::create([
            'doc_no'        => 1,
            'nomor_bstb'    => 1,
            'nomor_batch'   => 001,
            'keterangan'    => 'aman',
            'user_created'  => 'Jupri',
            'user_updated'  => 35,
        ]);
        PrmRawMaterialOutputHeader::create([
            'doc_no'        => 2,
            'nomor_bstb'    => 2,
            'nomor_batch'   => 002,
            'keterangan'    => 'aman',
            'user_created'  => 'Jupri',
            'user_updated'  => 36,
        ]);
    }
}
