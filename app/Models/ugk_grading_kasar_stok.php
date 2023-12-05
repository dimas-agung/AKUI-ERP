<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ugk_grading_kasar_stok extends Model
{
    use HasFactory;
    protected $table = 'ugk_grading_kasar_stok';
    protected $fillable = [
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
}
