<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingPersiapan extends Model
{
    use HasFactory;
    protected $table = 'grading_warna_penerimaan_stocks';
    protected $fillable = [
        'id_box_grading_warna',
        'nomor_batch',
        'tujuan_kirim',
        'jenis_grading',
        'job_order',
        'berat_job',
        'pcs_job',
        'nomor_job',
        'biaya_produksi',
        'modal_per_jenis',
        'total_modal_per_jenis',
        'modal_nomor_job',
        'total_modal_nomor_job',
        'user_created',
        'user_updated',
        'status',
    ];
}
