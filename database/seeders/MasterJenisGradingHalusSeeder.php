<?php

namespace Database\Seeders;

use App\Models\MasterJenisGradingHalus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJenisGradingHalusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterJenisGradingHalus::create([
            'jenis' => 'Celestial Angel Wings',
            'Kategori_susut' => 'SD',
            'upah_operator' => '5000',
            'pengurangan_harga' => '25',
            'harga_estimasi' => '55000',
            'user_created' => 'Asc-173',
            'user_updated' => 'K001',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'Crystal Snow',
            'Kategori_susut' => 'Mii',
            'upah_operator' => '3000',
            'pengurangan_harga' => '15',
            'harga_estimasi' => '27000',
            'user_created' => 'Brg-637',
            'user_updated' => 'K002',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'Royal Cloud',
            'Kategori_susut' => 'SD',
            'upah_operator' => '7000',
            'pengurangan_harga' => '50',
            'harga_estimasi' => '97000',
            'user_created' => 'Exl-182',
            'user_updated' => 'K003',
            'status' => 1,
        ]);
    }
}
