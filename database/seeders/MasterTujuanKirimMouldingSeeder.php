<?php

namespace Database\Seeders;

use App\Models\MasterTujuanKirimMoulding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTujuanKirimMouldingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterTujuanKirimMoulding::create([
            'tujuan_kirim' => 'Akui',
            'letak_tujuan' => 'Internal',
            'inisial_tujuan' => 'AKI',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterTujuanKirimMoulding::create([
            'tujuan_kirim' => 'Obi',
            'letak_tujuan' => 'Internal',
            'inisial_tujuan' => 'OBI',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterTujuanKirimMoulding::create([
            'tujuan_kirim' => 'Lamongan',
            'letak_tujuan' => 'Eksternal',
            'inisial_tujuan' => 'LMG',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterTujuanKirimMoulding::create([
            'tujuan_kirim' => 'Handa',
            'letak_tujuan' => 'Eksternal',
            'inisial_tujuan' => 'HND',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterTujuanKirimMoulding::create([
            'tujuan_kirim' => 'Logistik',
            'letak_tujuan' => 'Logistik',
            'inisial_tujuan' => 'LOG',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
        MasterTujuanKirimMoulding::create([
            'tujuan_kirim' => 'Dhofin',
            'letak_tujuan' => 'Eksternal',
            'inisial_tujuan' => 'DHF',
            'status' => 1,
            'user_created' => 'Admin123',
            'user_updated' => '',
        ]);
    }
}
