<?php

namespace Database\Seeders;

use App\Models\MasterTujuanKirimKedatangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTujuanKirimKedatanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MasterTujuanKirimKedatangan::create([
            'tujuan_kirim'      => 'Akui',
            'letak_tujuan'      => 'Internal',
            'inisial_tujuan'    => 'A',
            'user_created'      => 'Admin123',
        ]);
        MasterTujuanKirimKedatangan::create([
            'tujuan_kirim'      => 'Obi',
            'letak_tujuan'      => 'Internal',
            'inisial_tujuan'    => 'O',
            'user_created'      => 'Admin123',
        ]);
        MasterTujuanKirimKedatangan::create([
            'tujuan_kirim'      => 'Lamongan',
            'letak_tujuan'      => 'Eksternal',
            'inisial_tujuan'    => 'LMG',
            'user_created'      => 'Admin123',
        ]);
        MasterTujuanKirimKedatangan::create([
            'tujuan_kirim'      => 'Handa',
            'letak_tujuan'      => 'Eksternal',
            'inisial_tujuan'    => 'HND',
            'user_created'      => 'Admin123',
        ]);
        MasterTujuanKirimKedatangan::create([
            'tujuan_kirim'      => 'Logistik',
            'letak_tujuan'      => 'Logistik',
            'inisial_tujuan'    => 'LOG',
            'user_created'      => 'Admin123',
        ]);
        MasterTujuanKirimKedatangan::create([
            'tujuan_kirim'      => 'Dhofin',
            'letak_tujuan'      => 'Eksternal',
            'inisial_tujuan'    => 'DHF',
            'user_created'      => 'Admin123',
        ]);
    }
}
