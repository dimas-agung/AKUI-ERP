<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingKasarStock extends Model
{
    use HasFactory;
    protected $table = 'grading_kasar_stocks';
    protected $fillable = [
        'doc_no',
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis_grading',
        'berat_masuk',
        'berat_keluar',
        'pcs_masuk',
        'pcs_keluar',
        'avg_kadar_air',
        'nomor_grading',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];
}
