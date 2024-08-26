<?php

namespace Database\Seeders;

use App\Models\MasterJenisKedatangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJenisKedatanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterJenisKedatangan::create([
            'jenis'             => '#A-MK-KW',
            'harga_estimasi'    => '10951',
            'user_created'      => 'Admin123',
        ]);
        MasterJenisKedatangan::create([
            'jenis'             => '#B-KK-KW',
            'harga_estimasi'    => '11373',
            'user_created'      => 'Admin123',
        ]);
        MasterJenisKedatangan::create([
            'jenis'             => '#D-SD-PB',
            'harga_estimasi'    => '10693',
            'user_created'      => 'Admin123',
        ]);
    }
}
