<?php

namespace Database\Seeders;

use App\Models\PrmRawMaterialStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrmRawMaterialStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrmRawMaterialStock::create([
            'id_box'                => 'AB_ABEL_NT123_120724_PTH A_3000',
            'nomor_nota_internal'   => 'AB_ABEL_NT123_120724',
            'nomor_batch'           => 'P202311.006.1012',
            'nama_supplier'         => 'Abel',
            'jenis'                 => 'PTH A',
            'berat_masuk'           => '100',
            'berat_keluar'          => '0',
            'sisa_berat'            => '100',
            'avg_kadar_air'         => '1',
            'modal'                 => '1500',
            'total_modal'           => '75000',
            'keterangan'            => 'tes',
            'user_created'          => 'Admin123',
        ]);
        PrmRawMaterialStock::create([
            'id_box'                => 'DH_DHOFIN_NT456_120724_PTH B_4000',
            'nomor_nota_internal'   => 'DH_DHOFIN_NT456_120724',
            'nomor_batch'           => 'P202311.006.1012',
            'nama_supplier'         => 'Dhofin',
            'jenis'                 => 'PTH B',
            'berat_masuk'           => '100',
            'berat_keluar'          => '0',
            'sisa_berat'            => '100',
            'avg_kadar_air'         => '1',
            'modal'                 => '1500',
            'total_modal'           => '75000',
            'keterangan'            => 'tes',
            'user_created'          => 'Admin123',
        ]);
        PrmRawMaterialStock::create([
            'id_box'                => 'PS_PAK SALEH_NT789_120724_PTH BULU_5000',
            'nomor_nota_internal'   => 'PS_PAK SALEH_NT789_120724',
            'nomor_batch'           => 'P202311.006.1012',
            'nama_supplier'         => 'Pak Saleh',
            'jenis'                 => 'PTH BULU',
            'berat_masuk'           => '100',
            'berat_keluar'          => '0',
            'sisa_berat'            => '100',
            'avg_kadar_air'         => '1',
            'modal'                 => '1500',
            'total_modal'           => '75000',
            'keterangan'            => 'tes',
            'user_created'          => 'Admin123',
        ]);
    }
}
