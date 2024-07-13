<?php

namespace Database\Seeders;

use App\Models\PreGradingHalusInput;
use App\Models\PreWashOutput;
use App\Models\TransitGradingHalus;
use App\Models\TransitPreCleaningStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreWashOutputSeeder extends Seeder
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
        PreWashOutput::create([
            'nomor_job' => '010324-093511',
            'nomor_batch' => '093513',
            'status' => '1',
            'nomor_bstb' => 'ugk_010324-093511',
            'jenis_job' => 'K001',
            'operator_perendaman' => 'Kim',
            'operator_bilas' => 'koko',
            'operator_box' => 'lim',
            'berat_job' => '50',
            'berat_bersih' => '25',
            'pcs_bersih' => '10',
            'pcs_job' => '5',
            'upah_operator_bersih' => '250000',
            'upah_operator' => '5500000',
            'tujuan_kirim' => 'Jombang',
            'keterangan' => 'Test 1',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => 'Asc-275',
        ]);
        // \App\Models\TransitPreCleaningStock::factory(5)->create();
    }
}
