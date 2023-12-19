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
            'id_box'            => 'SP_9090_261123_PTH Putih B_8600',
            'nomor_batch'       => 'Batch001',
            'nama_supplier'     => 'Selat Panjang',
            'jenis'             => 'PTH Putih B',
            'berat_masuk'       => '46874',
            'berat_keluar'      => '16000',
            'sisa_berat'        => '30874',
            'avg_kadar_air'     => '26',
            'modal'             => '8620',
            'total_modal'       => '2662',
            'keterangan'        => 'tes',
            'user_created'      => 'SPA',
            'user_updated'      => 'SPB',
        ]);
        PrmRawMaterialStock::create([
            'id_box'            => 'DH_9090go_041223_PTH Krem_9000',
            'nomor_batch'       => 'Batch9090',
            'nama_supplier'     => 'Dhofin',
            'jenis'             => 'PTH Krem',
            'berat_masuk'       => '12000',
            'berat_keluar'      => '0',
            'sisa_berat'        => '12000',
            'avg_kadar_air'     => '26',
            'modal'             => '750',
            'total_modal'       => '90000',
            'keterangan'        => 'tes',
            'user_created'      => 'SPC',
            'user_updated'      => 'SPD',
        ]);
        PrmRawMaterialStock::create([
            'id_box'            => 'AB_9801_271123_PTH Krem_9500',
            'nomor_batch'       => 'Batch090',
            'nama_supplier'     => 'Abel',
            'jenis'             => 'PTH Krem',
            'berat_masuk'       => '38999',
            'berat_keluar'      => '33000',
            'sisa_berat'        => '5999',
            'avg_kadar_air'     => '23',
            'modal'             => '9500',
            'total_modal'       => '5699',
            'keterangan'        => 'tes',
            'user_created'      => 'SPE',
            'user_updated'      => 'SPF'
        ]);

    }
}
