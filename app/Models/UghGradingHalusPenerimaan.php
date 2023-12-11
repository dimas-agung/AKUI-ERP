<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UghGradingHalusPenerimaan extends Model
{
    use HasFactory;
    protected $table = 'ugh_grading_halus_penerimaan';
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
        'nip_admin',
    ];
}
