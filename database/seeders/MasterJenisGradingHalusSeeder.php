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
            'jenis' => 'CHONG',
            'Kategori_susut' => 'SD',
            'upah_operator' => '5000',
            'pengurangan_harga' => '5',
            'harga_estimasi' => '55000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'G2-0-0-0',
            'Kategori_susut' => 'SD',
            'upah_operator' => '3000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'HCR',
            'Kategori_susut' => 'SB',
            'upah_operator' => '7000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '97000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'PTH-1-VIP-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '8000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '97000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'PTH-1-BSA-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '9000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '98000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'PTH-1-BSB-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '7000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '78000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingHalus::create([
            'jenis' => 'PTH-1-BSC-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '6000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '92000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
    }
}
