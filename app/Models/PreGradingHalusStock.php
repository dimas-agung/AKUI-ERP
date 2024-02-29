<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreGradingHalusStock extends Model
{
    use HasFactory;
    protected $table = 'pre_grading_halus_stocks';
    protected $fillable = [
        'unit',
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'id_box_raw_material',
        'nomor_batch',
        'nomor_nota_internal',
        'nama_supplier',
        'jenis_raw_material',
        'kadar_air',
        'jenis_kirim',
        'berat_masuk',
        'pcs_masuk',
        'berat_keluar',
        'pcs_keluar',
        'sisa_berat',
        'sisa_pcs',
        'tujuan_kirim',
        'modal',
        'total_modal',
    ];
    public function PreGradingHalusAdding()
    {
        return $this->hasMany(PreGradingHalusAdding::class, 'nomor_job', 'nomor_job');
    }
    public function PreGradingHalusAdding()
    {
        return $this->hasMany(PreGradingHalusAdding::class, 'nomor_job', 'nomor_job');
    }
}
