<?php

namespace Database\Seeders;

use App\Models\MasterTujuan;
use Illuminate\Database\Seeder;

class MasterTujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterTujuan::create([
            'tujuan_kirim' => 'Surabaya',
            'letak_tujuan' => 'Gudang 1',
            'inisial_tujuan' => 'K001',
            'status' => 1,
        ]);

        MasterTujuan::create([
            'tujuan_kirim' => 'Malaysia',
            'letak_tujuan' => 'Gudang 2',
            'inisial_tujuan' => 'K002',
            'status' => 0,
        ]);

        MasterTujuan::create([
            'tujuan_kirim' => 'Singapura',
            'letak_tujuan' => 'Gudang 3',
            'inisial_tujuan' => 'K003',
            'status' => 1,
        ]);
    }
}
