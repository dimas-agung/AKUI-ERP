<?php

namespace Database\Seeders;

use App\Models\PrmRawMaterialStockHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrmRawMaterialStockHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PrmRawMaterialStockHistory::create([
            'id_box'            => 'AB_ABEL_NT123_120724_PTH A_3000',
            'doc_no'            => '2024071101',
            'berat_masuk'       => '50',
            'berat_keluar'      => '0',
            'sisa_berat'        => '50',
            'avg_kadar_air'     => '1',
            'modal'             => '1500',
            'total_modal'       => '75000',
            'fix_harga_deal'    => '1500',
            'keterangan'        => 'tes',
            'status'            => '1',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialStockHistory::create([
            'id_box'            => 'AB_ABEL_NT123_120724_PTH A_3000',
            'doc_no'            => '2024071101',
            'berat_masuk'       => '50',
            'berat_keluar'      => '0',
            'sisa_berat'        => '50',
            'avg_kadar_air'     => '1',
            'modal'             => '1500',
            'total_modal'       => '75000',
            'fix_harga_deal'    => '1500',
            'keterangan'        => 'tes',
            'status'            => '1',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialStockHistory::create([
            'id_box'            => 'DH_DHOFIN_NT456_130724_PTH A_4000',
            'doc_no'            => '2024071102',
            'berat_masuk'       => '50',
            'berat_keluar'      => '0',
            'sisa_berat'        => '50',
            'avg_kadar_air'     => '1',
            'modal'             => '1500',
            'total_modal'       => '75000',
            'fix_harga_deal'    => '1500',
            'keterangan'        => 'tes',
            'status'            => '1',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialStockHistory::create([
            'id_box'            => 'DH_DHOFIN_NT456_130724_PTH A_4000',
            'doc_no'            => '2024071102',
            'berat_masuk'       => '50',
            'berat_keluar'      => '0',
            'sisa_berat'        => '50',
            'avg_kadar_air'     => '1',
            'modal'             => '1500',
            'total_modal'       => '75000',
            'fix_harga_deal'    => '1500',
            'keterangan'        => 'tes',
            'status'            => '1',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialStockHistory::create([
            'id_box'            => 'PS_PAK SALEH_NT789_140724_PTH A_4000',
            'doc_no'            => '2024071103',
            'berat_masuk'       => '50',
            'berat_keluar'      => '0',
            'sisa_berat'        => '50',
            'avg_kadar_air'     => '1',
            'modal'             => '1500',
            'total_modal'       => '75000',
            'fix_harga_deal'    => '1500',
            'keterangan'        => 'tes',
            'status'            => '1',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialStockHistory::create([
            'id_box'            => 'PS_PAK SALEH_NT789_140724_PTH A_4000',
            'doc_no'            => '2024071103',
            'berat_masuk'       => '50',
            'berat_keluar'      => '0',
            'sisa_berat'        => '50',
            'avg_kadar_air'     => '1',
            'modal'             => '1500',
            'total_modal'       => '75000',
            'fix_harga_deal'    => '1500',
            'keterangan'        => 'tes',
            'status'            => '1',
            'user_created'      => 'Admin123',
        ]);
    }
}
