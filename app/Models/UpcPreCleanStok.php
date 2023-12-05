<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcPreCleanStok extends Model
{
    use HasFactory;
    protected $table = 'upc_pre_clening_stok';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'modal',
        'total_modal'
    ];
}
