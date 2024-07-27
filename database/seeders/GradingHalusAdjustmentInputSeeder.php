<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradingHalusAdjustmentInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradingHalusAdjustmentInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GradingHalusAdjustmentInput::create([
            'nomor_adjustment' => 'ADJ_130724_092246_A_UGH',
            'nomor_batch'  => 'P202311.006.1012',
            'berat_adding' => 111,
            'pcs_adding' => 7,
            'jenis_adjustment' => 'HCR',
            'berat_adjustment' => 200,
            'pcs_adjustment' => 15,
            'keterangan' => 'tes',
            'modal' => 5457,
            'total_modal' => 605727,
            'kategori_susut' => 'SB',
            'id_box_grading_halus' => 'P202311.006.1012_HCR',
            'susut_depan' => 1,
            'susut_belakang' => 0.80,
            'biaya_produksi' => 0,
            'kontribusi' => 100,
            'harga_estimasi' => 5457,
            'total_harga' => 1091400,
            'nilai_laba_rugi' => 2.80,
            'nilai_prosentase_total_keuntungan' => 3057886,
            'nilai_dikurangi_keuntungan' => 4149286,
            'prosentase_harga_gramasi' => 1,
            'selisih_laba_rugi_kg' => 1697127,
            'selisih_laba_rugi_per_gram' => 848564,
            'hpp' => 3028,
            'total_hpp' => 605727,
            'fix_hpp' => 3038,
            'fix_total_hpp' => 605728,
            'user_created' => 'Admin123',
        ]);
    }
}
