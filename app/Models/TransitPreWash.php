<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitPreWash extends Model
{
    use HasFactory;
    protected $table = 'transit_pre_washes';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'status',
        'nomor_bstb',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'keterangan',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
}
