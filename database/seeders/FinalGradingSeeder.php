<?php

namespace Database\Seeders;

use App\Models\FinalGrading;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinalGradingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\PreGradingHalusAddingStock::factory(5)->create();
        FinalGrading::create([
            'nomor_job' => 'ufg_310724-093533',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Malang',
            'job_order' => 'SD',
            'berat_job' => 150,
            'pcs_job' => 15,
            'upah_operator' => 1000,
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'jenis_grading' => 'SD',
            'berat_grading' => '150',
            'pcs_grading' => '15',
            'rework' => '1',
            'nomor_job_rework' => '300500',
            'kategori_susut' => 'SD',
            'susut_depan' => 15,
            'susut_belakang' => 10,
            'modal' => '5000',
            'total_modal' => '250000',
            'biaya_produksi' => 1000,
            'kontribusi' => 65,
            'harga_estimasi' => 1250000,
            'total_harga' => 10000,
            'nilai_laba_rugi' => 100,
            'nilai_prosentase_total_keuntungan' => 45,
            'nilai_dikurangi_keuntungan' => 15,
            'prosentase_harga_gramasi' => 1,
            'selisih_laba_rugi_kg' => 1,
            'selisih_laba_rugi_per_gram' => 1,
            'hpp' => 1,
            'total_hpp' => 1,
            'fix_hpp' => 1,
            'fix_total_hpp' => 1,
            'status' => 1,
            'user_created' => 1,
        ]);
        FinalGrading::create([
            'nomor_job' => 'ufg_310724-103533',
            'nomor_batch' => '093513',
            'tujuan_kirim' => 'Jombang',
            'job_order' => 'MII',
            'berat_job' => 50,
            'pcs_job' => 5,
            'upah_operator' => 1000,
            'nama_operator' => 'Son Haji',
            'nip_operator' => '20002050693',
            'grade_operator' => 'Ahli',
            'nama_team_leader' => 'Tukinem',
            'jenis_grading' => 'SD',
            'berat_grading' => '150',
            'pcs_grading' => '15',
            'rework' => '1',
            'nomor_job_rework' => '300500',
            'kategori_susut' => 'SD',
            'susut_depan' => 15,
            'susut_belakang' => 10,
            'modal' => '5000',
            'total_modal' => '250000',
            'biaya_produksi' => 1000,
            'kontribusi' => 65,
            'harga_estimasi' => 1250000,
            'total_harga' => 10000,
            'nilai_laba_rugi' => 100,
            'nilai_prosentase_total_keuntungan' => 45,
            'nilai_dikurangi_keuntungan' => 15,
            'prosentase_harga_gramasi' => 1,
            'selisih_laba_rugi_kg' => 1,
            'selisih_laba_rugi_per_gram' => 1,
            'hpp' => 1,
            'total_hpp' => 1,
            'fix_hpp' => 1,
            'fix_total_hpp' => 1,
            'status' => 1,
            'user_created' => 1,
        ]);
    }
}
