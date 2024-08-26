<?php

namespace Database\Seeders;

use App\Models\GradingWarnaStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingWarnaStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GradingWarnaStock::create([
            'unit'                  => 'Grading Warna',
            'id_box_grading_warna'  => '228792_0123456_A',
            'nomor_batch'           => '228721',
            'tujuan_kirim'          => 'Jombang',
            'jenis_grading'         => 'SD',
            'berat_masuk'           => '50',
            'pcs_masuk'             => '5',
            'berat_keluar'          => '0',
            'pcs_keluar'            => '0',
            'sisa_berat'            => '50',
            'sisa_pcs'              => '5',
            'modal'                 => '1000',
            'total_modal'           => '50000',
            'status'                => 1
        ]);
        GradingWarnaStock::create([
            'unit'                  => 'Grading Warna',
            'id_box_grading_warna'  => '228752_0123456_A',
            'nomor_batch'           => '228721',
            'tujuan_kirim'          => 'Jombang',
            'jenis_grading'         => 'SD',
            'berat_masuk'           => '50',
            'pcs_masuk'             => '5',
            'berat_keluar'          => '0',
            'pcs_keluar'            => '0',
            'sisa_berat'            => '50',
            'sisa_pcs'              => '5',
            'modal'                 => '1000',
            'total_modal'           => '50000',
            'status'                => 1
        ]);
        GradingWarnaStock::create([
            'unit'                  => 'Grading Warna',
            'id_box_grading_warna'  => '228722_0123956_A',
            'nomor_batch'           => '228721',
            'tujuan_kirim'          => 'Jombang',
            'jenis_grading'         => 'SD',
            'berat_masuk'           => '50',
            'pcs_masuk'             => '5',
            'berat_keluar'          => '0',
            'pcs_keluar'            => '0',
            'sisa_berat'            => '50',
            'sisa_pcs'              => '5',
            'modal'                 => '1000',
            'total_modal'           => '50000',
            'status'                => 1
        ]);
        GradingWarnaStock::create([
            'unit'                  => 'Grading Warna',
            'id_box_grading_warna'  => '228752_0128456-O',
            'nomor_batch'           => '228732',
            'tujuan_kirim'          => 'Malang',
            'jenis_grading'         => 'SMP',
            'berat_masuk'           => '100',
            'pcs_masuk'             => '10',
            'berat_keluar'          => '0',
            'pcs_keluar'            => '0',
            'sisa_berat'            => '100',
            'sisa_pcs'              => '10',
            'modal'                 => '1000',
            'total_modal'           => '100000',
            'status'                => 1
        ]);
        GradingWarnaStock::create([
            'unit'                  => 'Grading Warna',
            'id_box_grading_warna'  => '228722_0123456-O',
            'nomor_batch'           => '228732',
            'tujuan_kirim'          => 'Malang',
            'jenis_grading'         => 'SMP',
            'berat_masuk'           => '100',
            'pcs_masuk'             => '10',
            'berat_keluar'          => '0',
            'pcs_keluar'            => '0',
            'sisa_berat'            => '100',
            'sisa_pcs'              => '10',
            'modal'                 => '1000',
            'total_modal'           => '100000',
            'status'                => 1
        ]);
        GradingWarnaStock::create([
            'unit'                  => 'Grading Warna',
            'id_box_grading_warna'  => '228722_7123456-O',
            'nomor_batch'           => '228743',
            'tujuan_kirim'          => 'Surabaya',
            'jenis_grading'         => 'SMA',
            'berat_masuk'           => '150',
            'pcs_masuk'             => '15',
            'berat_keluar'          => '0',
            'pcs_keluar'            => '0',
            'sisa_berat'            => '150',
            'sisa_pcs'              => '15',
            'modal'                 => '1000',
            'total_modal'           => '150000',
            'status'                => 1
        ]);
    }
}
