<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitPreCleaning extends Model
{
    use HasFactory;
    protected $table = 'transit_pre_cleaning';
    protected $fillable = [
        'unit',
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
