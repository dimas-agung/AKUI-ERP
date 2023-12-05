<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ugk_grading_kasar_output extends Model
{
    use HasFactory;
    protected $table = 'ugk_grading_kasar_output';
    protected $fillable = [
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'nomor_job',
        'nomor_bstb',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin',
    ];
}
