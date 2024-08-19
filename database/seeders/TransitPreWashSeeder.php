<?php

namespace Database\Seeders;

use App\Models\TransitPreWash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitPreWashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data=[];
        // for($i=0;$i<=500;$i++){
        //     $data= [
        //         'unit' => 'Transit Grading Halus',
        //         'nomor_job' => '010324-093511',
        //         'nomor_batch' => '093513',
        //         'status' => '1',
        //         'jenis_job' => 'K001',
        //         'berat_job' => '10',
        //         'pcs_job' => '5',
        //         'upah_operator' => '5500000',
        //         'tujuan_kirim' => 'jombang',
        //         'keterangan' => 'Koko Lim',
        //         'nomor_bstb' => 'ugk_010324-093511',
        //         'modal' => '5000',
        //         'total_modal' => '55000',
        //         'user_created' => 'Asc-275',
        //     ];
        //     TransitGradingHalus::create($data);
        // }
        TransitPreWash::create([
            'unit' => 'Pre Wash',
            'nomor_job' => '010324-093511',
            'nomor_batch' => '093513',
            'status' => '1',
            'nomor_bstb' => 'ugk_010324-093511',
            'jenis_job' => 'K001',
            'berat_job' => '50',
            'pcs_job' => '5',
            'upah_operator_bersih' => '250000',
            'tujuan_kirim' => 'Jombang',
            'keterangan' => 'Test 1',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => 'Asc-275',
        ]);
        TransitPreWash::create([
            'unit' => 'Pre Wash',
            'nomor_job' => '010324-093522',
            'nomor_batch' => '093512',
            'status' => '1',
            'nomor_bstb' => 'ugk_010324-093522',
            'jenis_job' => 'K002',
            'berat_job' => '100',
            'pcs_job' => '10',
            'upah_operator_bersih' => '250000',
            'tujuan_kirim' => 'Jombang',
            'keterangan' => 'Test 2',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => 'Asc-275',
        ]);
        TransitPreWash::create([
            'unit' => 'Pre Wash',
            'nomor_job' => '010324-093533',
            'nomor_batch' => '093511',
            'status' => '1',
            'nomor_bstb' => 'ugk_010324-093533',
            'jenis_job' => 'K003',
            'berat_job' => '150',
            'pcs_job' => '15',
            'upah_operator_bersih' => '250000',
            'tujuan_kirim' => 'Jombang',
            'keterangan' => 'Test 3',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => 'Asc-275',
        ]);
        // \App\Models\TransitPreCleaningStock::factory(5)->create();
    }
}
