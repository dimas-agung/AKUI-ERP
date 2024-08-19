<?php

namespace Database\Seeders;

use App\Models\MasterJenisFinalGrading;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJenisFinalGradingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterJenisFinalGrading::create([
            'jenis'             => '#A-MK-KW',
            'kategori_susut'    => 'SD',
            'harga_estimasi'    => '10951',
            'user_created'      => 'Admin123',
        ]);
        MasterJenisFinalGrading::create([
            'jenis'             => '#B-KW',
            'kategori_susut'    => 'SD',
            'harga_estimasi'    => '5000',
            'user_created'      => 'Admin123',
        ]);
    }
}
