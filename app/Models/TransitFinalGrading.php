<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitFinalGrading extends Model
{
    use HasFactory;
    protected $table = 'transit_final_gradings';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'tujuan_kirim',
        'job_order',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'modal_per_jenis',
        'total_modal_per_jenis',
        'status',
    ];
}
