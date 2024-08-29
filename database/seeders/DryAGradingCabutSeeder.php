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
            'nomor_job' => 'ugk_010324-093533',
            'nomor_batch' => '093513',
            'jenis_grading' => 'SD',
            'berat_1_grading' => '50',
            'pcs_1_grading' => '10',
            'berat_2_grading' => '0',
            'tujuan_kirim' => 'Malang',
            'modal' => '5000',
            'total_modal' => '55000',
            'status' => 1,
            'jenis_job' => 1,
            'berat_job' => 1,
            'pcs_job' => 1,
            'nama_operator' => 1,
            'nip_operator' => 1,
            'grade_operator' => 1,
            'nama_team_leader' => 1,
            'upah_operator' => 1,
            'kategori_susut' => 1,
            'susut_depan' => 1,
            'susut_belakang' => 1,
            'biaya_produksi' => 1,
            'kontribusi' => 1,
            'harga_estimasi' => 1,
            'total_harga' => 1,
            'nilai_laba_rugi' => 1,
            'nilai_prosentase_total_keuntungan' => 1,
            'nilai_dikurangi_keuntungan' => 1,
            'prosentase_harga_gramasi' => 1,
            'selisih_laba_rugi_kg' => 1,
            'selisih_laba_rugi_per_gram' => 1,
            'hpp' => 1,
            'berat_kotor' => 1,
            'total_hpp' => 1,
            'user_created' => 1,
            'user_updated' => 1,
        ]);
    }
}