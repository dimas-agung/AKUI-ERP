<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterJenisGradingKasar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterJenisGradingKasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterJenisGradingKasar::create([
            'nama' => 'CHONG',
            'Kategori_susut' => 'SD',
            'upah_operator' => '5000',
            'presentase_pengurangan_harga' => '5',
            'harga_estimasi' => '55000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingKasar::create([
            'nama' => 'G2-0-0-0',
            'Kategori_susut' => 'SD',
            'upah_operator' => '3000',
            'presentase_pengurangan_harga' => '2',
            'harga_estimasi' => '27000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingKasar::create([
            'nama' => 'HCR',
            'Kategori_susut' => 'SB',
            'upah_operator' => '7000',
            'presentase_pengurangan_harga' => '1',
            'harga_estimasi' => '97000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingKasar::create([
            'nama' => 'PTH-1-VIP-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '8000',
            'presentase_pengurangan_harga' => '1',
            'harga_estimasi' => '97000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingKasar::create([
            'nama' => 'PTH-1-BSA-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '9000',
            'presentase_pengurangan_harga' => '2',
            'harga_estimasi' => '98000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingKasar::create([
            'nama' => 'PTH-1-BSB-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '7000',
            'presentase_pengurangan_harga' => '3',
            'harga_estimasi' => '78000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
        MasterJenisGradingKasar::create([
            'nama' => 'PTH-1-BSC-PK',
            'Kategori_susut' => 'SD',
            'upah_operator' => '6000',
            'presentase_pengurangan_harga' => '2',
            'harga_estimasi' => '92000',
            'user_created' => 'Admin123',
            'user_updated' => 'Admin123',
            'status' => 1,
        ]);
    }
}
