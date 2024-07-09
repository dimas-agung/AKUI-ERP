<?php

namespace Database\Seeders;

use App\Models\MasterJobMoulding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJobMouldingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterJobMoulding::create([
            'jenis' => 'Celestial Angel Wings',
            'kategori_susut' => 'A',
            'upah_operator' => 5000,
            'pengurangan_harga' => 10,
            'harga_estimasi' => 20000,
            'status' => 1,
        ]);
        MasterJobMoulding::create([
            'jenis' => 'Celestial Crown Special',
            'kategori_susut' => 'B',
            'upah_operator' => 6000,
            'pengurangan_harga' => 20,
            'harga_estimasi' => 30000,
            'status' => 1,
        ]);
        MasterJobMoulding::create([
            'jenis' => 'Crystal Snow',
            'kategori_susut' => 'C',
            'upah_operator' => 7000,
            'pengurangan_harga' => 30,
            'harga_estimasi' => 40000,
            'status' => 1,
        ]);
        MasterJobMoulding::create([
            'jenis' => 'Royal Cloud',
            'kategori_susut' => 'C',
            'upah_operator' => 7000,
            'pengurangan_harga' => 10,
            'harga_estimasi' => 40000,
            'status' => 1,
        ]);
    }
}
