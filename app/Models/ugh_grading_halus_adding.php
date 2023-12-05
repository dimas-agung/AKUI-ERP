<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ugh_grading_halus_adding extends Model
{
    use HasFactory;
    protected $table = 'ugh_grading_halus_adding';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat_adding',
        'pcs_adding',
        'kadar_air',
        'nomor_grading',
        'biaya_produksi',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin',
    ];
}
