<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitGradingHalus extends Model
{
    use HasFactory;
    protected $table = 'transit_grading_halus';
    protected $fillable = [
        'nomor_bstb',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'nomor_job',
        'modal',
        'total_modal',
        'timestamp'
    ];
}
