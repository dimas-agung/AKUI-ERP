<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UgkGradingKasarStok extends Model
{
    use HasFactory;
    protected $table = 'ugk_grading_kasar_stok';
    protected $fillable = [
        'unit',
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat_masuk',
        'berat_keluar',
        'pcs_masuk',
        'pcs_keluar',
        'sisa_berat',
        'sisa_pcs',
        'avg_kadar_air',
        'modal',
        'total_modal',
    ];


    public function UgkHasil()
    {
    	return $this->belongsTo(UgkHasil::class);
    }
}
