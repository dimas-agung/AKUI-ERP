<?php

namespace Database\Seeders;

use App\Models\MasterJenisDryA;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJenisDryASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterJenisDryA::create([
            'jenis' => 'PT-1-PK-G',
            'kategori_susut' => 'SD',
            'upah_operator' => 7000,
            'pengurangan_harga' => 5,
            'harga_estimasi' => 15000,
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterJenisDryA::create([
            'jenis' => 'PT-1-PB-G',
            'kategori_susut' => 'SD',
            'upah_operator' => 8000,
            'pengurangan_harga' => 3,
            'harga_estimasi' => 30000,
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
    }
}
