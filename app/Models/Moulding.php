<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moulding extends Model
{
    use HasFactory;
    protected $table = 'mouldings';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'tujuan_kirim',
        'job_order',
        'berat_job',
        'pcs_job',
        'modal_nomor_job',
        'total_modal_nomor_job',
        'user_created',
        'user_updated',
        'status',
    ];
}
