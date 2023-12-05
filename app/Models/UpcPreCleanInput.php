<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcPreCleanInput extends Model
{
    use HasFactory;
    protected $table = 'upc_pre_clening_input';
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
        'keterangan',
        'timestamp',
        'nip_admin'
    ];
}
