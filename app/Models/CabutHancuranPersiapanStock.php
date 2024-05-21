<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutHancuranPersiapanStock extends Model
{
    use HasFactory;
    protected $table = 'cabut_hancuran_persiapan_stocks';
    protected $fillable = [
        'nomor_job',
        'jenis_rambang',
        'upah_operator',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
        'status',
    ];
}
