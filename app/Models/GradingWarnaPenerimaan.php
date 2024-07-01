<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingWarnaPenerimaan extends Model
{
    use HasFactory;
    protected $table = 'grading_warna_penerimaans';
    Public const STATUS_NON_AKTIF = 0;
    const STATUS_ON_STOCK = 1;
    protected $fillable = [
        'nomor_job',
        'nomor_bstb',
        'nomor_batch',
        'tujuan_kirim',
        'keterangan',
        'berat_kotor',
        'jenis_grading',
        'berat_1_grading',
        'pcs_1_grading',
        'berat_2_grading',
        'modal',
        'total_modal',
        'status',
        'user_created',
        'user_updated',
    ];

}
