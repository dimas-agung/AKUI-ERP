<?php

namespace Database\Seeders;

use App\Models\PreWashStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreWashStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreWashStock::factory(5)->create();
        PreWashStock::create([
            'unit' => 'Pre-Wash',
            'nomor_job' => 'ugk_010324-093513',
            'nomor_batch' => '093513',
            'jenis_job' => 'K001',
            'berat_job' => '10',
            'pcs_job' => '5',
            'tujuan_kirim' => 'Indonesia',
            'keterangan' => 'Test 1',
            'modal' => '5000',
            'total_modal' => '55000',
            'status' => 1,
        ]);
        PreWashStock::create([
            'unit' => 'Pre-Wash',
            'nomor_job' => 'ugk_010324-093525',
            'nomor_batch' => '093525',
            'jenis_job' => 'K002',
            'berat_job' => '20',
            'pcs_job' => '4',
            'tujuan_kirim' => 'Indonesia',
            'keterangan' => 'Test 2',
            'modal' => '6000',
            'total_modal' => '65000',
            'status' => 1,
        ]);
        PreWashStock::create([
            'unit' => 'Pre-Wash',
            'nomor_job' => 'ugk_010324-093555',
            'nomor_batch' => '093555',
            'jenis_job' => 'K003',
            'berat_job' => '30',
            'pcs_job' => '6',
            'tujuan_kirim' => 'Indonesia',
            'keterangan' => 'Test 3',
            'modal' => '9000',
            'total_modal' => '95000',
            'status' => 1,
        ]);
    }
}
