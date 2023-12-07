<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UghGradingHalusStockWip extends Model
{
    use HasFactory;
    protected $table = 'ugh_grading_halus_stock_wip';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'modal',
        'total_modal',
    ];
}
