<?php

namespace Database\Seeders;

use App\Models\GradingKasarInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingKasarInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GradingKasarInput::create([
            'doc_no'                => 1,
            'nomor_bstb'            => 'BSTB001',
            'id_box'                => 'DH_DHOFIN/102570-231123_PTH BULU_7400',
            'nomor_batch'           => 'P202311.006.1012',
            'nama_supplier'         => 'Dhofin',
            'jenis_raw_material'    => 'PTH BULU Flek 12',
            'nomor_nota_internal'   => 'DH_DHOFIN/102570-231123',
            'berat'                 => 100,
            'kadar_air'             => 10,
            'nomor_grading'         => 'NG_100124-102025_ A_UGK',
            'modal'                 => 3400,
            'total_modal'           => 7400,
            'keterangan'            => 'Test',
            'user_created'          => 'Admin123',
            'user_updated'          => 'Admin123',
        ]);
        GradingKasarInput::create([
            'doc_no'                => 1,
            'nomor_bstb'            => 'BSTB002',
            'id_box'                => 'AB_ABEL/280680-251123_CHONG_8325',
            'nomor_batch'           => 'P202311.006.1012',
            'nama_supplier'         => 'Abel',
            'jenis_raw_material'    => 'Chong',
            'nomor_nota_internal'   => 'AB_ABEL/280680-251123',
            'berat'                 => 350,
            'kadar_air'             => 14,
            'nomor_grading'         => 'NG_100124-102025_ O_UGK',
            'modal'                 => 1400,
            'total_modal'           => 5000,
            'keterangan'            => 'Test',
            'user_created'          => 'Admin123',
            'user_updated'          => 'Admin123',
        ]);
    }
}
