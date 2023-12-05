<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ucl_stok extends Model
{
    use HasFactory;
    protected $table = 'ucl_stok';
    protected $fillable = [
        'unit',
        'nomor_batch',
        'jenis',
        'berat_masuk',
        'pcs_masuk',
        'berat_keluar',
        'pcs_keluar',
        'sisa_berat',
        'sisa_pcs',
        'avg_kadar_air',
        'modal',
        'total_modal',
    ];
}
