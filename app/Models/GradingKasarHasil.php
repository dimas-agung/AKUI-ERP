<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingKasarHasil extends Model
{
    use HasFactory;
    protected $table = 'grading_kasar_hasils';
    protected $fillable = [
        'doc_no',
        'nomor_grading',
        'id_box_grading_kasar',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'kadar_air',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'susut',
        'modal',
        'total_modal',
        'biaya_produksi',
        'harga_estimasi',
        'total_harga',
        'nilai_laba_rugi',
        'nilai_prosentase_total_keuntungan',
        'nilai_dikurangi_keuntungan',
        'prosentase_harga_gramasi',
        'selisih_laba_rugi_kg',
        'selisih_laba_rugi_gram',
        'hpp',
        'total_hpp',
        'keterangan',
        'user_created',
        'user_updated',
    ];
    public function MasterJenisGradingKasar()
    {
        return $this->hasMany(MasterJenisGradingKasar::class, 'jenis', 'nama');
    }
    // public function GradingKasarInput()
    // {
    //     return $this->hasMany(GradingKasarInput::class, 'nomor_grading', 'nomor_grading');
    // }
}
