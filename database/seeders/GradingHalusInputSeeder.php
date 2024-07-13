<?php

namespace Database\Seeders;

use App\Models\GradingHalusInput;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingHalusInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        GradingHalusInput::create([
            'nomor_grading' => 'ugk_010324-093513',
            'id_box_raw_material' => 'ugk_010324-093513_GK',
            'nomor_batch' => '093513',
            'nomor_nota_internal' => '010324-093513',
            'nama_supplier' => 'Koko Lim',
            'status' => '1',
            'jenis_raw_material' => 'K001',
            'kadar_air' => '15',
            'berat_adding' => '10',
            'pcs_adding' => '5',
            'jenis_grading' => '10',
            'berat_grading' => '10',
            'pcs_grading' => '5',
            'keterangan' => 'AB_010324-093513',
            'modal' => '5000',
            'total_modal' => '55000',
            'id_box_grading_halus' => 'OB_010324-093525',
            'kategori_susut' => 'A',
            'susut_depan' => 1,
            'susut_belakang' => 1,
            'biaya_produksi' => 1,
            'kontribusi' => 1,
            'harga_estimasi' => 1,
            'total_harga' => 1,
            'nilai_laba_rugi' => 1,
            'nilai_prosentase_total_keuntungan' => 1,
            'prosentase_harga_gramasi' => 1,
            'selisih_laba_rugi_kg' => 1,
            'selisih_laba_rugi_per_gram' => 1,
            'hpp' => 1,
            'total_hpp' => 1,
            'fix_hpp' => 1,
            'fix_total_hpp' => 1,
            'user_created' => 1,
        ]);
        GradingHalusInput::create([
            'nomor_grading' => 'ugk_010324-093513',
            'id_box_raw_material' => 'ugk_010324-093513_GK',
            'nomor_batch' => '093513',
            'nomor_nota_internal' => '010324-093513',
            'nama_supplier' => 'Koko Lim',
            'status' => '1',
            'jenis_raw_material' => 'K001',
            'kadar_air' => '15',
            'berat_adding' => '10',
            'pcs_adding' => '5',
            'jenis_grading' => '10',
            'berat_grading' => '10',
            'pcs_grading' => '5',
            'keterangan' => 'AB_010324-093513',
            'modal' => '5000',
            'total_modal' => '55000',
            'id_box_grading_halus' => 'OB_010324-093525',
            'kategori_susut' => 'A',
            'susut_depan' => 1,
            'susut_belakang' => 1,
            'biaya_produksi' => 1,
            'kontribusi' => 1,
            'harga_estimasi' => 1,
            'total_harga' => 1,
            'nilai_laba_rugi' => 1,
            'nilai_prosentase_total_keuntungan' => 1,
            'prosentase_harga_gramasi' => 1,
            'selisih_laba_rugi_kg' => 1,
            'selisih_laba_rugi_per_gram' => 1,
            'hpp' => 1,
            'total_hpp' => 1,
            'fix_hpp' => 1,
            'fix_total_hpp' => 1,
            'user_created' => 1,
        ]);
        GradingHalusInput::create([
            'nomor_grading' => 'ugk_010324-093513',
            'id_box_raw_material' => 'ugk_010324-093513_GK',
            'nomor_batch' => '093513',
            'nomor_nota_internal' => '010324-093513',
            'nama_supplier' => 'Koko Lim',
            'status' => '1',
            'jenis_raw_material' => 'K001',
            'kadar_air' => '15',
            'berat_adding' => '10',
            'pcs_adding' => '5',
            'jenis_grading' => '10',
            'berat_grading' => '10',
            'pcs_grading' => '5',
            'keterangan' => 'AB_010324-093513',
            'modal' => '5000',
            'total_modal' => '55000',
            'id_box_grading_halus' => 'OB_010324-093525',
            'kategori_susut' => 'A',
            'susut_depan' => 1,
            'susut_belakang' => 1,
            'biaya_produksi' => 1,
            'kontribusi' => 1,
            'harga_estimasi' => 1,
            'total_harga' => 1,
            'nilai_laba_rugi' => 1,
            'nilai_prosentase_total_keuntungan' => 1,
            'prosentase_harga_gramasi' => 1,
            'selisih_laba_rugi_kg' => 1,
            'selisih_laba_rugi_per_gram' => 1,
            'hpp' => 1,
            'total_hpp' => 1,
            'fix_hpp' => 1,
            'fix_total_hpp' => 1,
            'user_created' => 1,
        ]);
    }
}
