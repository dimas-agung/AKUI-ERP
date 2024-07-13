<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradingKasarHasil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradingKasarHasilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GradingKasarHasil::create([
            'doc_no'                                => '1',
            'nomor_grading'                         => 'NG_120724-102025_A_UGK',
            'id_box_raw_material'                   => 'AB_ABEL_120724-102025_PTH A_8325',
            'id_box_grading_kasar'                  => 'NG_120724-102025_A_UGK_HCR',
            'nomor_batch'                           => 'P202311.006.1012',
            'nama_supplier'                         => 'Abel',
            'status'                                => '1',
            'nomor_nota_internal'                   => 'AB_ABEL_120724-102025',
            'jenis_raw_material'                    => 'PTH BULU Flek 12',
            'berat'                                 => '5',
            'kadar_air'                             => '1',
            'jenis_grading'                         => 'HCR',
            'berat_grading'                         => '5',
            'pcs_grading'                           => '5',
            'susut'                                 => '5',
            'modal'                                 => '5',
            'total_modal'                           => '5',
            'biaya_produksi'                        => '5',
            'harga_estimasi'                        => '5',
            'total_harga'                           => '5',
            'nilai_laba_rugi'                       => '5',
            'nilai_prosentase_total_keuntungan'     => '5',
            'nilai_dikurangi_keuntungan'            => '5',
            'prosentase_harga_gramasi'              => '5',
            'selisih_laba_rugi_kg'                  => '5',
            'selisih_laba_rugi_gram'                => '5',
            'hpp'                                   => '5',
            'total_hpp'                             => '5',
            'keterangan'                            => 'tes',
            'user_created'                          => 'Admin123',
        ]);
        GradingKasarHasil::create([
            'doc_no'                                => '1',
            'nomor_grading'                         => 'NG_100124-102025_A_UGK',
            'id_box_raw_material'                   => 'AB_ABEL_100124-102025_PTH A_8325',
            'id_box_grading_kasar'                  => 'NG_100124-102025_A_UGK_CHONG',
            'nomor_batch'                           => 'P202311.006.1012',
            'nama_supplier'                         => 'Abel',
            'status'                                => '1',
            'nomor_nota_internal'                   => 'AB_ABEL_100124-102025',
            'jenis_raw_material'                    => 'PTH BULU Flek 12',
            'berat'                                 => '13',
            'kadar_air'                             => '1',
            'jenis_grading'                         => 'Chong',
            'berat_grading'                         => '13',
            'pcs_grading'                           => '13',
            'susut'                                 => '13',
            'modal'                                 => '13',
            'total_modal'                           => '13',
            'biaya_produksi'                        => '13',
            'harga_estimasi'                        => '13',
            'total_harga'                           => '13',
            'nilai_laba_rugi'                       => '13',
            'nilai_prosentase_total_keuntungan'     => '13',
            'nilai_dikurangi_keuntungan'            => '13',
            'prosentase_harga_gramasi'              => '13',
            'selisih_laba_rugi_kg'                  => '13',
            'selisih_laba_rugi_gram'                => '13',
            'hpp'                                   => '13',
            'total_hpp'                             => '13',
            'keterangan'                            => 'tes',
            'user_created'                          => 'Admin123',
        ]);
    }
}
