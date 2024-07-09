<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingWarna extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'grading_warnas';
    protected $fillable = [
        'nomor_lot',
        'nomor_batch',
        'tujuan_kirim',
        'berat_lot',
        'pcs_lot',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'keterangan',
        'modal',
        'total_modal',
        'kategori_susut',
        'id_box_grading_warna',
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
        'fix_hpp',
        'fix_total_hpp',
        'status',
        'user_created',
        'user_updated',
    ];
    public function can_delete()
    {
        if ($this->status == self::STATUS_AKTIF) {
            return true;
        }
        return false;
    }
    public function GradingWarnaAddingStock()
    {
        return $this->hasMany(GradingWarnaAddingStock::class, 'nomor_lot', 'nomor_lot');
    }
}
