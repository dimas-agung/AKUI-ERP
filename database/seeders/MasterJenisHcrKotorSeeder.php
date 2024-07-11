<?php

namespace Database\Seeders;

use App\Models\MasterJenisHcrKotor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJenisHcrKotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterJenisHcrKotor::create([
            'jenis' => 'HCR Kotor PK',
            'Kategori_susut' => '',
            'upah_operator' => '5000',
            'pengurangan_harga' => '5',
            'harga_estimasi' => '55000',
            'user_created' => 'Admin123',
            'user_updated' => '',
            'status' => 1,
        ]);
        MasterJenisHcrKotor::create([
            'jenis' => 'HCR Kotor PB',
            'Kategori_susut' => 'SB',
            'upah_operator' => '3000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => '',
            'status' => 1,
        ]);
        MasterJenisHcrKotor::create([
            'jenis' => 'HCR Kotor KR',
            'Kategori_susut' => 'SD',
            'upah_operator' => '3000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => '',
            'status' => 1,
        ]);
        MasterJenisHcrKotor::create([
            'jenis' => 'HCR Kotor KN',
            'Kategori_susut' => 'SB',
            'upah_operator' => '3000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => '',
            'status' => 1,
        ]);
    }
}
