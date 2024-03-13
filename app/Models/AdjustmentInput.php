<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentInput extends Model
{
    use HasFactory;
    protected $table = 'adjustment_inputs';
    protected $fillable = [
        'nomor_adjustment',
        'nomor_batch',
        'berat_adding',
        'pcs_adding',
        'jenis_adjustment',
        'berat_adjustment',
        'pcs_adjustment',
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
        'nilai_dikurangi_keuntungan',
        'prosentase_harga_gramasi',
        'selisih_laba_rugi_kg',
        'selisih_laba_rugi_per_gram',
        'hpp',
        'total_hpp',
        'fix_total_hpp',
        'user_created',
        'user_updated',
    ];
    public function AdjustmentStock()
    {
        return $this->hasMany(AdjustmentStock::class, 'nomor_adjustment', 'nomor_adjustment');
    }
    public function MasterJenisGradingHalus()
    {
        return $this->belongsTo(MasterJenisGradingHalus::class, 'jenis', 'jenis_adjustment');
    }
}
