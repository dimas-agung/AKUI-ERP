<?php

namespace Database\Seeders;

use App\Models\MmasterTujuanKirim;
use Illuminate\Database\Seeder;

class MmasterTujuanKirimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MmasterTujuanKirim::create([
            'tujuan_kirim' => 'Surabaya',
            'letak_kirim' => 'Gudang 1',
            'inisial_kirim' => 'K001',
            'status' => 1,
        ]);
        
        MmasterTujuanKirim::create([
            'tujuan_kirim' => 'Malaysia',
            'letak_kirim' => 'Gudang 2',
            'inisial_kirim' => 'K002',
            'status' => 0,
        ]);
        
        MmasterTujuanKirim::create([
            'tujuan_kirim' => 'Singapura',
            'letak_kirim' => 'Gudang 3',
            'inisial_kirim' => 'K003',
            'status' => 1,
        ]);

    }
}