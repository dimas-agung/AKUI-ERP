<?php

namespace Database\Seeders;

use App\Models\PrmRawMaterialInputItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrmRawMaterialInputItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PrmRawMaterialInputItem::create([
            'doc_no'            => '2024071101',
            'jenis'             => 'PTH A',
            'berat_nota'        => '25',
            'berat_kotor'       => '12',
            'berat_bersih'      => '50',
            'selisih_berat'     => '25',
            'kadar_air'         => '1',
            'harga_nota'        => '3000',
            'id_box'            => 'AB_ABEL_NT123_120724_PTH A_3000',
            'fix_harga_deal'    => '1500',
            'total_harga_nota'  => '75000',
            'harga_deal'        => '1500',
            'keterangan'        => 'tes',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialInputItem::create([
            'doc_no'            => '2024071101',
            'jenis'             => 'PTH A',
            'berat_nota'        => '25',
            'berat_kotor'       => '12',
            'berat_bersih'      => '50',
            'selisih_berat'     => '25',
            'kadar_air'         => '1',
            'harga_nota'        => '3000',
            'id_box'            => 'AB_ABEL_NT123_120724_PTH A_3000',
            'fix_harga_deal'    => '1500',
            'total_harga_nota'  => '75000',
            'harga_deal'        => '1500',
            'keterangan'        => 'tes',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialInputItem::create([
            'doc_no'            => '2024071102',
            'jenis'             => 'PTH B',
            'berat_nota'        => '25',
            'berat_kotor'       => '12',
            'berat_bersih'      => '50',
            'selisih_berat'     => '25',
            'kadar_air'         => '1',
            'harga_nota'        => '4000',
            'id_box'            => 'DH_DHOFIN_NT456_130724_PTH B_4000',
            'fix_harga_deal'    => '1500',
            'total_harga_nota'  => '75000',
            'harga_deal'        => '1500',
            'keterangan'        => 'tes',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialInputItem::create([
            'doc_no'            => '2024071102',
            'jenis'             => 'PTH B',
            'berat_nota'        => '25',
            'berat_kotor'       => '12',
            'berat_bersih'      => '50',
            'selisih_berat'     => '25',
            'kadar_air'         => '1',
            'harga_nota'        => '4000',
            'id_box'            => 'DH_DHOFIN_NT456_130724_PTH B_4000',
            'fix_harga_deal'    => '1500',
            'total_harga_nota'  => '75000',
            'harga_deal'        => '1500',
            'keterangan'        => 'tes',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialInputItem::create([
            'doc_no'            => '2024071103',
            'jenis'             => 'PTH BULU',
            'berat_nota'        => '25',
            'berat_kotor'       => '12',
            'berat_bersih'      => '50',
            'selisih_berat'     => '25',
            'kadar_air'         => '1',
            'harga_nota'        => '5000',
            'id_box'            => 'PS_PAK SALEH_NT789_140724_PTH BULU_5000',
            'fix_harga_deal'    => '1500',
            'total_harga_nota'  => '75000',
            'harga_deal'        => '1500',
            'keterangan'        => 'tes',
            'user_created'      => 'Admin123',
        ]);
        PrmRawMaterialInputItem::create([
            'doc_no'            => '2024071103',
            'jenis'             => 'PTH BULU',
            'berat_nota'        => '25',
            'berat_kotor'       => '12',
            'berat_bersih'      => '50',
            'selisih_berat'     => '25',
            'kadar_air'         => '1',
            'harga_nota'        => '5000',
            'id_box'            => 'PS_PAK SALEH_NT789_140724_PTH BULU_5000',
            'fix_harga_deal'    => '1500',
            'total_harga_nota'  => '75000',
            'harga_deal'        => '1500',
            'keterangan'        => 'tes',
            'user_created'      => 'Admin123',
        ]);
    }
}
