<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAGradingCabutStock extends Model
{
    use HasFactory;
    protected $table = 'transit_cabut_bulus';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'jenis_grading',
        'berat_1_grading',
        'pcs_1_grading',
        'berat_2_grading',
        'modal',
        'total_modal',
        'status',
    ];
}
