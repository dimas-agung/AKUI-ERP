<?php

namespace Database\Seeders;

use App\Models\PrmRawMaterialOutputItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrmRawMaterialOutputItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrmRawMaterialOutputItem::create([
            'doc_no'        => 1,
            'nomor_bstb'    => 1,
            'nomor_batch'   => 001,
            'id_box'        => 001,
            'nama_supplier' => 'Jarwo',
            'jenis'         => 01,
            'berat'         => 30,
            'kadar_air'     => 1,
            'tujuan_kirim'  => 'Malang',
            'letak_tujuan'  => 'Batu',
            'inisial_tujuan'=> 'Mlg',
            'modal'         => 1500,
            'total_modal'   => 3000,
            'keterangan'    => 'aman',
            'user_created'  => 'Jupri',
            'user_updated'  => 35,
        ]);
        PrmRawMaterialOutputItem::create([
            'doc_no'        => 2,
            'nomor_bstb'    => 2,
            'nomor_batch'   => 002,
            'id_box'        => 002,
            'nama_supplier' => 'Jarwo',
            'jenis'         => 02,
            'berat'         => 30,
            'kadar_air'     => 2,
            'tujuan_kirim'  => 'Malang',
            'letak_tujuan'  => 'Batu',
            'inisial_tujuan'=> 'Mlg',
            'modal'         => 2500,
            'total_modal'   => 3000,
            'keterangan'    => 'aman',
            'user_created'  => 'Jupri',
            'user_updated'  => 35,
        ]);
    }
}
