<?php

namespace Database\Seeders;

use App\Models\MasterJenis;
use Illuminate\Database\Seeder;

class MasterJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterJenis::create([
            'datetime' => '2023-12-04 13:31:20',
            'jenis' => 'Calestial',
            'kategori_susut' => 'A',
            'upah_operator' => 5000,
            'pengurangan_harga' => 10000,
            'harga_estimasi' => 20000,
            'status' => 0,
        ]);
        MasterJenis::create([
            'datetime' => '2023-02-13 15:31:20',
            'jenis' => 'Calestial Crown',
            'kategori_susut' => 'C',
            'upah_operator' => 60000,
            'pengurangan_harga' => 20000,
            'harga_estimasi' => 30000,
            'status' => 1,
        ]);
        MasterJenis::create([
            'datetime' => '2023-09-14 16:31:20',
            'jenis' => 'Calestial',
            'kategori_susut' => 'C',
            'upah_operator' => 70000,
            'pengurangan_harga' => 30000,
            'harga_estimasi' => 40000,
            'status' => 0,
        ]);
    }
}
