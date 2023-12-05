<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UgkAdding extends Model
{
    use HasFactory;
    protected $table = 'ugk_adding';
    protected $fillable = [
        'nomor_btsb',
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat_adding',
        'kadar_air',
        'nomor_grading',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin'
    ];
}
