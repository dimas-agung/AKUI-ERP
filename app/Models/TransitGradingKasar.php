<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitGradingKasar extends Model
{
    use HasFactory;
    protected $table = 'transit_grading_kasar';
    protected $fillable = [
        'unit',
        'nomor_bstb',
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'kadar_air',
        'modal',
        'total_modal',
        'timestamp'
    ];
}
