<?php

namespace Database\Seeders;

use App\Models\TransitDryACabut;
use Illuminate\Database\Seeder;

class TransitDryACabutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        TransitDryACabut::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093001',
            'nomor_bstb' => '1111111',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Jombang',
            'keterangan' => 'Test1',
            'berat_kotor' => '50',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '50',
            'pcs_1_grading' => '50',
            'berat_2_grading' => '50',
            'modal' => '5000',
            'total_modal' => '250000',
        ]);
        TransitDryACabut::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093002',
            'nomor_bstb' => '1111111',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test2',
            'berat_kotor' => '100',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '50',
            'pcs_1_grading' => '50',
            'berat_2_grading' => '50',
            'modal' => '5000',
            'total_modal' => '500000',
        ]);
        TransitDryACabut::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093003',
            'nomor_bstb' => '222222',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Madiun',
            'keterangan' => 'Test3',
            'berat_kotor' => '150',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '50',
            'pcs_1_grading' => '50',
            'berat_2_grading' => '50',
            'modal' => '5000',
            'total_modal' => '750000',
        ]);
        TransitDryACabut::create([
            'unit' => 'Dry A',
            'nomor_job' => 'ugk_010324-093004',
            'nomor_bstb' => '222222',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Gresik',
            'keterangan' => 'Test4',
            'berat_kotor' => '200',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '50',
            'pcs_1_grading' => '50',
            'berat_2_grading' => '50',
            'modal' => '5000',
            'total_modal' => '1000000',
        ]);
    }
}
