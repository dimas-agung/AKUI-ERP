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
        // \App\Models\PrmRawMaterialStock::factory(5)->create();
        PrmRawMaterialStock::create([
            'id_box' => '243',
            'nomor_batch' => '188629321',
            'nama_supplier' => 'Tukijo',
            'jenis' => 'Celestial Angel Wings',
            'nomor_nota_internal' => '1978367681789',
            'berat_masuk' => '55',
            'berat_keluar' => '0',
            'sisa_berat' => '55',
            'avg_kadar_air' => '5',
            'modal' => '25000',
            'total_modal' => '50000',
            'keterangan' => 'test1',
            'user_created' => 'Asc-281',
        ]);
        PrmRawMaterialStock::create([
            'id_box' => '242',
            'nomor_batch' => '188629322',
            'nama_supplier' => 'Painem',
            'jenis' => 'Celestial Crown Special',
            'nomor_nota_internal' => '1978367681789',
            'berat_masuk' => '75',
            'berat_keluar' => '0',
            'sisa_berat' => '75',
            'avg_kadar_air' => '3',
            'modal' => '25000',
            'total_modal' => '50000',
            'keterangan' => 'test2',
            'user_created' => 'Asc-281',
        ]);
        PrmRawMaterialStock::create([
            'id_box' => '241',
            'nomor_batch' => '188629323',
            'nama_supplier' => 'Slamet',
            'jenis' => 'Crystal Snow',
            'nomor_nota_internal' => '1978367681789',
            'berat_masuk' => '105',
            'berat_keluar' => '0',
            'sisa_berat' => '105',
            'avg_kadar_air' => '5',
            'modal' => '55000',
            'total_modal' => '550000',
            'keterangan' => 'test3',
            'user_created' => 'Asc-281',
        ]);

    }
}
