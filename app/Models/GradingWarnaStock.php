<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingWarnaStock extends Model
{
    use HasFactory;
    protected $table = 'grading_warna_penerimaan_stocks';
    protected $fillable = [
        'unit',
        'id_box_grading_warna',
        'nomor_batch',
        'tujuan_kirim',
        'jenis_grading',
        'berat_masuk',
        'pcs_masuk',
        'berat_keluar',
        'pcs_keluar',
        'sisa_berat',
        'sisa_pcs',
        'modal',
        'total_modal',
        'status',
    ];
}
