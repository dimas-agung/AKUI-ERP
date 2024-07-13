<?php

namespace Database\Seeders;

use App\Models\GradingHalusOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingHalusOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        GradingHalusOutput::create([
            'id_box_grading_halus' => 'OB_010324-093525',
            'nomor_batch' => '093513',
            'jenis_job' => 'K001',
            'berat_job' => '50',
            'pcs_job' => '25',
            'upah_operator' => '15000',
            'tujuan_kirim' => 'Malang',
            'nomor_job' => '200821',
            'nomor_bstb' => 'OB_010324',
            'keterangan' => 'Test1',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => '2002050693',
        ]);
        GradingHalusOutput::create([
            'id_box_grading_halus' => 'OB_010324-093515',
            'nomor_batch' => '093512',
            'jenis_job' => 'K002',
            'berat_job' => '50',
            'pcs_job' => '25',
            'upah_operator' => '15000',
            'tujuan_kirim' => 'Jombang',
            'nomor_job' => '200825',
            'nomor_bstb' => 'OB_010324',
            'keterangan' => 'Test2',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => '2002050693',
        ]);
        GradingHalusOutput::create([
            'id_box_grading_halus' => 'OB_010324-093535',
            'nomor_batch' => '093511',
            'jenis_job' => 'K003',
            'berat_job' => '50',
            'pcs_job' => '25',
            'upah_operator' => '15000',
            'tujuan_kirim' => 'Surabaya',
            'nomor_job' => '200824',
            'nomor_bstb' => 'OB_010324',
            'keterangan' => 'Test3',
            'modal' => '5000',
            'total_modal' => '55000',
            'user_created' => '2002050693',
        ]);
    }
}
