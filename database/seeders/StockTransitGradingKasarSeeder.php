<?php

namespace Database\Seeders;

use App\Models\StockTransitGradingKasar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockTransitGradingKasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockTransitGradingKasar::create([
            'nomor_bstb'    => 1,
            'nama_supplier' => 'jawir',
            'jenis'         => 'Bahan',
            'berat'         => 3,
            'kadar_air'     => 3,
            'tujuan_kirim'  => 'Malang',
            'letak_tujuan'  => 'Batu',
            'inisial_tujuan'=> 'Mlg',
            'modal'         => 5000,
            'total_modal'   => 100,
            'keterangan'    => 'Ready Bolo',
            'user_created'  => 'Suplier',
            'user_updated'  => 35,
        ]);
        StockTransitGradingKasar::create([
            'nomor_bstb'    => 2,
            'nama_supplier' => 'Jamet',
            'jenis'         => 'Bahan',
            'berat'         => 3,
            'kadar_air'     => 3,
            'tujuan_kirim'  => 'Kediri',
            'letak_tujuan'  => 'Kota',
            'inisial_tujuan'=> 'Kdr',
            'modal'         => 5000,
            'total_modal'   => 100,
            'keterangan'    => 'Ready Rencang',
            'user_created'  => 'Suplier',
            'user_updated'  => 35,
        ]);
        StockTransitGradingKasar::create([
            'nomor_bstb'    => 3,
            'nama_supplier' => 'Jupri',
            'jenis'         => 'Bahan',
            'berat'         => 3,
            'kadar_air'     => 3,
            'tujuan_kirim'  => 'Surabaya',
            'letak_tujuan'  => 'Wonokromo',
            'inisial_tujuan'=> 'Sby',
            'modal'         => 5000,
            'total_modal'   => 100,
            'keterangan'    => 'Ready Rek',
            'user_created'  => 'Suplier',
            'user_updated'  => 35,
        ]);
    }
}
