<?php

namespace Database\Seeders;

use App\Models\MasterTujuanKirimDryA;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTujuanKirimDryASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterTujuanKirimDryA::create([
            'tujuan_kirim' => 'Surabaya',
            'letak_tujuan' => 'Gudang 1',
            'inisial_tujuan' => 'K001',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterTujuanKirimDryA::create([
            'tujuan_kirim' => 'Singapura',
            'letak_tujuan' => 'Gudang 2',
            'inisial_tujuan' => 'K002',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterTujuanKirimDryA::create([
            'tujuan_kirim' => 'Malaysia',
            'letak_tujuan' => 'Gudang 3',
            'inisial_tujuan' => 'K003',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
    }
}
