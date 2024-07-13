<?php

namespace Database\Seeders;

use App\Models\DryAGradingCabut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DryAGradingCabutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DryAGradingCabut::create([
            'nomor_job' => '',
            'nomor_batch' => '',
            'jenis_job' => '',
            'berat_job' => '',
            'pcs_job' => '',
            'tujuan_kirim' => '',
            'nama_operator' => '',
            'nip_operator' => '',
            'grade_operator' => '',
            'nama_team_leader' => '',
            'modal' => '',
            'total_modal' => '',
            'upah_operator' => '',
            'jenis_grading' => '',
            'berat_1_grading' => '',
            'pcs_1_grading' => '',
            'berat_2_grading' => '',
            'kategori_susut' => '',
            'susut_depan' => '',
            'susut_belakang' => '',
            'biaya_produksi' => '',
            'kontribusi' => '',
            'harga_estimasi' => '',
            'total_harga' => '',
            'nilai_laba_rugi' => '',
            'nilai_prosentase_total_keuntungan' => '',
            'nilai_dikurangi_keuntungan' => '',
            'prosentase_harga_gramasi' => '',
            'selisih_laba_rugi_kg' => '',
            'selisih_laba_rugi_per_gram' => '',
            'hpp' => '',
            'total_hpp' => '',
            'status' => '',
            'user_created' => '',
            'user_updated' => '',
        ]);
    }
}
