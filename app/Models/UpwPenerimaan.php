<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpwPenerimaan extends Model
{
    use HasFactory;
    protected $table = 'upw_penerimaan';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin',
    ];
}
