<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingKasarHasil extends Model
{
    use HasFactory;
    protected $table = 'grading_kasar_hasils';
    protected $fillable = [
        'doc_no',
        'nomor_grading',
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'kadar_air',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'modal',
        'total_modal',
        'hpp',
        'total_hpp',
        'keterangan',
        'user_created',
        'user_updated',
    ];
}
