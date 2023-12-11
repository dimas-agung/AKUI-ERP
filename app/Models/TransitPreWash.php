<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitPreWash extends Model
{
    use HasFactory;
    protected $table = 'transit_pre_wash';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'modal',
        'total_modal',
        'timestamp',
    ];
}
