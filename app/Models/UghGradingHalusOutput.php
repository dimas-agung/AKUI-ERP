<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UghGradingHalusOutput extends Model
{
    use HasFactory;
    protected $table = 'ugh_grading_halus_output';
    protected $fillable = [
        'id_box',
        'nomor_batch',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'tujuan_kirim',
        'nomor_job',
        'nomor_bstb',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin',
    ];
}
