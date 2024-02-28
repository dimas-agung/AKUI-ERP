<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingHalusInput extends Model
{
    use HasFactory;
    protected $table = 'grading_halus_inputs';
    protected $fillable = [
        'nomor_grading',
        'id_box_raw_material',
        'nomor_batch',
        'nomor_nota_internal',
        'nama_supplier',
        'status',
        'jenis_raw_material',
        'kadar_air',
        'berat_adding',
        'pcs_adding',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'keterangan',
        'modal',
        'total_modal',
        'kategori_susut',
        'id_box_grading_halus',
        'susut_depan',
        'susut_belakang',
        'biaya_produksi',
        'kontribusi',
        'harga_estimasi',
        'total_harga',
        'nilai_laba_rugi',
        'nilai_prosentase_total_keuntungan',
        'prosentase_harga_gramasi',
        'selisih_laba_rugi_kg',
        'selisih_laba_rugi_per_gram',
        'hpp',
        'total_hpp',
        'fix_hpp',
        'fix_total_hpp',
        'user_created',
        'user_updated',
    ];

    public function PreGradingHalusAddingStock()
    {
        return $this->belongsTo(PreGradingHalusAddingStock::class, 'nomor_grading', 'nomor_grading');
    }
    public function MasterJenisGradingHalus()
    {
        return $this->belongsTo(MasterJenisGradingHalus::class, 'jenis', 'jenis_grading');
    }
    // public function GradingHalusStock()
    // {
    //     return $this->hasMany(GradingHalusStock::class, 'id_box_grading_halus', 'id_box_grading_halus');
    // }
}
