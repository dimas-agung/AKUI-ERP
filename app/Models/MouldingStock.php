<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingStock extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_ON_STOCK = 1;
    const STATUS_ON_PROSES = 2;
    const STATUS_FINISHED = 3;
    protected $table = 'moulding_stocks';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'tujuan_kirim',
        'upah_operator',
        'job_order',
        'berat_job',
        'pcs_job',
        'modal_nomor_job',
        'total_modal_nomor_job',
        'upah_operator',
        'status',
    ];
}
