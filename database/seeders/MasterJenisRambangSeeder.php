<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterJenisRambang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterJenisRambangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterJenisRambang::create([
            'jenis' => 'HCR Kotor PK',
            'Kategori_susut' => '2',
            'upah_operator' => '5000',
            'pengurangan_harga' => '5',
            'harga_estimasi' => '55000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisRambang::create([
            'jenis' => 'HCR Kotor PB',
            'Kategori_susut' => 'SB',
            'upah_operator' => '3000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisRambang::create([
            'jenis' => 'HCR Kotor KR',
            'Kategori_susut' => 'SD',
            'upah_operator' => '3000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisRambang::create([
            'jenis' => 'HCR Kotor KN',
            'Kategori_susut' => 'SB',
            'upah_operator' => '3000',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisRambang::create([
            'jenis' => 'Bulu',
            'Kategori_susut' => '2',
            'upah_operator' => '2',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisRambang::create([
            'jenis' => 'Hcr Halus',
            'Kategori_susut' => '2',
            'upah_operator' => '2',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '2000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisRambang::create([
            'jenis' => 'Titilan',
            'Kategori_susut' => '2',
            'upah_operator' => '2',
            'pengurangan_harga' => '2',
            'harga_estimasi' => '7000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
    }
}
