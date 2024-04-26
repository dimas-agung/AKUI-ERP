<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutBuluPenerimaan extends Model
{
    use HasFactory;
    protected $table = 'cabut_bulu_penerimaans';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'keterangan',
        'nomor_bstb',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
}
